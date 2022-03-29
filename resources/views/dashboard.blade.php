@extends('layout.app')

@section('title')
<title>Dashboard</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{session('pabrik')}}</li>
        </ol>

        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white bg-dark ml-4 mb-3" style="max-width: 22rem;">
                <div class="card-header text-white">Aturan Baru BPOM</div>
                <div class="card-body">
                   <h5>Tanggal : 27 Maret 2019 </h5>
                <br> <a href="#" class="btn btn-light  float-right btn-sm">unduh</a>               </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white bg-dark ml-4 mb-3" style="max-width: 22rem;">
                <div class="card-header text-white">Aturan Produk</div>
                <div class="card-body">
                   <h5>Tanggal : 27 Maret 2019 </h5>
                <br> <a href="#" class="btn btn-light  float-right btn-sm">unduh</a>               </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white bg-dark ml-4 mb-3" style="max-width: 22rem;">
                <div class="card-header text-white">Aturan Pabrik</div>
                <div class="card-body">
                   <h5>Tanggal : 27 Maret 2019 </h5>
                <br> <a href="#" class="btn btn-light  float-right btn-sm">unduh</a>               </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white bg-dark ml-4 mb-3" style="max-width: 22rem;">
                <div class="card-header text-white">Aturan Iklan</div>
                <div class="card-body">
                   <h5>Tanggal : 27 Maret 2019 </h5>
                <br> <a href="#" class="btn btn-light  float-right btn-sm">unduh</a>               </div>
            </div>
        </div>
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item active">Struktur Organisasi</li>
            <div class="d-flex justify-content-center">
                <img src="assets/img/bpom.jpg" class="img-fluid mt-5" alt="Responsive image" background-repeat:>
            </div>
        </ol>
    </div>

</main>
@endsection