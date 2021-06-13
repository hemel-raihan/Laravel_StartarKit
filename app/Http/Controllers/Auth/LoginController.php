<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\storage;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProvider($provider)
    {
        $user = Socialite::driver($provider)->user();
        $existingUser = User::whereEmail($user->getEmail())->first();
        if($existingUser)
        {
            Auth::login($existingUser);
        }
        else
        {

            //upload image from github
            $image = $user->getAvatar();
            $name = $user->getName();
            if($user->getAvatar())
            {
                $currentDate = Carbon::now()->toDateString();
                $imagename = $name.'-'.$currentDate.'-'.uniqid();

                if(!Storage::disk('public')->exists('userphoto'))
                {
                    Storage::disk('public')->makeDirectory('userphoto');
                }
                $userimg = Image::make($image)->resize(1600,1600)->save($imagename,90);

                Storage::disk('public')->put('userphoto/'.$imagename,$userimg);
            }
            else
            {
                $imagename = 'default.png';
            }

            $newUser = User::create([
                'role_id' => Role::where('slug','user')->first()->id,
                'name' => $user->getNickname(),
                'email' => $user->getEmail(),
                'status' => true,
                'image' => $imagename,
                ]);

            Auth::login($newUser);
        }
        return redirect($this->redirectPath());
    }
}
