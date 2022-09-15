<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth, File, Validator, Hash;

class ProfileController extends Controller
{
    public function deleteProfilePhoto()
    {
        $id = Auth::id();
        $photo = Auth::user()->photo;
        $destination = public_path("storage/".$photo);
        if(file_exists($destination))
        {
            File::delete($destination);
     
        }

        return User::where('id', $id)->update(['photo'=> '']);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'photo' => ['image', 'mimes:jpg,png,jpeg,gif'],
        ]);
        if($validator->fails())
        {
            return response()->json(['errors'=> $validator->errors()->all()]);
        }

        $id = Auth::id();
        $photo = Auth::user()->photo;
        $destination = public_path("storage/".$photo);
        if($request->hasFile('photo'))
        {
            if(file_exists($destination))
            {
                File::delete($destination);
            }

            $image = $request->photo;
            $new_name = rand().".".$image->extension();
            $image->move(public_path('storage'), $new_name);
            $photo = $new_name;

        }
        else if($request->hiddenID == "1")
        {
            $photo = "";
            if(file_exists($destination))
            {
                File::delete($destination);
            }
        }

        $user = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'photo' => $photo,
            'short_description' => $request->short_description,
            'company' => $request->company,
            'country' => $request->country,
            'address' => $request->address,
            'phone' => $request->phone,
            'twitter_link' => $request->twitter_link,
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'linkedin_link' => $request->linkedin_link,
        ]);

        return response()->json(['success'=> 'Profile updated']);
    }

    public function changePassword(Request $request)
    {
        if($request->ajax())
        {
            $validator = Validator::make($request->all(), [
                'password' => [ 'required'],
                'newpassword' => [ 'required', 'same:renewpassword', 'min:3'],
            ], 
            [
                'password.required' => 'Old password filed is required!',
                'newpassword.required' => 'New password filed is required!',
                'newpassword.same' => 'New password and confirm password doest not match!',
            ]);
    
            if($validator->fails())
            {
                return response()->json(['errors' => $validator->errors()->all()]);
            }
    
            if(Hash::check($request->password, Auth::user()->password))
            {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->newpassword);
                $user->save();
                Auth::logout();

                return response()->json(['success'=> 'Password updated']);
            }
            else{
                return response()->json(['error' => 'Old password does not match!']);
            }
        }


    }
}
