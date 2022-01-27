@extends('layout.app')
@section('title', 'Profile : Change Password')
@section('content')
<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Password</h4>
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputName1" placeholder="Enter new password" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Re-Password</label>
                        <input type="password" class="form-control" name="repassword" id="exampleInputName1" placeholder="Enter again" value="" required>
                    </div>
                    <center><button type="submit" class="btn btn-primary btn-fw" >Ubah Password</button></center>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection