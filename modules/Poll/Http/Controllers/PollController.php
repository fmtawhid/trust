<?php

namespace Modules\Poll\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Poll\Entities\Poll;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Enums\ActivationStatusEnum;
use Modules\Poll\Entities\PollOption;
use Modules\Localize\Entities\Language;
use Modules\Poll\DataTables\PollDataTable;
use Illuminate\Contracts\Support\Renderable;

use function Ramsey\Uuid\v1;

class PollController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_poll')->only('index','pollResult');
        $this->middleware('permission:create_poll')->only(['create', 'store']);
        $this->middleware('permission:update_poll')->only(['edit', 'update', 'updateStatus']);
        $this->middleware('permission:delete_poll')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(PollDataTable $dataTable)
    {
        return $dataTable->render('poll::index');

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $languages = Language::all();
        
        return view('poll::create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'vote_permission' => 'required|array',
            'vote_permission.*' => 'in:0,1',
        ]);

        DB::beginTransaction();

        try {
            
            $poll = Poll::create([
                'language_id' => $request->input('language_id'),
                'question' => $request->input('question'),
                'vote_permission' => $request->input('vote_permission')[0],
                'meta_keyword'=> $request->input('meta_keyword'),
                'meta_description'=> $request->input('meta_description'),
            ]);

            foreach ($request->input('options') as $option) {
                PollOption::create([
                    'poll_id' => $poll->id,
                    'name' => $option,
                ]);
            }

            DB::commit();

            return response()->json([
                'error' => false,
                'msg'   => localize('data_saved_successfully')
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'error' => true,
                'msg'   => 'Failed to save data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('poll::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Poll $poll)
    {
        $numberWords = [
            'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'
        ];

        $poll->load('options');
        $languages = Language::all();

        return view('poll::edit', compact('poll', 'numberWords', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'language_id' => 'required|exists:languages,id',
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'vote_permission' => 'required|array',
            'vote_permission.*' => 'in:0,1',
        ]);

        DB::beginTransaction();

        try {
            
            $poll = Poll::findOrFail($id);
    
            $poll->update([
                'language_id' => $request->input('language_id'),
                'question' => $request->input('question'),
                'vote_permission' => $request->input('vote_permission')[0],
                'meta_keyword'=> $request->input('meta_keyword'),
                'meta_description'=> $request->input('meta_description'),
            ]);
    
            $poll->options()->delete();

            foreach ($request->input('options') as $option) {
                PollOption::create([
                    'poll_id' => $poll->id,
                    'name' => $option,
                ]);
            }
    
            DB::commit();
    
            return response()->json([
                'error' => false,
                'msg'   => localize('data_updated_successfully')
            ]);
    
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'error' => true,
                'msg'   => 'Failed to update data: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Poll $poll)
    {
        DB::beginTransaction();

        try {
            $poll->delete();

            DB::commit();

            return response()->json(['success' => 'success']);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['fail' => 'fail']);
        }
    }

    /**
     * Update the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function updateStatus(Poll $poll)
    {
        $status = $poll->status->value === ActivationStatusEnum::ACTIVE->value
            ? ActivationStatusEnum::INACTIVE->value
            : ActivationStatusEnum::ACTIVE->value;

        try {
            $poll->update([
                'status' => $status
            ]);

            return response()->json(['success' => 'success']);

        } catch (\Exception $e) {
            return response()->json(['fail' => 'fail']);
        }
    }

    public function pollResult(Poll $poll)
    {
        $totalVotes = $poll->options->sum('total_vote');

        return view('poll::result', compact('poll', 'totalVotes'));
    }
}
