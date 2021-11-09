<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry_form extends Model
{
     protected $fillable = [
        'email','phone', 'name','enquiry'
    ];
}
