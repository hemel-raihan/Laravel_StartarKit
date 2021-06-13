<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.users.index');
        $users = User::all();
        $auth = Auth::user();
        return view('backend.users.index',compact('users','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.users.create');
        $roles = Role::all();
        $auth = Auth::user();
        return view('backend.users.create',compact('roles','auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.users.create');
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id'=> 'required|numeric',
            'password' => 'required|confirmed|string|min:8',
            'avatar' => 'required|image'
        ]);

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
            $userimg = Image::make($image)->resize(1600,1600)->save($imagename,90);

            Storage::disk('public')->put('userphoto/'.$imagename,$userimg);
        }
        else
        {
            $imagename = 'default.png';
        }

        $user = User::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagename,
            'status' => $request->filled('status')

        ]);

       /* if($request->hasFile('avatar'))
        {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }*/

        notify()->success("User Addeed",'success');
        return redirect()->route('app.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        Gate::authorize('app.users.index');
        return view('backend.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('app.users.edit');
        $roles = Role::all();
        $auth = Auth::user();
        return view('backend.users.create',compact('roles','auth','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('app.users.edit');
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id'=> 'required|numeric',
            'password' => 'nullable|confirmed|string|min:8',
            'avatar' => 'nullable|image'
        ]);

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
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'image' => $imagename,
            'status' => $request->filled('status')

        ]);

        /*if($request->hasFile('avatar'))
        {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }*/

        notify()->success("User Updated Successfully",'success');
        return redirect()->route('app.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Gate::authorize('app.users.destroy');
        $user->delete();
        notify()->success("Role Successfully Deleted","Delete");
        return back();
    }
}
