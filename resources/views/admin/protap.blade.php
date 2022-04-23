@extends('layout.app')
@section('title')
    <title>Update PROTAP</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>PROTAP</h1>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Aturan BPOM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Aturan Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Aturan Pabrik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-detail-tab" data-toggle="pill" href="#pills-detail" role="tab"
                        aria-controls="pills-detail" aria-selected="false">Aturan Iklan</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="card mb-4 p-0">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Aturan BPOM
                                </div>
                                <div class="card-body">
                                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white bg-dark ml-4 mb-3"
                                        style="max-width: 22rem;">
                                        <div class="card-header text-white">Aturan Baru BPOM</div>
                                        <div class="card-body">
                                            <h5>Tanggal : 27 Maret 2019 </h5>
                                            <br>
                                            @if (Auth::user()->level == 0)
                                                <button class="btn btn-light btn-sm" data-toggle="modal"
                                                    data-target="#modalForm1">Ganti</button>
                                            @endif
                                            <a href="{{ $baru }}"
                                                class="btn btn-light  float-right btn-sm">unduh</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="card mb-4 p-0">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Aturan Produk
                                </div>
                                <div class="card-body">
                                    <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white bg-dark ml-4 mb-3"
                                        style="max-width: 22rem;">
                                        <div class="card-header text-white">Aturan Produk</div>
                                        <div class="card-body">
                                            <h5>Tanggal : 27 Maret 2019 </h5>
                                            <br>
                                            @if (Auth::user()->level == 0)
                                                <button class="btn btn-light btn-sm" data-toggle="modal"
                                                    data-target="#modalForm2">Ganti</button>
                                                @endif <a href="{{ $produk }}"
                                                    class="btn btn-light  float-right btn-sm">unduh</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="row">
                                <div class="card mb-4 p-0">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Aturan Pabrik
                                    </div>
                                    <div class="card-body">
                                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white bg-dark ml-4 mb-3"
                                            style="max-width: 22rem;">
                                            <div class="card-header text-white">Aturan Pabrik</div>
                                            <div class="card-body">
                                                <h5>Tanggal : 27 Maret 2019 </h5>
                                                <br>
                                                @if (Auth::user()->level == 0)
                                                    <button class="btn btn-light btn-sm" data-toggle="modal"
                                                        data-target="#modalForm3">Ganti</button>
                                                    @endif <a href="{{ $pabrik }}"
                                                        class="btn btn-light  float-right btn-sm">unduh</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="row">
                                <div class="card mb-4 p-0">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Aturan Iklan
                                    </div>
                                    <div class="card-body">
                                        <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white bg-dark ml-4 mb-3"
                                            style="max-width: 22rem;">
                                            <div class="card-header text-white">Aturan Iklan</div>
                                            <div class="card-body">
                                                <h5>Tanggal : 27 Maret 2019 </h5>
                                                <br>
                                                @if (Auth::user()->level == 0)
                                                    <button class="btn btn-light btn-sm" data-toggle="modal"
                                                        data-target="#modalForm4">Ganti</button>
                                                    @endif <a href="{{ $iklan }}"
                                                        class="btn btn-light  float-right btn-sm">unduh</a>
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
    </main>
@endsection
