<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SessionController extends Controller
{
    // devolvemos la vista de /login
    public function index(){
        return view('auth.login');
    }

    // hacemos login
    // validamos form de loggin (match con la bbdd) los valores del array se usan para encontrar el usuario en la bbdd
    // si detectamos que el loggeo es de un admin, redireccionamos a la view de admin, sino a la view home
    public function store(){
        if(auth()->attempt(request(['email', 'password'])) == false){
            return back()->withErrors(['message' => 'Email or password incorrect. Try again.']);
        }else{
            if(auth()->user()->is_admin){
                return redirect()->route('admin.index');
            }else{
                return redirect()->to('/');
            }
        }
    }

    // funcion de logout
    public function destroy(){
        auth()->logout();

        return redirect()->to('/');
    }
}
