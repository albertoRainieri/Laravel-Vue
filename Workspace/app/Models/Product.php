<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const PRODUCT_ID = 'id';
    const PRODUCT_NAME = 'name';
    const PRODUCT_DESCRIPTION = 'description';
    const PRODUCT_PRICE = 'price';
    const PRODUCT_PHOTO = 'photo';
    const PRODUCT_CATEGORY_ID = 'category_id';
    const PRODUCT_TABLE = 'products';
    const PRODUCT_USER_ID = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'photo', 'category_id', 'user_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->select(['name as text','id']);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->belongsToMany(User::class, 'purchases',
            'user_id', 'product_id' );
    }


}
