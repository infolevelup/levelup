<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5','max:100' ,'confirmed'],
                   ]
                  

                   );
                   
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
  
        $user=User::create([
            'role_id'=>3,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status'=>'Active',
        ]);
        
          $users = \App\User::find(1);
           $details = [
            'greeting' => 'Hi Admin',
            'body' => 'New Student has been registered '.$user->name,
            'thanks' => 'Thank you for visiting ',
    ];

    $users->notify(new \App\Notifications\Registercomplete($details));
       
          $email_data = array(
        'name' => $data['name'],
        'email' => $data['email'],
    );

    // send email with the template
    Mail::send('emails.welcome_email', $email_data, function ($message) use ($email_data) {
        $message->to($email_data['email'], $email_data['name'])
            ->subject('Welcome to Level Up')
            ->from('testing@telcopl.com', 'Level Up');
    });
       
     return $user;

    }
}
