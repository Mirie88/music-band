<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Music;
use App\Models\Event;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
        $users = User::all();

        return view('users.users', ['users' => $users]); 
     }
    public function showregform()
    {
        return view("users.register");
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('ok');
        $validatedrequest = $request->validate([
            "name"=> ['required', 'min:3'] ,
            "email"=>"required|email|unique:users",
            "password"=>"required"
          ]);
        
        //   dd($validatedrequest);
        $user = User::create($validatedrequest);

        Auth::login($user);

       return redirect()->route('index');
}

    public function showlogform()
    {
    return view('users.login');
    }

    public function login(Request $request)
    {
        $logindetails = $request->validate([
            "email"=> ['required', 'email'],
            "password"=>"required"
        ]);

        if(Auth::guard('web')->attempt($logindetails))
        {
            return redirect()->route('index');
        }

        return back()->withErrors([
            'loginFailed' => 'Email or password error!'
        ]);
        //  dd($logindetails);   
        
    }
    public function home()
    {
        $musics = Music::get();
        $events =Event::all();
        return view('home', compact('musics', 'events'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
       // return view('users.register', ["music"=>$music]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
       if ($user){
        $user->delete();

        return redirect()->back()->with('success', 'User Deleted successfully');
       }

    
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('login');
    }
}
