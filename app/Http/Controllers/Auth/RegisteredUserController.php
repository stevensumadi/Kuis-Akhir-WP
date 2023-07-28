<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:30', 'min:3'],
            'datingCode' => ['required', 'string', 'regex:/\d\d\d/', 'max:3', 'min:3'],
            'birthDate' => ['required', 'date', 'before:today'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'email:dns'],
            'phoneNumber' => ['required', 'string', 'min:5'],
            'image' => ['required', 'image','file', 'max:1024'],
            'password' => ['required', 'min:5'],
        ]);

        $validatedData['datingID'] = 'SKY'.$request->datingCode.'0'.$request->gender;
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['image'] = $request->file('image')->store('profile-images');

        $user = User::all();

        foreach ($user as $u) {
            if ($u->gender == $request->gender && $u->datingCode == $request->datingCode) {
                return redirect('/register')->with('failed', 'Dating Code have been used');
            }
        }

        $user = User::create($validatedData);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Selamat akun anda berhasil dibuat,
        anda dapat login menggunakan '.$request->email.' atau '.$validatedData['datingID']);
    }
}
