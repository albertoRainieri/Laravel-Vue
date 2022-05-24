<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const ORDER_ID = 'id';
    const ORDER_USER_ID = 'user_id';
    const ORDER_PRODUCT_ID = 'product_id';
    const PRODUCT_TABLE = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ORDER_PRODUCT_ID, self::ORDER_USER_ID
        ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
