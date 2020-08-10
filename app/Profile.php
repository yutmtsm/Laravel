<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required | max:20',
        'gender' => 'accept',
        'hobby' => 'required | max:192',
        'introduction' => 'required | max:576',
    );
    //関連付けを行う。
    public function changelogs(){
        return $this->hasMany('App\Changelog');
    }
}
