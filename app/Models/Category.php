<?php

namespace App\Models;

use Database\Seeders\CatalogSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['catalog_id', 'name', 'slug'];


    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }
}
