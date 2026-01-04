<?php

namespace Modules\News\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Setting\Entities\Language;
use Illuminate\Support\Facades\Storage;
use Modules\Reporter\Entities\Reporter;
use Modules\News\Imports\BulkPostCsvImport;
use Illuminate\Contracts\Support\Renderable;

class BulkPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['demo'])->only(['store']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $reporters = Reporter::where('status', 1)->get();
        $languages = Language::with(['category.children'])->get();

        return view('news::bulk_post.index', compact('reporters', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('news::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'upload_file' => 'required|file|mimetypes:text/plain,text/csv,application/csv,application/vnd.ms-excel,text/tsv',
        ]);

        $import = new BulkPostCsvImport;
        Excel::import($import, $request->file('upload_file'));

        $skipped = BulkPostCsvImport::$skippedRows;

        $downloadLink = null;
        if (!empty($skipped)) {
            $filename = 'skipped_posts_' . Str::uuid() . '.csv';
            $filePath = "skipped-posts/{$filename}";

            Storage::disk('public')->makeDirectory('skipped-posts');

            $handle = fopen(storage_path("app/public/{$filePath}"), 'w');

            fputcsv($handle, array_keys($skipped[0]));
            foreach ($skipped as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);

            $downloadLink = asset("storage/{$filePath}");
        }

        return redirect()
            ->route('bulk.post.upload.index')
            ->with([
                'success' => 'Import completed.',
                'downloadLink' => $downloadLink,
            ]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('news::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('news::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
