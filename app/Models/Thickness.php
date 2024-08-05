<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Thickness extends Model
{
    use HasFactory;

    public $fillable = ['value', 'catalog_id'];

    public function catalog(): BelongsTo
    {
        return $this->belongsTo(Catalog::class);
    }
}
