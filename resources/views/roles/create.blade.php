@extends('layouts.app')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">New Role</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <form class="login-form" method="POST" action="{{ route('roles.store') }}"> 
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control rounded-left" placeholder="Name" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>                   
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Submit</button>
                        </div>
                      
                    </form>
                    <form class="login-form" method="POST" action=""> 
                        @csrf
                        <div class="form-group">
                            <select name="permission" class="form-control rounded-left" >
                                @foreach ($permissions as $permission)
                                  <option value="{{ $permission->id }}">{{ $permission->name }}</option>              
                                @endforeach
                              </select>
                            @if ($errors->has('permission'))
                            <span class="text-danger">{{ $errors->first('permission') }}</span>
                            @endif
                        </div>                  
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Assign</button>
                        </div>
                      
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</section>
