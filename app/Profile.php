<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'name' => 'required | max:20',
        'gender' => 'max:20',
        'hobby' => 'required | max:192',
        'introduction' => 'required | max:576',
    );
}
