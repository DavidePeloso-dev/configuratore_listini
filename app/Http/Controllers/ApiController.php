<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Catalog;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class ApiController extends Controller
{
    public function articles($apiKey, $catalogSlug)
    {
        if ($apiKey == env('API_KEY')) {
            $catalog = Catalog::where('slug', $catalogSlug)->first();
            $articles = Article::with('category.components.thickness')->where('catalog_id', $catalog->id)->get();
            $responses = [];
            foreach ($articles as $i => $article) {
                $components = [];
                foreach ($article->category->components as $component) {
                    //dd($component->thickness->value);
                    if ($component->thickness) {
                        $components[$component->name] = $component->thickness->value;
                    } else {
                        $components[$component->name] = '';
                    }
                }
                $responses[$i] = [
                    'code' => $article->code,
                    'height' => $article->height,
                    'width' => $article->width,
                    'depth' => $article->depth,
                    'category' => $article->category->name,
                    'components' => $components
                ];
            }
            return response()->json([
                'articles' => $responses,
            ]);
        }
    }
}
