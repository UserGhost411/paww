@extends('layout.app')
@section('title', 'Buat Dokumen Baru')
@section('content')
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Pengguna</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Username </th>
                                <th> DisplayName </th>
                                <th> Level </th>
                                <th> Email </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $val)
                            <tr>
                                <td>
                                    {{ $val->username }}
                                </td>
                                <td>
                                    {{ $val->displayname }}
                                </td>
                                <td>
                                    <div class="badge badge-outline-success">{{ $priv[$val->level] }}</div>
                                </td>
                                
                                <td> {{ $val->email }} </td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('user.show',[$val->id]) }}">Periksa</a>
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