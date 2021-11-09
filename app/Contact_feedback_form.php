<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_feedback_form extends Model
{
       
    protected $fillable = [
        'email','phone', 'name','message'
    ];
}
