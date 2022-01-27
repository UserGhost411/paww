@extends('layout.app')
@section('title', 'Buat Dokumen Baru')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Submit Dokumen Baru</h4>
                <p class="card-description"> Buat Dokumen Baru </p>
                <form method="POST" action="{{ route('document.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Judul Dokumen</label>
                        <input type="text" class="form-control" name="title" id="exampleInputName1" placeholder="Masukan Judul Dokumen">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Flow Dokumen</label>
                        <select class="form-control" name="flow" id="exampleSelectGender">
                            @foreach ($doc as $val)
                            <option value="{{ $val->id }}">{{ $val->docflow_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Unggah Dokumen</label>
                        <input type="file" name="docfile" class="file-upload-default" required>
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Unggah Dokumen">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                            </span>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="exampleTextarea1">Deskripsi</label>
                        <textarea name="des" class="form-control" id="exampleTextarea1" rows="4" placeholder="Masukan Deskripsi Kebutuhan Dokumen yang akan di submit"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection