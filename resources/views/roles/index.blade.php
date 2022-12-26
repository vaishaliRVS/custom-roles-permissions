@extends('layouts.app')
<div class="container mt-5">
    <h2 class="text-center">Roles</h2>
    {{-- <pre>
        {{ Auth::user()->hasPermission('role-create') }} 
    </pre> --}}
     {{-- @can('role-create', \App\Models\Permission::class) --}}
       <a class="btn btn-success" href="{{route('roles.create')}}">Create</a> 
     {{-- @endcan  --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            
        @foreach ($roles as $role)
                <tr>
                    <td>{{$role->name}}</td>
                    <td>
                        @if ($role->name == "admin")  
                            -
                        @else 
                                <a href="{{route('roles.edit', $role->id)}}">Edit</a>                           
                                <form method="POST" action="{{route('roles.destroy', $role->id)}}"  onsubmit="return confirm('Are you sure?');">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="form-group">
                                        <input type="submit"  value="Delete">
                                    </div>
                                </form>
                        @endif
                    </td> 
                </tr>
        @endforeach     
        </tbody>
    </table>
</div>
