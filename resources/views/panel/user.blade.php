@extends('layout.app')
@section('title', 'Profile')
@section('content')
<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="text-align:center">
                    <img style="margin-bottom:20px;"class="profile-user-img img-fluid rounded-circle" src="{{ $user->pp }}" id="mypp" alt="User profile picture">
                    <br>
                    
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile</h4>
                <form method="POST" action="{{ route('user.update',[$user->id]) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" class="form-control" name="username" id="exampleInputName1" placeholder="Enter Username" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Display Name</label>
                        <input type="text" class="form-control" name="displayname" id="exampleInputName1" placeholder="Enter Display name" value="{{ $user->displayname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputName1" placeholder="Enter Email" value="{{ $user->email }}" required>
                    </div>
                    <button class="btn btn-primary btn-fw" type="submit">Simpan Profile</button>
                   
                </form>

            </div>
        </div>
    </div>
</div>
@endsection