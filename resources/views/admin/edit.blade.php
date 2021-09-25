@extends('layouts.app')

@section('title', 'Edit User - Admin Panel')

@section('content')

<div class="mx-auto my-4 w-25 p-4 border rounded box-shadow">
    <a href="{{ route('admin.index') }}" title="Cancel"><i class="fas fa-sign-out-alt d-flex justify-content-end"></i></a>
    <h1 class="text-center">Edit User</h1>
    <img class="" style="object-fit: none" src="https://cdn.dribbble.com/users/398490/screenshots/1716348/media/f43e754459daf01d66ab19ed988c0102.gif" width="330" height="200" alt="This will display an animated GIF" />

    <form method="POST" action="{{ route('admin.update', $user->id) }}"> 
        @csrf
        @method('put')
        <input type="text" class="form-control " placeholder="Name" id="name" name="name" value="{{ $user->name }}" required>
        <input type="email" class="form-control my-3" placeholder="Email" id="email" name="email" value="{{ $user->email }}" required>
            @error('email')
            <p class="bg-danger bg-gradient rounded text-white bold p-1">{{ $message }}</p>
            @enderror
        
        <input type="password" class="form-control my-3" placeholder="Password" id="password" name="password" >
        <input type="password" class="form-control my-3" placeholder="Password Confirmation" id="password_confirmation" name="password_confirmation" >
            @error('password')
            <p class="bg-danger bg-gradient rounded text-white bold p-1">{{ $message }}</p>
            @enderror

            <div class="form-check">
                @if( $user->is_admin == 1 )
                    <input class="form-check-input" type="checkbox" checked id="isAdmin" name="isAdmin">    
                @else
                    <input class="form-check-input" type="checkbox" id="isAdmin" name="isAdmin">
                @endif
                <label class="form-check-label" for="isAdmin">
                  Admin Privileges
                </label>
            </div>

        <button type="submit" class="btn btn-primary w-100 mt-4" >Save</button>
    </form>
</div>

@endsection