<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');
    //
    public static $rules = array(
        'title' => 'required',  // titleが未入力の場合を防ぐ
        'body' => 'required',   // bodyが未入力の場合を防ぐ
    );
}
