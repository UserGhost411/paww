@extends('layout.app')
@section('title', 'Buat Dokumen Baru')
@section('content')
<div class="row ">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $title }}</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Judul Alur </th>
                                <th> Deskripsi Alur </th>
                                <th> Actor Alur </th>
                                <th> Allow Decline </th>
                                <th> Allow Commit </th>
                                <th> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($flows as $val)
                            <tr>
                                <td>
                                    <span class="pl-2">{{ $val->flow_title }}</span>
                                </td>
                                <td> {{ $val->flow_description }} </td>
                                <td> <div class="badge badge-outline-primary">{{ $val->actor }}</div></td>
                                <td> <div class="badge badge-outline-{{ $val->actor_can_decline?'success':'danger' }}">{{ $val->actor_can_decline?'Ya':'Tidak' }}</div></td>
                                <td> <div class="badge badge-outline-{{ $val->actor_can_commit?'success':'danger' }}">{{ $val->actor_can_commit?'Ya':'Tidak' }}</div></td>
                                <td> 
                                    <form method="POST" action="{{ route('documentflow.destroy',[$val->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('documentflow.edit',$val->id) }}" class="btn btn-success">Ubah</a> 
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                               
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
                <br>
                <a href="{{ route('documentflow.create',[$docflow->id]) }}" class="btn btn-success">+ Tambahkan Flow</a> 
            </div>
        </div>
    </div>
</div>
@endsection