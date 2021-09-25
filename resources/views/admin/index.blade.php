@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')

    <h1 class="text-center mt-5">Welcome to the Admin page</h1>
<div class="w-75 mx-auto mt-5">
    <table class="table table-hover ">
        <thead>
          <tr class="text-center">
            <th scope="col">#id</th>
            <th scope="col" class="w-25">Name</th>
            <th scope="col" class="w-25">Email</th>
            <th scope="col" class="w-25">Password</th>
            <th scope="col">Admin</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            
            @if ($item->email == auth()->user()->email)
                <tr class="text-center table-active">
            @else
                <tr class="text-center">
            @endif

            <!--<tr class="text-center">-->
                <th scope="row">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td class="defaultCursor" title="Current password hidden for security reasons">●●●●●●●</td>
                @if ($item->is_admin)
                    <td><i class="fas fa-crown" title="This user has admin privileges"></i></td>
                @else
                    <td></td>
                @endif
                <td class="d-flex justify-content-end align-middle">
            
                    <button class="no-effect"><a href="{{ route('admin.edit', $item->id) }}"><i class="fas fa-user-edit mx-1" title="Edit User"></i></a></button>
  
                    <form method="POST" action="{{ route('admin.destroy', $item->id) }}">
                        @csrf
                        @method('delete')
                        
                        @if ($item->email == auth()->user()->email)
                            <button class="no-effect" disabled><i class="fas fa-trash-alt pe-none" title="You can't delete yourself"></i></button>
                        @else
                            <button class="no-effect"><i class="fas fa-trash-alt" title="Delete User"></i></button>
                        @endif
                    </form>
                </td>
            </tr> 

            @endforeach

        </tbody>
      </table>

      <div class="text-center mt-4">
        <a href="{{ route('admin.create') }}" class="ola" title="Add new user to Database"><i class="fas fa-plus-square fa-2x"></i></a>
      </div>
    </div>
@endsection