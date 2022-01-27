@extends('layout.app')
@section('title', 'Informasi Dokumen')
@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Dokumen</h4>
                <div class="form-group">
                    <label for="exampleInputName1">Judul Dokumen</label>
                    <input type="text" class="form-control" name="title" id="exampleInputName1" placeholder="..." value=" {{ $doc->doc_title }}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Deskripsi</label>
                    <textarea name="des" class="form-control" id="exampleTextarea1" rows="4" placeholder="..." readonly>{{ $doc->doc_description }}</textarea>
                </div>
                @if($doc->doc_status<1)
                <form method="POST" action="{{ route('document.update',[$doc->id]) }}" style="text-align:center;">
                    @csrf
                    @method('put')
                    <input type="hidden" name="xx" value="1"/>
                    <button type="submit" name="act" value="acc" class="btn btn-danger btn-fw">Batalkan Dokumen</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Timeline Dokumen</h4>
                <ul class="timeline">
                    @foreach ($flows as $val)
                    <li>
                        <div class="name">{{ $val->flow_title }}
                            <div class="status">
                                <div class="badge badge-outline-{{ ($val->process_status==null)?$statusclass[0]:$statusclass[$val->process_status] }}">{{ ($val->process_status==null)?$statustext[0]:$statustext[$val->process_status] }}</div>
                            </div>
                        </div>
                        <div class="subname">{{ $val->displayname }}
                            @if( $val->process_status!=null )
                            | <span data-toggle='tooltip' title='{{ date("d/m/Y H:i:s",strtotime($val->updated_at)) }}'>{{date("d/m H:i",strtotime($val->updated_at))}}</span>
                            @endif
                        </div>
                        <p>{{ ($val->process_status==null)?$statusdes[0]:(($val->process_reason=="")?$statusdes[$val->process_status]:$val->process_reason) }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Flow Dokumen</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Proses Flow </th>
                                <th> Actor </th>
                                <th> Keterangan </th>
                                <th> Status </th>
                                <th> Waktu </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $val)
                            <tr>
                                <td>
                                    <span class="pl-2"><a href="{{ route('document.show',[$val->id]) }}">{{ $val->flow_title }}</a></span>
                                </td>
                                <td>
                                    <div class="badge badge-outline-success">{{ $val->displayname }}</div>
                                </td>
                                <td>
                                    {{ ($val->log_status==null)?$statusdes[0]:(($val->log_reason=="")?$statusdes[$val->log_status]:$val->log_reason) }}
                                </td>
                                <td>
                                    <div class="badge badge-outline-{{ $statusclass[$val->log_status] }}">{{ $statustext[$val->log_status] }}</div>
                                </td>
                                <td>
                                    {{ date("d/m/Y H:i:s",strtotime($val->updated_at)) }}
                                </td>


                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin">
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
                                    <a href="{{ route('document.download',[$val->id]) }}" class="btn btn-outline-success"><span class="fa fa-download"></span></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection