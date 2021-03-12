<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{

    public function login()
    {
        return view("pages.login");
    }

    public function handleLogin(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required'],
            'password' => ['required', 'min:8'],
        ]);

        if (null === ($user = User::where('name', $data['name'])->first())) {

            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            Auth::login($user);

            return redirect()->route('home')
                ->with('success', 'You have successfully logged in');
        }

        if (Hash::check($data['password'], $user->password)) {

            Auth::login($user);

            return redirect()->route('home')
                ->with('success', 'You have successfully logged in');
        }

        return back()->withErrors([
            'password' => 'Incorrect email or password',
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');

    }
}

