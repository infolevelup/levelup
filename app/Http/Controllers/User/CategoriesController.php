<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Course;
use App\Helpers\Helper;
use Auth;
class CategoriesController extends Controller
{
    //
     public function index()
    {
    
                    $userid=Auth::user()->id;
        $course=Course::where('teacher_id',$userid)->get()->unique('category_id');
     $users = Category::where('status','1')->orderBy('id', 'DESC')->get();
        return view('user.categories.index', compact('users','course'));
    }
    
}
