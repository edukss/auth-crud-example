<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    // devolvemos la vista /register
    public function index(){
        return view('auth.register');
    }

    
    // validamos form de register, insertamos en la bbdd, y loggeamos
    public function store(){

        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create(request(['name', 'email', 'password']));

        auth()->login($user);
        return redirect()->to('/');
    }
}
