<?php

namespace Modules\Setting\Http\Controllers;

use App\Models\NewsComment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Setting\Entities\Application;
use Illuminate\Contracts\Support\Renderable;

class CommentsInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $comments = NewsComment::with([
            'user',
            'repliesAll.user',
            'newsMst.language',
            'videoNews.language',
            'opinion.language'
        ])
        ->orderBy('id', 'desc')
        ->paginate(25);

        $appSettings = Application::first();

        return view('setting::comments.index', compact('comments', 'appSettings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     */
    public function update($id)
    {
        $comments_info = NewsComment::where('id', $id)->first();
        if(!$comments_info->is_approved){
            $res_up = NewsComment::where('id', $id)->update(['is_approved' => 1]);
            if($res_up){
                return redirect()->route('comments.comments_manage')->with('success', localize('data_updated_successfully'));
            }else{
                return redirect()->route('comments.comments_manage')->with('fail', localize('something_wen_wrong'));
            }
        }else{
            $res_up = NewsComment::where('id', $id)->update(['is_approved' => 0]);
            if($res_up){
                return redirect()->route('comments.comments_manage')->with('success', localize('data_updated_successfully'));
            }else{
                return redirect()->route('comments.comments_manage')->with('fail', localize('something_wen_wrong'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     */
    public function destroy(NewsComment $comment)
    {
        NewsComment::where('id', $comment->id)->forceDelete();
        Toastr::success('Comments Deleted successfully :)', 'Success');
        return response()->json(['success' => 'success']);
    }
}
