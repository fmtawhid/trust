<?php

namespace Modules\Localize\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Exports\LanguageValueExport;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Localize\Entities\Language;
use Modules\Localize\Entities\Langstring;
use Modules\Localize\Entities\Langstrval;
use Illuminate\Pagination\LengthAwarePaginator;

class LanguageController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_language_list')->only('languagelist');
        $this->middleware('permission:create_language_list')->only(['languageStore']);
        $this->middleware('permission:delete_language_list')->only(['languageDestroy']);

        $this->middleware(['demo'])->only(['languageStore','languageDestroy', 'lanstrvaluestore', 'languageListUpdate']);
    }

    public function languageStringList()
    {
        $langFile = base_path('lang/en/language.php');
        if (!file_exists($langFile)) {
            File::put($langFile, '<?php return array();');
        }
        $langFile = require $langFile;
        $datas = $this->paginate($langFile, 20);

        return view('localize::lang.language_string_list', compact('datas'));
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            array_merge($options, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
            ])
        );
    }

    public function languagelist()
    {
        $langList_DB = DB::table('lang')->where('id', '<>', 1)->get();
        $languageList = Language::paginate(10);

        return view('localize::lang.language_list', compact('langList_DB', 'languageList'));
    }

    public function languageStore(Request $request)
    {
        $request->validate([
            'langname' => 'unique:languages|required',
        ]);

        $data = [
            'langname' => $request->langname,
            'value' => $request->value,
        ];

        $path = lang_path($request->value);
        if (File::isDirectory($path)) {
        } else {
            File::makeDirectory($path, 0777, true, true);
            $targetFileLocation = lang_path($request->value . '/language.php');
            $makeCopyFile = lang_path('en/language.php');
            File::copy($makeCopyFile, $targetFileLocation);
        }

        $localize_value = Language::create($data);
        $localize_id = $localize_value->id;
        $languageStringList = Langstring::all();
        $currentTime = Carbon::now();

        $arrayUpdate = [];
        foreach ($languageStringList as $key => $lanvalue) {
            $arrayUpdate[$key] = [
                'localize_id' => $localize_id,
                'langstring_id' => $lanvalue->id,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ];
        }
        Langstrval::insert($arrayUpdate);

        return redirect()->back()->with('success', localize('data_save'));
    }

    public function languageDestroy($id)
    {
        Language::where('id', $id)->delete();
        Toastr::success('Deleted Successfully.!', 'Success');

        return response()->json(['success' => 'success']);
    }

    public function languageStringValueindex(Request $request, $id)
    {
        $langstringValues = Language::findOrFail($id);
        $lang_array = require base_path('lang/' . $langstringValues->value . '/language.php');
        $datas = $this->paginate($lang_array);
        $langName = $langstringValues->langname;
        $lanfolder = $langstringValues->value;

        return view('localize::lang.langstrvalue', compact('datas', 'langName', 'lanfolder', 'id'));
    }

    public function lanstrvaluestore(Request $request)
    {
        $lang_key = $request->lanstrvaluekey;
        $lang_value = $request->lanstrvalue;
        $lang_folder = $request->lanfolder;

        // Load the existing language array
        $lang_array = require base_path('lang/' . $lang_folder . '/language.php');

        // Combine keys and values into an associative array
        $combined_array = array_combine($lang_key, $lang_value);

        // Update or add specific key-value pairs
        foreach ($combined_array as $key => $value) {
            $lang_array[$key] = $value;
        }

        // Save the updated language array back to the filesystem
        File::put(base_path('lang/' . $lang_folder . '/language.php'), '<?php return ' . var_export($lang_array, true) . ';');

        return '<script>window.history.back();</script>';
    }

    public function getAllData($id)
    {
        $langstringValues = Language::findOrFail($id);

        if (!empty($id)) {

            $data = require base_path('lang/' . $langstringValues->value . '/language.php');

            $arr = [];
            foreach ($data as $key => $value) {
                $arr[] = [
                    'lang_string' => $key,
                    'value' => $value,
                ];
            }

            return DataTables::of($arr)->addIndexColumn()
                ->editColumn('value', function ($row) {

                    return '<input type="text" class="align-middle w-75" name="lanstrvalue[]" value="' . $row['value'] . '">
                    <input type="hidden" name="lanstrvaluekey[]" value="' . $row['lang_string'] . '">';
                })
                ->rawColumns(['value'])
                ->make(true);
        }
    }

    public function export($locale = 'en')
    {
        $langFile = lang_path("$locale/language.php");

        if (!File::exists($langFile)) {
            return back()->withErrors(["Language file not found for $locale"]);
        }

        $translations = include $langFile;

        return Excel::download(new LanguageValueExport($translations, $locale), "translations_$locale.xlsx");
    }

    public function import(Request $request)
    {
        $request->validate([
            'locale' => 'required|string',
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        $locale = $request->input('locale');
        $path = $request->file('file')->getRealPath();

        $rows = Excel::toArray([], $request->file('file'))[0];

        if (empty($rows) || !isset($rows[0])) {
            return back()->withErrors(['Uploaded file is empty or unreadable.']);
        }

        $header = array_map('trim', $rows[0]);
        $keyIndex = array_search('key', $header);
        $valIndex = array_search($locale, $header);

        if ($keyIndex === false || $valIndex === false) {
            return back()->withErrors(["The Excel file must contain 'key' and '$locale' columns."]);
        }

        $imported = [];

        foreach (array_slice($rows, 1) as $row) {
            $key = trim($row[$keyIndex] ?? '');
            $value = trim($row[$valIndex] ?? '');

            if ($key !== '') {
                $imported[$key] = $value;
            }
        }

        // Load existing translations
        $langFilePath = lang_path("$locale/language.php");
        $existing = File::exists($langFilePath) ? include $langFilePath : [];

        // Merge with imported
        $updated = array_merge($existing, $imported);
        ksort($updated); // Optional: keep sorted

        // Save back to PHP array
        $content = "<?php return array (\n";
        foreach ($updated as $key => $value) {
            $value = addslashes($value);
            $content .= "  '$key' => '$value',\n";
        }
        $content .= ");\n";

        File::put($langFilePath, $content);

        return back()->with('success', localize('language_file_imported_and_updated_successfully'));
    }

    public function languageListUpdate($id)
    {
        try {
            $language = Language::findOrFail($id);

            // Toggle the status (1 to 0, or 0 to 1)
            $language->status = !$language->status;

            $language->save();

            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['fail' => 'fail']);
        }
    }
}
