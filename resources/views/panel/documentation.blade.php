@extends('layout.app')
@section('title', 'Dokumentasi')
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Dokumentasi</h5>
                <hr style="border-top: 2px solid rgba(255,255,255, 0.1);">
                <p>
                    <strong>Dashboard</strong>
                    <strong></strong>
                </p>
                <p>
                    <img class="img-fluid" src="{{ asset('img/doc/image001.png')}}" />
                </p>
                <p>
                    Pada bagian Dashboard berfungsi untuk menampilkan log terhadap penggunaan
                    user. Disini ditampilkan jumlah dokumen yang dikelola website, jumlah user
                    yang bergabung dalam website, dan jumlah instansi yang menggunakan aplikasi
                    ini. Halaman ini juga menampilkan log dari dokumen aktif / sedang di
                    proses.
                </p>
                <p>
                    <strong>Navbar</strong>
                    <strong></strong>
                </p>
                <p>
                    <img class="img-fluid" src="{{ asset('img/doc/image003.png')}}" />
                </p>
                <p>
                    Fitur navbar berguna untuk melakukan pencarian pada website, kemudian
                    tombol untuk melakukan <em>submit file</em>. Ikon lonceng berfungsi untuk
                    menampilkan notifikasi yang masuk kepada user. Serta fitur untuk
                    menampilkan profile user.
                </p>
                <p>
                    <strong>Submit Dokumen</strong>
                    <strong></strong>
                </p>
                <p>
                    <img class="img-fluid" src="{{ asset('img/doc/image005.png')}}" />
                </p>
                <p>
                    Pada halaman ini user dapat mengunggah dokumen yang ingin di proses,
                    terdapat form untuk judul, flow, unggah, dan deskripsi dokumen.
                </p>
                <p>
                    <strong>Dokumen</strong>
                    <strong></strong>
                </p>
                <p>
                    <br />
                    <img class="img-fluid" src="{{ asset('img/doc/image007.png')}}" />
                </p>
                <p>
                    <img class="img-fluid" src="{{ asset('img/doc/image010.png')}}" />
                </p>
                <p>
                    Pada tab dokumen terdapat 3 sub menu yaitu:
                </p>
                <ul type="disc">
                    <li>
                        Daftar Dokumen
                    </li>
                    <ul type="circle">
                        <li>
                            Menampilkan semua dokumen yang dimiliki user
                        </li>
                    </ul>
                    <li>
                        Dokumen Aktif
                    </li>
                    <ul type="circle">
                        <li>
                            Menampilkan semua dokumen aktif yang sedang diproses
                        </li>
                    </ul>
                    <li>
                        Dokumen Usang
                    </li>
                    <ul type="circle">
                        <li>
                            Menampilkan semua dokumen yang ditolak
                        </li>
                    </ul>
                </ul>
                <h3>
                    Profile
                </h3>
                <p>
                    <img class="img-fluid" src="{{ asset('img/doc/image010.png')}}" />
                </p>
                <p>
                    Fitur profil dapat diakses melalui menu sidebar dan klik pada bagian
                    "Profil Saya" atau melalui navbar pada bagian nama user kemudian klik
                    "settings". Disini user dapat mengelola profil yang digunakan pada aplikasi
                    website SATAP
                </p>

            </div>
        </div>
    </div>
</div>
@endsection