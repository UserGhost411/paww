@extends('layout.app')
@section('title', 'Ubah Nilai Flow')
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Nilai Flow</h4>

                <form method="POST" action="{{ route('documentflow.update',$flow->id) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleInputName1">Judul Flow</label>
                        <input type="text" class="form-control" name="title" value="{{$flow->flow_title}}" placeholder="Masukan Judul Dokumen">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Actor Flow</label>
                        <select class="form-control" name="actor" id="exampleSelectGender">
                            @foreach ($actors as $val)
                            <option value="{{ $val->id }}" {{ ($flow->flow_actor==$val->id)?'selected':'' }}>{{ $val->displayname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleSelectGender">Actor dapat Menolak</label>
                                <select class="form-control" name="decline" id="exampleSelectGender">
                                    <option value="1" {{ $flow->actor_can_decline?'selected':'' }}>Ya</option>
                                    <option value="0" {{ $flow->actor_can_decline?'':'selected' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleSelectGender">Actor dapat Menambahkan File</label>
                                <select class="form-control" name="commit" id="exampleSelectGender">
                                    <option value="1" {{ $flow->actor_can_commit?'selected':'' }}>Ya</option>
                                    <option value="0" {{ $flow->actor_can_commit?'':'selected' }}>Tidak</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea1">Deskripsi Flow</label>
                        <textarea name="des" class="form-control" rows="4" placeholder="Masukan Deskripsi">{{ $flow->flow_description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection