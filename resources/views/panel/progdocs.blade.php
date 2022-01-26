@extends('layout.app')
@section('title', 'Buat Dokumen Baru')
@section('content')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                
                                <th> Judul </th>
                                <th> Kategory </th>
                                <th> Requester </th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doc as $val)
                            
                            @if($a::checkif($val->id))
                            <tr>
                                <td>
                                    <span class="pl-2"><a href="{{ route('document.show',[$val->id]) }}">{{ $val->doc_title }}</a> {{ $val->id }} {{ $val->doc_flow }}</span>
                                </td>
                                <td> {{ $val->docflow_title }} </td>
                                <td> {{ $val->displayname }} </td>
                                <td> <a href="{{ route('process.show',[$val->id]) }}" class="btn btn-outline-success">Proses</a> </td>
                            </tr>
                            @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection