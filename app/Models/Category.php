<?php

namespace App\Models;

use Database\Seeders\CatalogSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public $fillable = ['catalog_id', 'name', 'slug'];


    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }

    public function components(): HasMany
    {
        return $this->hasMany(Component::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
