@extends('layouts.app')
<section class="ftco-section">
    <div class="container mt-5">
        <h2 class="text-center">Users</h2>
        <a class="btn btn-success" href="{{route('users.create')}}">Create</a> 
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
            </tr>
            </thead>
            <tbody>    
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        @foreach ($roles as $role)
                            @if ($role->id == $user->role)
                                <td>{{ $role->name }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach           
            </tbody>
        </table>
    </div>
</section>
