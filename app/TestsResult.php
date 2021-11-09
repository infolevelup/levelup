<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestsResult extends Model
{
    protected $fillable = ['test_id', 'user_id', 'test_result','scored_marks','total_marks'];

    public function answers()
    {
        return $this->hasMany('App\TestsResultsAnswer');
    }

    public function test(){
        return $this->belongsTo(Test::class);
    }
}
