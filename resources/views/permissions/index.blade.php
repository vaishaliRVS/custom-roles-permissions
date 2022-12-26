@extends('layouts.app')
<div class="container mt-5">
    <h2 class="text-center">Permission</h2>
    <a class="btn btn-success" href="{{route('permissions.create')}}">Create</a> 
    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{$permission->name}}</td>
                <td>
                    <a href="{{route('permissions.edit', $permission->id)}}">Edit</a>
                    <form method="POST" action="{{route('permissions.destroy', $permission->id)}}"  onsubmit="return confirm('Are you sure?');">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                            <div class="form-group">
                          <input type="submit"  value="Delete">
                        </div>
                      </form>
                </td> 
            </tr>
        @endforeach     
        </tbody>
    </table>
</div>

  