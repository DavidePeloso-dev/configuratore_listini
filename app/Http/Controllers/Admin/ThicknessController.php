<?php

namespace App\Http\Controllers\Admin;

use App\Models\Thickness;
use App\Http\Requests\StoreThicknessRequest;
use App\Http\Requests\UpdateThicknessRequest;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Support\Str;

class ThicknessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($catalogSlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        //dd($catalog);
        $thicknesses = Thickness::all()->where('catalog_id', $catalog->id);

        return view('admin.thicknesses.index', compact('thicknesses', 'catalog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($catalogSlug)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        return view('admin.thicknesses.create', compact('catalog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThicknessRequest $request)
    {
        $valdata = $request->validated();
        $catalog = Catalog::where('id', $valdata['catalog_id'])->first();
        //dd($catalog);
        Thickness::create($valdata);
        return to_route('admin.thicknesses.index', $catalog->slug)->with('message', 'Congratulation Thickness Created Correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show($catalogSlug, Thickness $thickness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($catalogSlug, $thicknessValue)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $thickness = Thickness::where('value', $thicknessValue)->where('catalog_id', $catalog->id)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Update Thicknesses that are NOT Yours!");
        }
        return view('admin.thicknesses.edit', compact('catalog', 'thickness'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThicknessRequest $request, $catalogSlug, $thicknessValue)
    {
        $valdata = $request->validated();
        //dd($categorySlug);

        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $thickness = Thickness::where('value', $thicknessValue)->where('catalog_id', $catalog->id)->first();
        $thickness->update($valdata);
        return to_route('admin.thicknesses.index', $catalogSlug)->with('message', 'Congratulation Thickness Updated Correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($catalogSlug, $thicknessValue)
    {
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Delete Thicknesses that are NOT Yours!");
        }
        $catalog = Catalog::where('slug', $catalogSlug)->first();
        $thickness = Thickness::where('value', $thicknessValue)->where('catalog_id', $catalog->id)->first();
        $thickness->delete();
        return to_route('admin.thicknesses.index', $catalog->slug)->with('message', 'Congratulation Thickness deleted correctly!');
    }
}
