<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/* migrationファイル(database\migrations)ではprofilesとしていたが、
modelでは単数形にすることがLaravelのルール */
class Profile extends Model
{
    protected $guarded = array('id');
    //
    public static $rules = array(
        'name' => 'required',  // nameが未入力の場合を防ぐ
        'gender' => 'required',   // genderが未入力の場合を防ぐ
        'hobby' => 'required',      // hobbyが未入力の場合を防ぐ
        'introduction' => 'required',   //introductonが未入力の場合を防ぐ
    );
    
    // Profileモデルに関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\Phistory');
    }
}
