<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\NewsCommentReply;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsCommentReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:news_comments,id',
            'commentReply' => 'required|string|max:1000',
        ]);

        NewsCommentReply::create([
            'news_comment_id' => $request->comment_id,
            'web_user_id'     => Auth::guard('webuser')->id(),
            'reply'           => $request->commentReply,
        ]);

        return back()->with('success', 'Thank you. Your reply has been posted and is pending editorial review before it becomes visible.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
