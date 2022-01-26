@extends('layout.app')
@section('title', 'Edit Barang')
@section('content')
<main>
    <div class="container-xl p-5">
        <div class="d-flex justify-content-between align-items-end">
            <h2 class="display-6 mb-0">Edit Barang</h2>
        </div>
        <hr class="mt-2 mb-5" />
        <div class="row gx-5">
            <div class="col-12 mb-5">
                <div class="card card-raised mb-5">
                    <div class="card-body p-5">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form method="POST" action="{{ route('barang.update',[$barang]) }}">
                            @csrf
                            @method("patch")
                            <div class="row mb-4">
                                <div class="col-md-2">
                                    <label for="kode">Kode Barang</label>
                                    <input class="form-control" type="text" name="kode" value="{{ $barang->kode_barang }}" placeholder="Kode Barang">
                                </div>
                                <div class="col-md-10">
                                    <label for="nama">Nama Barang</label>
                                    <input class="form-control" type="text" name="nama" value="{{ $barang->nama_barang }}" placeholder="Nama Barang">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="harga">Harga</label>
                                    <input class="form-control w-100" type="number" value="{{ $barang->harga_barang }}" name="harga" placeholder="Harga Barang">
                                </div>
                                <div class="col-md-6">
                                    <label for="satuan">Satuan</label>
                                    <select class="form-control" name="satuan" placeholder="">
                                        @foreach($satuan as $val)
                                        <option value="{{ $val->id }}" {{ ($val->id==$barang->satuan_id)?'selected':'' }}>{{ $val->nama_satuan }} ({{ $val->kode_satuan }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="des">Deskripsi Barang</label>
                                <textarea class="form-control" name="des" placeholder="Deskripsi Barang" style="height:150px;">{{ $barang->deskripsi_barang }}</textarea>
                            </div>
                            <div class="text-end"><button class="btn btn-primary mdc-ripple-upgraded" type="submit" type="button">Save Changes</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection