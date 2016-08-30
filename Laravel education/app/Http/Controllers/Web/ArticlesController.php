<?php

namespace App\Http\Controllers\Web;

use App\Article;
use App\Comment;
use App\Http\Builders\ArticleListBuilder;
use App\Http\Builders\CommentTreeBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ArticlesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $builder = new ArticleListBuilder();
        $builder->setQuery($request->get('query'));
        $articles = $builder->build();
        $tags = Tag::all();

        return view('home.index', [
            'articles' => $articles,
            'tags' => $tags
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::with('user')->whereIn('article_id', [$id])->get()->toArray();
        $article = Article::findOrFail($id);

        $builder = new CommentTreeBuilder();
        $builder->setFlatCommentsArray($comments);
        $commentsTree = $builder->build();

        return view('home.article', [
            'article' => $article,
            'comments' => $commentsTree
        ]);
    }


}
