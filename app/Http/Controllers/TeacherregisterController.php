<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use App\TeacherProfile;
class TeacherregisterController extends Controller
{
    //
     public function index(Request $request)
    {
      return view('registerTeacher');
    }
    public function register(Request $request){
         $this->validate($request, [
             'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','max:100','confirmed'],
          
        ]);
        $data=$request->all();
        if (User::where('email', '=', $data['email'])->count() > 0) {
                  return back()->with('flash_error', ' Email already exists');

}else{
       $user= User::create([
            'role_id'=>2,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status'=>'Inactive',
        ]);
        TeacherProfile::create([
            'user_id'=>$user->id,
          
        ]);
         $users = \App\User::find(1);
           $details = [
            'greeting' => 'Hi Admin',
            'body' => 'New Instructor has been registered '.$user->name,
            'thanks' => 'Thank you for visiting ',
    ];

    $users->notify(new \App\Notifications\Registercomplete($details));
        
               return back()->with('flash_success', ' Registerd successfully.We will verify and Activate Your account');
}
    }
    
     public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();
  
        return response()->json(['success'=>'Status change successfully.']);
    }
}
