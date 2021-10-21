<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
           'name' => 'required|max:255',
           'username' => 'required|max:255|min:4|max:255|unique:users,username',
//           'username' => ['required','max:255','min:4','max:255', Rule::unique('user', 'username')],
           'email' => 'required|email|max:255|unique:users,email', //more info in Laravel website, VALIDATION section
           'password' => 'required|min:8|max:255',
//            'password' => ['required','min:8','max:255'],
        ]);

        User::create($attributes);

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
