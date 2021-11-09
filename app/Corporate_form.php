<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate_form extends Model
{
   
   protected $fillable=['name','email','phone','reason','company_name','message'];
   
   
}