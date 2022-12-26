@extends('layouts.app')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Edit Permission</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5">
                    <form class="login-form" method="POST" action="{{ route('permissions.update', $permission) }}"> 
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" name="name" class="form-control rounded-left" placeholder="Name" value="{{ $permission->name }}"  required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
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
