<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    const USER_ID = 'user_id';
    const PRODUCT_ID = 'product_id';
    const TABLE = 'carts';

    protected $fillable = ['user_id', 'product_id'];
    public $timestamps = false;

    public function setUserID($userID)
    {
        $this->setAttribute(self::USER_ID, $userID);
    }

    public function setProductID($productID)
    {
        $this->setAttribute(self::PRODUCT_ID, $productID);
    }


}
