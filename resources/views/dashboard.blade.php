@extends('layout.app')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
    <?php function tgl_indo($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $pecahkan = explode('-', $tanggal);
    
        // variabel pecahkan 0 = tahun
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tanggal
    
        return $pecahkan[0] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[2];
    } ?>
    <main>
        <div class="container-fluid px-4">
            <h1 class="">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{ session('pabrik') }}</li>
            </ol>

            <div class="row d-flex justify-content-between">
                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white ml-4 mb-3" id="bg-dashcard">
                    <div class="card-header text-white">Aturan Baru BPOM</div>
                    <div class="card-body">
                        <h5>Tanggal : <?php if ($tglbaru != 'Belum ada aturan') {
                            $date = date_create($tglbaru);
                            echo tgl_indo(date_format($date, 'd-m-Y'));
                        } else {
                            echo $tglbaru;
                        }
                        ?> </h5>
                        <br>
                        @if (Auth::user()->level == 0)
                            {{-- <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalForm1">Ganti</button> --}}
                        @endif
                        {{-- <a href="{{ $baru }}" class="btn btn-light  float-right btn-sm">unduh</a> --}}
                        <form action="/lihatpdf" method="post">
                            @csrf
                            <input type="hidden" name="path" value="{{ $baru }}">
                            <button type="submit" class="btn btn-light" onclick=""> Buka</button>
                        </form>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white ml-4 mb-3"id="bg-dashcard">
                    <div class="card-header text-white">Aturan Produk</div>
                    <div class="card-body">
                        <h5>Tanggal : <?php if ($tglproduk != 'Belum ada aturan') {
                            $date = date_create($tglproduk);
                            echo tgl_indo(date_format($date, 'd-m-Y'));
                        } else {
                            echo $tglproduk;
                        }
                        ?> </h5>
                        <br>
                        @if (Auth::user()->level == 0)
                            {{-- <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalForm2">Ganti</button> --}}
                        @endif
                        {{-- <a href="{{ $produk }}" class="btn btn-light  float-right btn-sm">unduh</a> --}}
                        <form action="/lihatpdf" method="post">
                            @csrf
                            <input type="hidden" name="path" value="{{ $produk }}">
                            <button type="submit" class="btn btn-light" onclick=""> Buka</button>
                        </form>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white ml-4 mb-3" id="bg-dashcard">
                    <div class="card-header text-white">Aturan Pabrik</div>
                    <div class="card-body">
                        <h5>Tanggal : <?php if ($tglpabrik != 'Belum ada aturan') {
                            $date = date_create($tglpabrik);
                            echo tgl_indo(date_format($date, 'd-m-Y'));
                        } else {
                            echo $tglpabrik;
                        }
                        ?> </h5>
                        <br>
                        @if (Auth::user()->level == 0)
                            {{-- <button class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalForm3">Ganti</button> --}}
                        @endif
                        {{-- <a href="{{ $pabrik }}" class="btn btn-light  float-right btn-sm">unduh</a> --}}
                        <form action="/lihatpdf" method="post">
                            @csrf
                            <input type="hidden" name="path" value="{{ $pabrik }}">
                            <button type="submit" class="btn btn-light" onclick=""> Buka</button>
                        </form>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3 card text-white ml-4 mb-3" id="bg-dashcard">
                    <div class="card-header text-white">Aturan Iklan</div>
                    <div class="card-body">
                        <h5>Tanggal : <?php if ($tgliklan != 'Belum ada aturan') {
                            $date = date_create($tgliklan);
                            echo tgl_indo(date_format($date, 'd-m-Y'));
                        } else {
                            echo $tgliklan;
                        }
                        ?> </h5>
                        <br>
                        @if (Auth::user()->level == 0)
                            {{-- <button class="btn btn-light float-right btn-sm" data-toggle="modal" data-target="#modalForm4">Ganti</button> --}}
                        @endif
                        {{-- <a href="{{ $iklan }}" class="btn btn-light  float-right btn-sm">unduh</a> --}}
                        <form action="/lihatpdf" method="post">
                            @csrf
                            <input type="hidden" name="path" value="{{ $iklan }}">
                            <button type="submit" class="btn btn-light" onclick=""> Buka</button>
                        </form>
                    </div>
                </div>
            </div>
            @if (Auth::user()->level != 4 and Auth::user()->level != 0)
                <ol class="breadcrumb mt-5 d-flex justify-content-between">
                    <li class="breadcrumb-item active">Struktur Organisasi</li>
                    @if (Auth::user()->level == 1)
                        <button class="btn btn-dark float-right btn-sm mr-3" data-toggle="modal"
                            data-target="#modalForm5">Ganti</button>
                    @endif
                </ol>
                <div class="d-flex justify-content-center">
                    <img src="asset/struktur/{{ $struktur }}" style="height: 500px; width:auto;" class="img-fluid mt-2"
                        alt="Responsive image" background-repeat:>
                </div>
            @endif
        </div>

        <!-- Modal 5 -->
        <div class="modal fade" id="modalForm5" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Struktur Organisasi
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form action="/ganti_struktur" method="post" enctype="multipart/form-data" role="form"
                            id="forminput3">

                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="kategori" value="Aturan Iklan" />
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Pilih File</label>
                                <input type="file" name="upload" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(3)">
                                    Simpan
                                </button>
                            </div>


                        </form>
                    </div>


                </div>
            </div>
        </div>
        <!--  -->

    </main>
@endsection
