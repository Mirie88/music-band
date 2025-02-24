<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Music;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminregform()
    {
        return view('admins.adminregister');
    }

    public function storeadmin(Request $request)
    {
    $validatedinfo = $request->validate([
        'username'=>['required', 'min:3', 'unique:admins'],
        'email'=> ['required', 'email'],
        'password'=> 'required'
        
    ]);

         // dd($validatedinfo);
         $validatedinfo['password'] = Hash::make($validatedinfo['password']);

         $admin = Admin::create($validatedinfo);

         Auth::guard('admin')->login($admin);

         return redirect()->Route('admins.dashboard');
    }

    public function adminlogform()
    {
         return view('admins.adminlogin');
    }
    public function adminlogin(Request $request)
    {
  try {
    $loginfields = $request->validate([
        'email'=> ['required', 'email'],
        'password'=> 'required'
    ]);

    if(Auth::guard('admin')->attempt($loginfields))
    {
        return redirect()->Route('admins.dashboard');
    }

    return back()->with('error', 'Invalid Logins');
    // dd($loginfields);
  } catch (\Exception $e) {
    return redirect()->back()->with('error',$e->getMessage());
  }
    }

    public function dashboard(){
      $musics = Music::all();
      $users = User::all();
      return view('admins.dashboard', ["musics"=>$musics, "users"=>$users]);
    }

}
    


