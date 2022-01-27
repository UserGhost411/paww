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
                               
                                <th> Judul </th>
                                <th> Total Alur </th>
                                <th> Flow diubah </th>
                                <th> Kategory </th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($docflow as $val)
                            <tr>
                                <td>
                                    <span class="pl-2">{{ $val->docflow_title }}</span>
                                </td>
                                <td> {{ $val->total_flow }} </td>
                                <td> {{ date("d/m/Y H:i:s",strtotime($val->updated_at)) }} </td>
                                <td> {{ $val->category_name }} </td>
                                <td> <a href="{{ route('documentflow.show',$val->id) }}" class="btn btn-success">Periksa</a> </td>
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