@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">My Profile</div>
                <div class="card-body">
                    <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            @if($user->avatar)
                            <img src="{{ asset("storage/$user->avatar") }}" alt="Avatar" class="avatar" ><br>
                            @endif
                            <label for="exampleInputEmail1">Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @if($errors->has('avatar'))
                                <span class="text-danger">{{ $errors->first('avatar') }}</span>
                           @endif
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Name</label>
                          <input type="text" name="name"class="form-control" name="name"id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name" value="{{ $user->name ?? old('name') }}">

                          @if($errors->has('name'))
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" class="form-control" name="name"id="exampleInputEmail1" aria-describedby="emailHelp" disabled value="{{ $user->email }}">
                          </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                    <form action="{{ route('change_password') }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="password" name="password"class="form-control" name="name"id="exampleInputEmail1">
                            @if($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                           @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm Password</label>
                            <input type="password" name="password_confirmation"class="form-control" name="name"id="exampleInputEmail1">
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
