<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Stock extends Model
{
    protected $guarded = [
        'id'
    ];
    //バリデーションチェック
    public static $rules = array(
        'brand' => 'required',
        'imagefile' => 'required',
        'fee' => 'required',
        'detail' => 'required',
        'itemName' => 'required',  
    );
    //バリデーションチェック
    public static $rule2 = array(
        'brand' => 'required',
        'fee' => 'required',
        'detail' => 'required',
        'itemName' => 'required',  
    );

}
