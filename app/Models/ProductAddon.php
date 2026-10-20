<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAddon extends Model
{
    protected $fillable = ['name', 'price'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
