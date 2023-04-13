<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show create user form
    public function create(){
        return view('users.register');
    }

    // create new user
    public function store(Request $request) {
        // fields and validation
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);
        // password encryption
        $formFields['password'] = bcrypt($formFields['password']);
        // user creation
        $user = User::create($formFields);
        // login after user creation
        auth()->login($user);
        return redirect('/')->with('message', 'user is created successfully and logged in');
    }

    // log user out
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out');
    }

    // show login form
    public function login() {
        return view('users.login');
    }

    // log user in
    public function authenticate(Request $request) {
        // fields and validation
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        // trying to log user in
        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'you are logged in');
        }
        // if the attempt fail
        return back()->withErrors(['email' => 'Invalid credintials'])->onlyInput('email');
    }
}
