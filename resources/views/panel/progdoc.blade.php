@extends('layout.app')
@section('title', 'Buat Dokumen Baru')
@section('content')
<div class="row">
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Dokumen</h4>
                <div class="form-group">
                    <label for="exampleInputName1">Judul Dokumen</label>
                    <input type="text" class="form-control" name="title" id="exampleInputName1" placeholder="..." value="{{ $doc->doc_title }}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Deskripsi</label>
                    <textarea name="des" class="form-control" id="exampleTextarea1" rows="4" placeholder="..." readonly>{{ $doc->doc_description }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Dokumen</h4>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td> Requested </td>
                                <td> : </td>
                                <td> {{ date("d/m/Y H:i:s" , strtotime($doc->created_at)) }} </td>
                            </tr>
                            <tr>
                                <td> Requester </td>
                                <td> : </td>
                                <td> {{ $doc->displayname }} </td>
                            </tr>
                            <tr>
                                <td> Kategori </td>
                                <td> : </td>
                                <td> {{ $doc->docflow_title }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form method="POST" action="{{ route('process.update',[$doc->id]) }}">
                    @csrf
                    @method('put')
                    <input type="hidden" name="process_flows" value="{{$myflow->id}}"/>
                    <div style="text-align:center;margin-top:10px;">
                        <button type="submit" name="act" value="acc" class="btn btn-primary mr-2 btn-fw">Setujui Dokumen</button>
                        @if($myflow->actor_can_decline)
                        <button type="submit" name="act" value="dec" class="btn btn-dark btn-fw">Tolak Dokumen</button>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Dokumen</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Nama File </th>
                                <th> Ukuran </th>
                                <th> Uploader </th>
                                <th> Waktu </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $val)
                            <tr>
                                <td>
                                    <span class="pl-2">{{ $val->file_name }}</span>
                                </td>
                                <td> {{ formatBytes(Storage::size($val->file_filepath)) }} </td>
                                <td> {{ $val->displayname }} </td>
                                <td> {{ date("d/m/Y H:i:s",strtotime($val->updated_at)) }} </td>
                                <td>
                                    <form action="{{ route('process.commit.delete',[$val->id]) }}" method="POST">
                                        <a href="{{ route('process.download',[$val->id]) }}" class="btn btn-outline-success"><span class="fa fa-download"></span></a>
                                        @if((!$val->file_origin || $val->file_uploader == Auth::id()) && $myflow->actor_can_commit)
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger"><span class="fa fa-times"></span></a>
                                        @endif
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                @if($myflow->actor_can_commit)
                <form action="{{ route('process.commit.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="doc" value="{{$doc->id}}">
                    <div class="form-group" style="margin-top:12px;">
                        <label>Unggah Dokumen</label>
                        <input type="file" name="docfile" class="file-upload-default" required>
                        <div class="input-group col-xs-12">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button"><i class="fa fa-plus"></i>Pilih File</button>
                            </span>
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Unggah Dokumen">
                            <span class="input-group-append">
                                <button class="btn btn-success" type="submit"><i class="fa fa-upload"></i> Unggah</button>
                            </span>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection