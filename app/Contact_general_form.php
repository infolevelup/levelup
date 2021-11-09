<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_general_form extends Model
{
    
    
    protected $fillable = [
        'email','phone', 'message','subject','name'
    ];
}
