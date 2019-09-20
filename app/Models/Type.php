<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'img_url', 'lang'];

}
