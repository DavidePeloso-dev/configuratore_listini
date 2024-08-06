<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Category;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($catalogSlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T See Articles that are NOT Yours!");
        }
        $articles = Article::all()->where('catalog_id', $catalog->id);
        return view('admin.articles.index', compact('catalog', 'articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($catalogSlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $categories = Category::all()->where('catalog_id', $catalog->id);
        return view('admin.articles.create', compact('catalog', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $valdata = $request->validated();
        $catalog = Catalog::where('id', $valdata['catalog_id'])->first();
        //dd($catalog);
        Article::create($valdata);
        return to_route('admin.articles.index', $catalog->slug)->with('message', 'Congratulation Article Created Correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show($catalogSlug, $articleCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($catalogSlug, $articleCode)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $categories = Category::all()->where('catalog_id', $catalog->id);
        $article = Article::where('code', $articleCode)->where('catalog_id', $catalog->id)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Update Articles that are NOT Yours!");
        }
        return view('admin.articles.edit', compact('catalog', 'article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, $catalogSlug, $articleCode)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $article = Article::where('code', $articleCode)->where('catalog_id', $catalog->id)->first();
        $valdata = $request->validated();
        $article->update($valdata);
        return to_route('admin.articles.index', $catalogSlug)->with('message', 'Congratulation Article Updated Correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($catalogSlug, $articleCode)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Delete Categories that are NOT Yours!");
        }
        $article = Article::where('code', $articleCode)->where('catalog_id', $catalog->id)->first();
        $article->delete();
        return to_route('admin.articles.index', $catalog->slug)->with('message', 'Congratulation Article deleted correctly!');
    }
}
