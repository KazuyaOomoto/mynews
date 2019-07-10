<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phistory extends Model
{
    //$guarded - ブラックリスト_複数代入時に代入を許可しない属性を配列で設定
    protected $guarded = array('id');

    public static $rules = array(
        'profile_id' => 'required',
        'edited_at' => 'required',
    );
}
