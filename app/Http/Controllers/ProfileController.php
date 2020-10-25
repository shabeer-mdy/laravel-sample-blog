<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Session;
class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'avatar' => 'required|image'
        ]);

        $user = User::find(auth()->id());
        if($request->hasFile('avatar')) {
            if($user->avatar) {
                Storage::delete($user->avatar);
            }
            $path = explode('public',$request->file('avatar')->storePublicly('public/avatars'));
            $user->avatar = $path[1];
        }

        $user->name = $request->name;
        $user->save();

        Session::flash('message', 'Profile data updated successfully');

        return back();
    }

    public function changePassword (Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $user = User::find(auth()->id());
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('message', 'Password updated successfully');
        return back();
    }
}
