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
     /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        return view("user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $user =  User::create(collect($validated)->all());
        
        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    /**
     * Shoiw Login User form
     */
    public function login()
    {
        return view("user.login");
    }

    /**
     * Login User
     */
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
    }

    /**
     * Logout User
     */
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }

    /**
     * Show User/Admin Dashboard
     */
    public function dashboard()
    {
        if(Auth::user()->role_id != 1){ 
            return view('user.dashboard');
        } else {
            return view('admin.dashboard');
        }
    }
}
