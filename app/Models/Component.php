<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Component extends Model
{
    use HasFactory;

    public $fillable = ['name', 'category_id', 'slug'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
