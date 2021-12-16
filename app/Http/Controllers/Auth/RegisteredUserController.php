<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */ 
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:45', 'unique:user'],
            'email' => ['required', 'string', 'email', 'max:45', 'unique:user'],
            'password' => ['required', 'max:32', 'min:6'],
            'nama' => ['required', 'max:45'],
            'no_telpon' => ['required', 'min: 10','max:13', 'unique:user'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'no_telpon' => $request->no_telpon,
            "roles" => $request->roles
        ]);

        // event(new Registered($user));

        // Auth::login($user);

        return redirect("/login")->with(["message", "Register Berhasil", "status" => "success"]);   
    }
}
