<?php

namespace App\Http\Controllers\Admin;

use App\Models\Component;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Thickness;
use Illuminate\Support\Str;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($catalogSlug, $categorySlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        $components = Component::with('thickness')->where('category_id', $category->id)->get();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T See Components that are NOT Yours!");
        }
        return view('admin.components.index', compact('catalog', 'category', 'components'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($catalogSlug, $categorySlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        //dd($catalog);
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        //dd($category);
        $thicknesses = Thickness::all()->where('catalog_id', $catalog->id);
        return view('admin.components.create', compact('catalog', 'category', 'thicknesses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComponentRequest $request, $catalogSlug, $categorySlug)
    {
        $valdata = $request->validated();
        $valdata['slug'] = Str::slug($valdata['name'], '-');
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        Component::create($valdata);
        return to_route('admin.components.index', [$catalog->slug, $category->slug])->with('message', 'Congratulation Component added Correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show($catalogSlug, $categorySlug, Component $component)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($catalogSlug, $categorySlug, $componentSlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        $component = Component::where('slug', $componentSlug)->where('category_id', $category->id)->first();
        $thicknesses = Thickness::all()->where('catalog_id', $catalog->id);
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Update Components that are NOT Yours!");
        }
        return view('admin.components.edit', compact('catalog', 'category', 'component', 'thicknesses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComponentRequest $request, $catalogSlug, $categorySlug, $componentSlug)
    {
        $valdata = $request->validated();
        if ($valdata['name']) {
            $valdata['slug'] = Str::slug($valdata['name'], '-');
        }
        //dd($valdata['thickness_id']);
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        $component = Component::where('slug', $componentSlug)->where('category_id', $category->id)->first();
        //dd($component);
        $component->update($valdata);
        return to_route('admin.components.index', [$catalogSlug, $categorySlug])->with('message', 'Congratulation Component Updated Correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($catalogSlug, $categorySlug, $componentSlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Delete Components that are NOT Yours!");
        }
        $category = Category::where('slug', $categorySlug)->where('catalog_id', $catalog->id)->first();
        $component = Component::where('slug', $componentSlug)->where('category_id', $category->id)->first();
        $component->delete();
        return to_route('admin.components.index', [$catalogSlug, $categorySlug])->with('message', 'Congratulation Component deleted correctly!');
    }
}
