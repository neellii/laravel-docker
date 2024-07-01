<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function create() 
    {
        return view("user.create");
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $user =  User::create(collect($validated)->all());
        
        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function login()
    {
        return view("user.login");
    }

    public function loginAuth(UpdateRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route("home"))->with("success","Welcome, " . Auth::user()->name . "!");
        }

        return back()->withErrors([
            "email" => "Wrong email or password",
        ]);
        // dump($request->boolean('remember'));
        // dd($request->all());
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }

    public function dashboard()
    {
        if(Auth::user()->role_id != 1){ 
            return view('user.dashboard');
        } else {
            return view('admin.dashboard');
        }
    }
}
