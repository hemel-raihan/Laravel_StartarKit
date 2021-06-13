<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProfileController extends Controller
{
    public function index()
    {
        Auth::user();
        return view('backend.profile.index');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(),
            'avatar' => 'nullable|image',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        //upload image
        $image = $request->file('avatar');
        $name = $request->name;

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $name.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

        if(!Storage::disk('public')->exists('userphoto'))
        {
            Storage::disk('public')->makeDirectory('userphoto');
        }

        if(Storage::disk('public')->exists('userphoto/'.$user->image))
        {
            Storage::disk('public')->delete('userphoto/'.$user->image);
        }
          //resize image
          $userimg = Image::make($image)->resize(1600,1600)->save($imagename,90);
          Storage::disk('public')->put('userphoto/'.$imagename,$userimg);
    }
    else
    {
        $imagename = $user->image;
    }

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'image' => $imagename,

    ]);
        notify()->success('Profile Updated','success');
        return back();
    }

    public function changePassword()
    {
        Auth::user();
        return view('backend.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = Auth::user();
        $hashedPassword = $user->password;
        if(Hash::check($request->old_password,$hashedPassword))
        {
            if(!Hash::check($request->password,$hashedPassword))
            {
                if(!Hash::check($request->password,$request->password_confirmation))
                {
                    $user->update([
                        'password' => Hash::make($request->password),
                    ]);
                    Auth::logout();
                    return redirect()->route('login');
                }
                else
                {
                    notify()->error('Confirm password not matching with new password','Error');
                }

            }
            else
            {
                notify()->warning('New Password can not be same as old password','Error');
            }
        }
        else
        {
            notify()->error('Old Password not matched','Error');
        }
        return back();
    }

}
