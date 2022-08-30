<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'buying_price',
        'selling_price',
        'stock_quantity',
        'available_quantity',
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class, 'product_id', 'id');
    }
}
