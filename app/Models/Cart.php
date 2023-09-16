<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = ['product_id', 'user_id', 'quantity', 'price'];

    public function scopeAuthUser(Builder $query): void
    {
        $query->where('user_id', auth()->id());
    }
}
