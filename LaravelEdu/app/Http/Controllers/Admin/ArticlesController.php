<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Builders\ArticleBuilder;
use App\Http\Builders\ArticleListBuilder;
use App\Http\Middleware\CheckForRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Tag;
use Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
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

        return view('admin.index', ['articles' => $articles, 'tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $builder = new ArticleBuilder();
        $builder->setTitle($request->get('title'));
        $builder->setDescription($request->get('description'));
        $builder->setTags($request->get('tags'));
        $article = $builder->build();

        return redirect()->route('admin.articles.show', [$article->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('tags')->findOrFail($id);

        return view('admin.article', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->get('title');
        $article->description = $request->get('description');
        $article->saveOrFail();

        return redirect()->route('admin.articles.show', ['id' => $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();

        return redirect()->route('admin.articles.index');
    }
}
