<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($catalogSlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        //dd($catalog);
        $categories = Category::all()->where('catalog_id', $catalog->id);

        return view('admin.categories.index', compact('categories', 'catalog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($catalogSlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        return view('admin.categories.create', compact('catalog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $valdata = $request->validated();
        $valdata['slug'] = Str::slug($valdata['name'], '-');
        $catalog = Catalog::where('id', $valdata['catalog_id'])->first();
        //dd($catalog);
        Category::create($valdata);
        return to_route('admin.categories.index', $catalog->slug)->with('message', 'Congratulation Category Created Correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show($catalogSlug, Category $category)
    {
        /*  $catalog = Catalog::where('slug', $catalogSlug)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T See Categories that are NOT Yours!");
        } */
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($catalogSlug, $categorySlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Update Categories that are NOT Yours!");
        }
        return view('admin.categories.edit', compact('catalog', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $catalogSlug, $categorySlug)
    {
        $valdata = $request->validated();
        //dd($categorySlug);
        if ($valdata['name']) {
            $valdata['slug'] = Str::slug($valdata['name'], '-');
        }
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        $category->update($valdata);
        return to_route('admin.categories.index', $catalogSlug)->with('message', 'Congratulation Category Updated Correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($catalogSlug, $categorySlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Delete Categories that are NOT Yours!");
        }
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        $category->delete();
        return to_route('admin.categories.index', $catalog->slug)->with('message', 'Congratulation Category deleted correctly!');
    }
}
