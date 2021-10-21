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
           'username' => 'required|max:255|min:4',
           'email' => 'required|email|max:255', //more info in Laravel website, VALIDATION section
           'password' => 'required|min:8|max:255',
//            'password' => ['required','min:8','max:255'],
        ]);

        User::create($attributes);

        return redirect('/');
    }
}
