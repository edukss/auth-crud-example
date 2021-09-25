<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    // devolvemos la vista admin
    public function index(){
        
        // volcamos la tabla users de la bbdd en la variable $users
        $users = User::all();

        //dd(Crypt::decrypt($users[0]->password));
        /*if(auth()->user()->is_admin){
            return 'es admin';
        }*/
        
        // retornamos la vista pasandole un array de users
        return view('admin.index', compact('users'));
    }

    public function create(){
        return view('admin.create');
    }

    // funcion para guardar un usuario que cree el admin
    // primero validamos los campos
    public function store(Request $request){
        
        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        if( $request->has('isAdmin')){
            $user->is_admin = 1;
        }else{
            $user->is_admin = 0;
        }

        $user->save();
        
        /* 
        este metodo no se puede usar xq el User es fillable, deberia ser guarded para poder llenar el isAdmin
            $user = User::create(request(['name', 'email', 'password', 'valor']));
            $user = User::create(['name'=>$request('name'), 'email'=>request('email').....]);
        */
        return redirect()->route('admin.index');
    }

    // eliminar user de la bbdd en modo admin
    public function destroy( $id ){
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.index');
    }

    // vista edit que recibe el id del user clickado en la tabla y así mostrar los campos del formulario llenos
    public function edit( $id ){
        $user = User::find($id);
        
        return view('admin.edit', compact('user'));
    }

    // update sql de la bbdd con los campos
    // pero antes validamos
    public function update( Request $request, $id ){

        $user = User::find($id);
        
        // para poder dejar el mismo mail en el usuario clickado
        if( $user->email == $request->email ){
            $this->validate(request(),[
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'sometimes|confirmed',
            ]);
        }else{
            $this->validate(request(),[
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'sometimes|confirmed',
            ]);
        }

        //$user->update($request->all());

        $user->name = $request->name;
        $user->email = $request->email;
        // si el input de la password esta vacia, no updateamos la password del usuario
        if( !empty($request->password )){
            $user->password = $request->password;
        }
        
        if( $request->has('isAdmin')){
            $user->is_admin = 1;
        }else{
            $user->is_admin = 0;
        }

        $user->save();

        // miramos si nos hemos quitado permisos a nosotros mismos
        if(auth()->user()->is_admin){
            return redirect()->route('admin.index');
        }else{
            return redirect()->to('/');
        }
    }
}
