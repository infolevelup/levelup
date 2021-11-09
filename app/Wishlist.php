<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'id';
    protected $hidden = ['created_at','updated_at'];
    protected $fillable = ['courseid','coursename','price','userid','session_id']; 
    
}
