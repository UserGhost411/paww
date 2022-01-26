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
                                <th>
                                    <div class="form-check form-check-muted m-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">
                                        </label>
                                    </div>
                                </th>
                                <th> Judul </th>
                                <th> Tujuan </th>
                                <th> Persentase </th>
                                <th> Kategory </th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($doc as $val)
                            <tr>
                                <td>
                                    <div class="form-check form-check-muted m-0">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input">
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <span class="pl-2"><a href="{{ route('document.show',[$val->id]) }}">{{ $val->doc_title }}</a></span>
                                </td>
                                <td>
                                    <div class="badge badge-outline-success">{{ $val->last_actor }}</div>
                                </td>
                                <td>
                                    <div class="progress progress-md portfolio-progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ round($val->flow_active_step/$val->flow_total_step*100) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ round($val->flow_active_step/$val->flow_total_step*100) }}%</div>
                                    </div>
                                </td>
                                <td> {{ $val->docflow_title }} </td>
                                <td>
                                    <div class="badge badge-outline-{{ $statusclass[$val->doc_status] }}">{{ $statustext[$val->doc_status] }}</div>
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