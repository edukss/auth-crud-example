@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="mx-auto my-5 w-25 p-4 border rounded box-shadow">
    <h1 class="text-center">Login</h1>

    <form class="" method="POST" actions=""> 
        @csrf
        <input type="email" class="form-control my-3" placeholder="Email" id="email" name="email" required>
        <input type="password" class="form-control my-3" placeholder="Password" id="password" name="password" required>

        @error('message')
        <p class="bg-danger bg-gradient rounded text-white bold p-1">{{ $message }}</p>
        @enderror
        
        <button type="submit" class="btn btn-primary w-100" >Log In</button>
    </form>
</div>

@endsection