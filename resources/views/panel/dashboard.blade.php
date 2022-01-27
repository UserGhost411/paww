@extends('layout.app')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Dokumen</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0"><?= $status[0] ?></h2>

                        </div>
                        <h6 class="text-muted font-weight-normal">Dokumen yang terhandle</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-book-multiple text-primary ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Pengguna</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0"><?= $status[1] ?></h2>
                        </div>
                        <h6 class="text-muted font-weight-normal">Pengguna bergabung</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-account-multiple text-warning ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Instansi</h5>
                <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                            <h2 class="mb-0"><?= $status[2] ?></h2>
                        </div>
                        <h6 class="text-muted font-weight-normal">Instansi Bermitra</h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-share-variant text-success ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dokumen Aktif / Sedang di Proses</h4>
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
                                    <span class="pl-2">{{ $val->doc_title }}</span>
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
<div class="row">
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Linimasa</h4>
                @foreach ($linamasa as $val)
                <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                    <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Dokumen {{ $statustext[$val->doc_status] }}</h6>
                        <p class="text-muted mb-0">{{ date("d M Y, H:i",strtotime($val->updated_at)) }}</p>
                    </div>
                    <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">
                            <div class="badge badge-outline-success">{{ $val->last_actor }}</div>
                        </h6>
                    </div>
                </div>
                @endforeach
         
            </div>
        </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h4 class="card-title mb-1">Open Projects</h4>
                    <p class="text-muted mb-1">Your data status</p>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="preview-list">
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-primary">
                                        <i class="mdi mdi-file-document"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">Admin dashboard design</h6>
                                        <p class="text-muted mb-0">Broadcast web app mockup</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">15 minutes ago</p>
                                        <p class="text-muted mb-0">30 tasks, 5 issues </p>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-cloud-download"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">Wordpress Development</h6>
                                        <p class="text-muted mb-0">Upload new design</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">1 hour ago</p>
                                        <p class="text-muted mb-0">23 tasks, 5 issues </p>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-clock"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">Project meeting</h6>
                                        <p class="text-muted mb-0">New project discussion</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">35 minutes ago</p>
                                        <p class="text-muted mb-0">15 tasks, 2 issues</p>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <i class="mdi mdi-email-open"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">Broadcast Mail</h6>
                                        <p class="text-muted mb-0">Sent release details to team</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">55 minutes ago</p>
                                        <p class="text-muted mb-0">35 tasks, 7 issues </p>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-chart-pie"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject">UI Design</h6>
                                        <p class="text-muted mb-0">New application planning</p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted">50 minutes ago</p>
                                        <p class="text-muted mb-0">27 tasks, 4 issues </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection