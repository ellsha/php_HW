<?php

namespace App\Http\Controllers\Web;

use App\Comment;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->text = $request->get('text');
        $comment->user_id = Auth::user()->id;
        $comment->article_id = $request->get('article_id');
        $comment->comment_id = $request->get('comment_id');
        $comment->saveOrFail();

        return redirect()->route('web.articles.show', [$request->get('article_id')]);
    }
}
