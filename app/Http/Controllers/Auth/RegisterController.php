<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'photo' => ['image', 'mimes:jpg,png,jpeg,gif'],
            'phone' => ['unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $new_name = "";
        if(isset($data['photo']))
        {
            $image = $data['photo'];
            $image_extension = $image->extension();
            $new_name = rand().".".$image_extension;
            $image->move(public_path('storage'), $new_name);
        }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'designation' => $data['designation'],
            'phone' => $data['phone'],
            'photo' =>  $new_name,
            'short_description' => $data['short_description'],
            'company' => $data['company'],
            'country' => $data['country'],
            'address' => $data['address'],
            'twitter_link' => $data['twitter_link'],
            'facebook_link' => $data['facebook_link'],
            'instagram_link' => $data['instagram_link'],
            'linkedin_link' => $data['linkedin_link'],
        ]);
    }
}
