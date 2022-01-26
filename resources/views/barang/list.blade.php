@extends('layout.app')
@section('title', 'List Page')
@section('content')
<main>
    <div class="container-xl p-5">
        <div class="d-flex justify-content-between align-items-end">
            <h2 class="display-6 mb-0">Barang List</h2>
        </div>
        <hr class="mt-2 mb-5" />
        <div class="row gx-5">
            <!-- Projects column-->
            <div class="col-12">
            @if ($message = Session::get('info'))
                <div class="alert alert-success alert-block"><strong>{{ $message }}</strong></div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
            <div class="col-12">
                <div class="card card-raised h-100 overflow-hidden">
                    <div class="card-header bg-primary text-white px-4">
                        <div class="fw-500">Barang</div>
                    </div>
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <tbody class="align-middle"></tbody>
                                <thead class="text-xs font-monospace">
                                    <tr>
                                        <td class="px-4 py-2 border-bottom-0 text-muted">Nama Barang</td>
                                        <td class="px-4 py-2 border-bottom-0 text-muted">Kode Barang</td>
                                        <td class="px-4 py-2 border-bottom-0 text-muted">Harga Barang</td>
                                        <td class="px-4 py-2 border-bottom-0 text-muted">Satuan Barang</td>
                                        <td class="px-4 py-2 border-bottom-0 text-muted text-end">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $val)
                                    <tr>
                                        <td class="px-4 border-top">
                                            <div class="d-flex align-items-center">
                                                <i class="material-icons text-muted me-2">work</i>
                                                {{ $val->nama_barang }}
                                            </div>
                                        </td>
                                        <td class="px-4 border-top">{{ $val->kode_barang }}</td>
                                        <td class="px-4 border-top">Rp {{ number_format($val->harga_barang,0,',','.') }}</td>
                                        <td class="px-4 border-top">{{ $val->satuan->nama_satuan }} ({{ $val->satuan->kode_satuan }})</td>

                                        <td class="px-4 border-top text-end">
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" id="dropdownMenuIconsButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Menu<i class="trailing-icon material-icons dropdown-caret">arrow_drop_down</i></button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuIconsButton" style="min-width: 17.5rem;">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('barang.index') }}">
                                                            <i class="material-icons leading-icon">refresh</i>
                                                            Refresh
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('barang.edit',[$val]) }}">
                                                            <i class="material-icons leading-icon">edit_note</i>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                    <form action="{{ route('barang.destroy',[$val]) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="material-icons leading-icon">delete</i>
                                                            Delete</button>
                                                    </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer bg-transparent position-relative ripple-gray">
                            <a class="d-flex align-items-center justify-content-end text-decoration-none stretched-link text-primary" href="{{ route('barang.create') }}">
                                <div class="fst-button">Tambahkan Barang</div>
                                <i class="material-icons icon-sm ms-1">chevron_right</i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection