@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="mx-auto my-5 w-25 p-4 border rounded box-shadow">
    <h1 class="text-center">Register</h1>

    <form class="" method="POST" actions=""> 
        @csrf
        <input type="text" class="form-control my-3" placeholder="Name" id="name" name="name" required>
        <input type="email" class="form-control my-3" placeholder="Email" id="email" name="email" required>
            @error('email')
            <p class="bg-danger bg-gradient rounded text-white bold p-1">{{ $message }}</p>
            @enderror
        
        <input type="password" class="form-control my-3" placeholder="Password" id="password" name="password" required>
        <input type="password" class="form-control my-3" placeholder="Password Confirmation" id="password_confirmation" name="password_confirmation" required>
            @error('password')
            <p class="bg-danger bg-gradient rounded text-white bold p-1">{{ $message }}</p>
            @enderror

        <button type="submit" class="btn btn-primary w-100" >Register</button>
    </form>
</div>

@endsection