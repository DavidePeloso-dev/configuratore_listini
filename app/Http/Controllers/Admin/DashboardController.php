<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function application()
    {
        $catalogs = Catalog::with('articles.category.components.thickness')->where('user_id', auth()->id())->get();
        return view('admin.application', compact('catalogs'));
    }
}
