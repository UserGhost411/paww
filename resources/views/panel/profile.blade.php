@extends('layout.app')
@section('title', 'Profile')
@section('content')
<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="text-align:center">
                    <img style="margin-bottom:20px;"class="profile-user-img img-fluid rounded-circle" src="{{ Auth::user()->pp }}" id="mypp" alt="User profile picture">
                    <br>
                    <button class="btn btn-primary btn-fw" onclick="sel_upload('{{ route('profile.upload') }}','{{ csrf_token() }}','{{ asset('img/loading.gif') }}')">Ubah Gambar</button>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-9 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile</h4>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" class="form-control" name="username" id="exampleInputName1" placeholder="Enter Username" value="{{ $profile->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Display Name</label>
                        <input type="text" class="form-control" name="displayname" id="exampleInputName1" placeholder="Enter Display name" value="{{ $profile->displayname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputName1" placeholder="Enter Email" value="{{ $profile->email }}" required>
                    </div>
                    <button class="btn btn-primary btn-fw" type="submit">Simpan Profile</button>
                    <button class="btn btn-primary btn-fw float-rigth" >Ubah Password</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection