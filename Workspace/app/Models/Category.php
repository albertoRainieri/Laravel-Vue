<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const TABLE_NAME = 'categories';
    const NAME = 'name';
    const DESCRIPTION = 'description';

    protected $fillable = ['name', 'description'];


}
