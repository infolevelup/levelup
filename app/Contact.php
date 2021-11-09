<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // 
    protected $table = 'contacts';
    protected $fillable = [
        'email','phone', 'address','map_link'
    ];

    public $timestamps = false;
    public static function insertData($data){

        $value=DB::table('contacts')->where('firstname', $data['firstname'])->get();
        if($value->count() == 0){
           DB::table('firstname')->insert($data);
        }
     }
  
}
