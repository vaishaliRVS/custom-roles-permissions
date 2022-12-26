@extends('layouts.app')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">New User</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <form class="login-form" method="POST" action="{{ route('users.store') }}"> 
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control rounded-left" placeholder="Name" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control rounded-left" placeholder="Username" required>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <select name="role" class="form-control rounded-left" >
                                @foreach ($roles as $role)
                                  <option value="{{ $role->id }}">{{ $role->name }}</option>              
                                @endforeach
                              </select>
                            @if ($errors->has('role'))
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
                        </div>

                        <div class="form-group d-flex">
                            <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Submit</button>
                        </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
