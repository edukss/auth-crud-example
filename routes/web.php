<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;


// Home view
// no podemos ir a Home si no estamos logged (middleware)
Route::get('/', function () { return view('home');})
    ->name('home')
    ->middleware('auth');

Route::group(['prefix'  => 'login'], function(){
    // Login view
    // no podemos ir a /login si ya estamos logged (middleware)
    Route::get('/', [SessionController::class, 'index'])
    ->name('login.index')
    ->middleware('guest'); 

    // miramos/validamos si los datos de login coinciden con la BBDD
    Route::post('/', [SessionController::class, 'store'])->name('login.store');
});

Route::group(['prefix'  => 'register'], function(){
    // Register view
    // no podemos ir a /register si ya estamos logged
    Route::get('/', [RegisterController::class, 'index'])
    ->name('register.index')
    ->middleware('guest');

    // validamos el formulario de registro
    Route::post('/', [RegisterController::class, 'store'])->name('register.store');
});

Route::group(['prefix' => 'admin'], function(){
    // Admin view
    // no podemos ir a /admin si el usuraio logged no es admin (middleware)
    // custom middleware para saber si is_admin == 1 en la bbdd (en kernel se crean los custom middlewares)
    Route::get('/', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('auth.admin');

    // añadir nuevo usuario siendo admin (view)
    Route::get('/create', [AdminController::class, 'create'])
    ->name('admin.create')
    ->middleware('auth.admin');

    // cogemos la info del form del admin creando un new user
    Route::post('/create', [AdminController::class, 'store'])
    ->name('admin.store');

    // resource para encargarse de POST y GET, sobretodo bien usarlo en CRUD (muchas rutas)
    // RESTfull
    Route::resource('admin', AdminController::class)
    ->middleware('auth.admin');
});

// Log Out view
// no podemos ir a /logout si no estamos logged (middleware)
Route::get('/logout', [SessionController::class, 'destroy'])
    ->name('login.destroy')
    ->middleware('auth');