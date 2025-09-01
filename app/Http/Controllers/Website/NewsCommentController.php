<?php

namespace App\Http\Controllers\Website;

use App\Models\NewsComment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsCommentController extends Controller
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
        $validator = Validator::make($request->all(), [
            'comment' => ['required', 'string', 'max:1000'],
            'news_comment_type' => ['required', Rule::in(['news', 'video_news', 'opinion'])],
            'news_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->news_comment_type === 'news') {
                        if (!\DB::table('news_msts')->where('id', $value)->exists()) {
                            $fail('Selected news ID does not exist in news_msts.');
                        }
                    } elseif ($request->news_comment_type === 'video_news') {
                        if (!\DB::table('video_news')->where('id', $value)->exists()) {
                            $fail('Selected news ID does not exist in video_news.');
                        }
                    } elseif ($request->news_comment_type === 'opinion') {
                        if (!\DB::table('opinions')->where('id', $value)->exists()) {
                            $fail('Selected news ID does not exist in opinions.');
                        }
                    }
                },
            ],
        ]);
        $validator->validate();

        $commentData = [
            'web_user_id' => Auth::guard('webuser')->user()->id,
            'comment' => $request->comment
        ];

        if ($request->news_comment_type === 'video_news') {
            $commentData['video_news_id'] = $request->news_id;
        } elseif ($request->news_comment_type === 'opinion') {
            $commentData['opinion_id'] = $request->news_id;
        } else {
            $commentData['news_mst_id'] = $request->news_id;
        }

        NewsComment::create($commentData);

        return back()->with('success', 'Thank you for your comment. It has been submitted and will be visible after editorial review.');
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
