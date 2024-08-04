<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalog;
use App\Http\Requests\StoreCatalogRequest;
use App\Http\Requests\UpdateCatalogRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogs = Catalog::all()->where('user_id', auth()->id());
        return view('admin.catalogs.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.catalogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCatalogRequest $request)
    {
        $valdata = $request->validated();
        $valdata['user_id'] = auth()->id();
        $valdata['slug'] = Str::slug($valdata['name'], '-');
        Catalog::create($valdata);
        return to_route('admin.catalogs.index')->with('message', 'Congratulation Catalog Created Correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalog $catalog)
    {
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T See Catalogs that are NOT Yours!");
        }
        return view('admin.catalogs.show', compact('catalog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalog $catalog)
    {
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Update Catalogs that are NOT Yours!");
        }
        return view('admin.catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatalogRequest $request, Catalog $catalog)
    {
        $valdata = $request->validated();
        if ($valdata['name']) {
            $valdata['slug'] = Str::slug($valdata['name'], '-');
        }
        $catalog->update($valdata);
        return to_route('admin.catalogs.index')->with('message', 'Congratulation Catalog Updated Correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalog $catalog)
    {
        if ($catalog->user_id != auth()->id()) {
            abort(403, "You Can'T Delete Catalogs that are NOT Yours!");
        }
        $catalog->delete();
        return to_route('admin.catalogs.index')->with('message', 'Congratulation Catalog deleted correctly!');
    }
}
