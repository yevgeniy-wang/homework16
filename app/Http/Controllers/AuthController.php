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

        if (User::where('name', $request['name'])->get()->count()) {

            if (Auth::attempt($data)) {

                if (Hash::needsRehash(User::find(Auth::id())->password)) {
                    $user = User::find(Auth::id());
                    $user->password
                        = Hash::make($request->only('password')['password']);
                    $user->save();
                }

                return redirect()->route('home');
            }
        } else {
            $data['password']
                = Hash::make($request->only('password')['password']);

            $user = User::create($data);

            if (Auth::attempt($request->only('name', 'password'))) {

                return redirect()->route('home');
            }
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

