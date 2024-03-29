@extends('layout.app')
@section('title')
    <title>
        Penerimaan Penyerahan dan Penyimpanan</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Catatan Penerimaan Penyerahan dan Penyimpanan</h1>
            <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Bahan Baku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Produk Jadi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Kemasan</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">

                        <div class="card mb-4">

                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                    <button onclick="setdatetoday1(3)" class="btn btn-success btn-lg" data-toggle="modal"
                                        data-target="#modalBahan">
                                        Tambah Bahan Baku
                                    </button>
                                @endif
                            </div>

                            <table class="table mt-5" id="tabelproduk" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Sesuai PROTAP</th>
                                        <th scope="col">Kode Bahan Baku</th>
                                        <th scope="col">Nama Bahan Baku</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>

                            </table>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="card mb-4">

                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                    <button onclick="setdatetoday1(2)" class="btn btn-success btn-lg" data-toggle="modal"
                                        data-target="#modalProduk">
                                        Tambah Produk Jadi
                                    </button>
                                @endif


                            </div>

                            <table class="table table-striped mt-5" id="tabelbahan" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Sesuai PROTAP</th>
                                        <th scope="col">Kode Produk Jadi</th>
                                        <th scope="col">Nama Produk Jadi</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="row">

                        <div class="card mb-4">

                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                    <button onclick="setdatetoday1(1)" class="btn btn-success btn-lg" data-toggle="modal"
                                        data-target="#modalKemasan">
                                        Tambah Kemasan
                                    </button>
                                @endif


                            </div>

                            <table class="table mt-5" id="tabelkemasan" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Sesuai PROTAP</th>
                                        <th scope="col">Kode Kemasan</th>
                                        <th scope="col">Nama Kemasan</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Modal Bahan -->
        <div class="modal fade" id="modalBahan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Bahan Baku</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl3'></div>
                            <div class="card-header">Bahan Baku</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="tambah_terimabahan" id='forminput3'>
                                    @csrf
                                    <fieldset>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                                Dengan PROTAP No</label>
                                            <div class="col-sm">
                                                {{-- <input type="text" name="protap" class="form-control 17" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                                <select name="protap" class="form-control 3">
                                                    @foreach ($protap1 as $isi)
                                                        <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <div id="error-box" style="color: red"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan
                                                Baku</label>
                                            <div class="col-sm">
                                                <input class="form-control 3" list="listnamabahanbaku" type="text"
                                                    name='nama' id="namabahanbaku" autocomplete="off" required>
                                                <datalist id='listnamabahanbaku'>
                                                    @foreach ($bahanbaku as $row)
                                                        <option value="{{ $row['bahanbaku_nama'] }}">
                                                            {{ $row['bahanbaku_nama'] }}
                                                        </option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                                Bahan Baku</label>
                                            <div class="col-sm">
                                                <input type="text" name="kode" readonly class="form-control 3"
                                                    id="kodebahanbaku" placeholder="Kode Bahan Baku" required />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
                                            <div class="col-sm">
                                                <div class="row">
                                                    <div class="col-sm-8" data-tip="Hanya angka saja">
                                                        <input type="number" name="jumlah" class="form-control 3"
                                                            id="inputEmail3" placeholder="Jumlah" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" name="satuan" id="">
                                                            <option value="gr"> gr</option>
                                                            <option value="kg"> kg</option>
                                                            <option value="ml"> ml</option>
                                                            <option value="L"> L</option>
                                                            <option value="Pcs"> Pcs</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="hidden" id='ambil_tanggal3' name="tanggal" placeholder="" />

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                            <div class="col-sm">
                                                <input type="text" name="ruang" class="form-control 3"
                                                    id="inputEmail3" placeholder="Ruangan" />
                                                <p id="info-kosong3"> </p>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary" onclick="salert1(3)" href="#"
                                            style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->

        <!-- Modal Produk -->
        <div class="modal fade" id="modalProduk" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Produk</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl2'></div>
                            <div class="card-header">Produk</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="tambah_terimaproduk" id='forminput2'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                            Dengan PROTAP No</label>
                                        <div class="col-sm">
                                            {{-- <input type="text" name="protap" class="form-control 17" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                            <select name="protap" class="form-control 1">
                                                @foreach ($protap2 as $isi)
                                                    <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div id="error-box" style="color: red"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Produk</label>
                                        <div class="col-sm">
                                            <input class="form-control 2" list="listnamaproduk" type="text"
                                                name='nama' id="namaproduk" autocomplete="off">
                                            </input>
                                            <datalist id='listnamaproduk'>
                                                @foreach ($produk as $row)
                                                    <option value="{{ $row['produk_nama'] }}">
                                                        {{ $row['produk_nama'] }}
                                                    </option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                            Produk</label>
                                        <div class="col-sm">
                                            <input type="text" name="kode" readonly class="form-control 2"
                                                id="kodeproduk" placeholder="Kode Produk" />
                                        </div>
                                    </div>
                                    <input type="hidden" id='ambil_tanggal2' class="form-control 2" name="tanggal"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah" class="form-control 2"
                                                        id="inputEmail3" placeholder="Jumlah" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuan" id="">
                                                        <option value="gr"> gr</option>
                                                        <option value="kg"> kg</option>
                                                        <option value="ml"> ml</option>
                                                        <option value="L"> L</option>
                                                        <option value="Pcs"> Pcs</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                        <div class="col-sm">
                                            <input type="text" name="ruang" class="form-control 2" id="inputEmail3"
                                                placeholder="Ruangan" />
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" onclick="salert1(2)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->

        <!-- Modal Kemasan -->
        <div class="modal fade" id="modalKemasan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Kemasan</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl1'></div>
                            <div class="card-header">Kemasan</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="tambah_terimakemasan" id='forminput1'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                            Dengan PROTAP No</label>
                                        <div class="col-sm">
                                            {{-- <input type="text" name="protap" class="form-control 17" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                            <select name="protap" class="form-control 1">
                                                @foreach ($protap3 as $isi)
                                                    <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div id="error-box" style="color: red"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Kemasan</label>
                                        <div class="col-sm">
                                            <input class="form-control 1" list="listnamakemasan" type="text"
                                                name='nama' id="namakemasan" autocomplete="off">
                                            </input>
                                            <datalist id='listnamakemasan'>
                                                @foreach ($kemasan as $row)
                                                    <option value="{{ $row['kemasan_nama'] }}">
                                                        {{ $row['kemasan_nama'] }}
                                                    </option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                            Kemasan</label>
                                        <div class="col-sm">
                                            <input type="text" name="kode" readonly class="form-control 1"
                                                id="kodekemasan" placeholder="Kode Kemasan" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah" class="form-control 1"
                                                        id="inputEmail3" placeholder="Jumlah" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuan" id="">
                                                        <option value="gr"> gr</option>
                                                        <option value="kg"> kg</option>
                                                        <option value="ml"> ml</option>
                                                        <option value="L"> L</option>
                                                        <option value="Pcs"> Pcs</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                        <div class="col-sm">
                                            <input type="text" name="ruang" class="form-control 1" id="inputEmail3"
                                                placeholder="Ruangan" />
                                        </div>
                                    </div>
                                    <input type="hidden" id='ambil_tanggal1' class="form-control 1" name="tanggal"
                                        placeholder="" />
                                    <a class="btn btn-primary" onclick="salert1(1)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->

        <!-- Modal Bahan -->
        <div class="modal fade" id="modaleditbahan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Bahan Baku</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl3'></div>
                            <div class="card-header">Bahan Baku</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="edit_terimabahan" id='forminput4'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="cpid" id="cpbahan" />
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                            Dengan PROTAP No</label>
                                        <div class="col-sm">
                                            {{-- <input type="text" name="protap" class="form-control 17" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                            <select name="protap" class="form-control 4" id="protap_bahan">
                                                @foreach ($protap1 as $isi)
                                                    <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div id="error-box" style="color: red"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan Baku</label>
                                        <div class="col-sm">
                                            <input class="form-control 4" list="listnamabahanbaku" type="text"
                                                name='nama' id="bahannama" autocomplete="off">
                                            </input>
                                            <datalist id='listnamabahanbaku'>
                                                @foreach ($bahanbaku as $row)
                                                    <option value="{{ $row['bahanbaku_nama'] }}">
                                                        {{ $row['bahanbaku_nama'] }}
                                                    </option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                            Bahan Baku</label>
                                        <div class="col-sm">
                                            <input type="text" name="kode" readonly class="form-control 4"
                                                id="bahankode" placeholder="Kode Bahan Baku" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-8" data-tip1="Hanya angka saja">
                                                    <input type="number" id="bahanjumlah" name="jumlah"
                                                        class="form-control 4" id="jumlah" placeholder="Jumlah" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuan" id="bahansatuan">
                                                        <option value="gr"> gr</option>
                                                        <option value="kg"> kg</option>
                                                        <option value="ml"> ml</option>
                                                        <option value="L"> L</option>
                                                        <option value="Pcs"> Pcs</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <input type="hidden" id='ambil_tanggal3' class="tanggal" name="tanggal"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                        <div class="col-sm">
                                            <input type="text" id="bahanruang" name="ruang" class="form-control 4"
                                                id="ruangan" placeholder="Ruangan" />
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" onclick="salert1(4)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->

        <!-- Modal Produk -->
        <div class="modal fade" id="modaleditproduk" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Produk</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl2'></div>
                            <div class="card-header">Produk</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="edit_terimaproduk" id='forminput5'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="cpid" id="cpproduk" />
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                            Dengan PROTAP No</label>
                                        <div class="col-sm">
                                            {{-- <input type="text" name="protap" class="form-control 17" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                            <select name="protap" class="form-control 5" id="protap_produk">
                                                @foreach ($protap2 as $isi)
                                                    <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div id="error-box" style="color: red"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Produk</label>
                                        <div class="col-sm">
                                            <input class="form-control 5" list="listnamaproduk" type="text"
                                                name='nama' id="produknama" autocomplete="off">
                                            <datalist id='listnamaproduk'>
                                                @foreach ($produk as $row)
                                                    <option value="{{ $row['produk_nama'] }}">
                                                        {{ $row['produk_nama'] }}
                                                    </option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                            Produk</label>
                                        <div class="col-sm">
                                            <input type="text" name="kode" readonly class="form-control 5"
                                                id="produkkode" placeholder="Kode Produk" />
                                        </div>
                                    </div>
                                    <input type="hidden" id='ambil_tanggal' class="tanggal" name="tanggal"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" id="produkjumlah" name="jumlah"
                                                        class="form-control 5" id="Jumlah" placeholder="Jumlah" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuan" id="produksatuan">
                                                        <option value="gr"> gr</option>
                                                        <option value="kg"> kg</option>
                                                        <option value="ml"> ml</option>
                                                        <option value="L"> L</option>
                                                        <option value="Pcs"> Pcs</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                        <div class="col-sm">
                                            <input type="text" id="produkruang" name="ruang" class="form-control 5"
                                                id="ruangan" placeholder="Ruangan" />
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" onclick="salert1(5)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->

        <!-- Modal Kemasan -->
        <div class="modal fade" id="modaleditkemasan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Kemasan</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl1'></div>
                            <div class="card-header">Kemasan</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="edit_terimakemasan" id='forminput6'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="cpid" id="cpkemasan" />
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                            Dengan PROTAP No</label>
                                        <div class="col-sm">
                                            {{-- <input type="text" name="protap" class="form-control 17" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                            <select name="protap" class="form-control 6" id="protap_kemasan">
                                                @foreach ($protap3 as $isi)
                                                    <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div id="error-box" style="color: red"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Kemasan</label>
                                        <div class="col-sm">
                                            <input class="form-control 6" list="listnamakemasan" type="text"
                                                name='nama' id="kemasannama" autocomplete="off">
                                            <datalist id='listnamakemasan'>
                                                @foreach ($kemasan as $row)
                                                    <option value="{{ $row['kemasan_nama'] }}">
                                                        {{ $row['kemasan_nama'] }}
                                                    </option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                            Kemasan</label>
                                        <div class="col-sm">
                                            <input type="text" name="kode" readonly class="form-control 6"
                                                id="kemasankode" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" id="kemasanjumlah" name="jumlah"
                                                        class="form-control 6" id="jumlah" placeholder="Jumlah" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuan" id="kemasansatuan">
                                                        <option value="gr"> gr</option>
                                                        <option value="kg"> kg</option>
                                                        <option value="ml"> ml</option>
                                                        <option value="L"> L</option>
                                                        <option value="Pcs"> Pcs</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                        <div class="col-sm">
                                            <input type="text" id="kemasanruang" name="ruang"
                                                class="form-control 6" id="ruangan" placeholder="Ruangan" />
                                        </div>
                                    </div>
                                    <input type="hidden" id='ambil_tanggal1' class="tanggal" name="tanggal"
                                        placeholder="" />
                                    <a class="btn btn-primary" onclick="salert1(6)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->

        <script>
            var produks = JSON.parse('<?= json_encode($produk) ?>')
            var kemasans = JSON.parse('<?= json_encode($kemasan) ?>')
            var bahanbakus = JSON.parse('<?= json_encode($bahanbaku) ?>')

            $("#namabahanbaku").change(function() {


                var tmp = []
                if (typeof bahanbakus === 'object') {

                    Object.keys(bahanbakus).forEach(function(key) {

                        tmp.push(bahanbakus[key]);
                    })
                }
                bahanbakus = tmp
                var cekname = bahanbakus.find(bahanbaku => bahanbaku.bahanbaku_nama ===
                    document.getElementById('namabahanbaku').value)?.bahanbaku_nama;


                if (cekname) {
                    document.getElementById('kodebahanbaku').value = bahanbakus.find(bahanbaku => bahanbaku
                        .bahanbaku_nama ===
                        document.getElementById('namabahanbaku').value).bahanbaku_kode
                } else {
                    document.getElementById('kodebahanbaku').value = ""
                }
            });
            $("#namakemasan").change(function() {
                var tmp = []
                if (typeof kemasans === 'object') {
                    Object.keys(kemasans).forEach(function(key) {
                        tmp.push(kemasans[key]);
                    })
                }
                kemasans = tmp
                var cekname = kemasans.find(kemasan => kemasan.kemasan_nama ===
                    document.getElementById('namakemasan').value)?.kemasan_nama;
                
                if (cekname) {
                    document.getElementById('kodekemasan').value = kemasans.find(kemasan => kemasan.kemasan_nama ===
                        document.getElementById('namakemasan').value).kemasan_kode
                } else {
                    document.getElementById('kodekemasan').value = ""
                }
            });
            $("#namaproduk").change(function() {
                var tmp = []
                if (typeof produks === 'object') {
                    Object.keys(produks).forEach(function(key) {
                        tmp.push(produks[key]);
                    })
                }
                produks = tmp
                var cekname = produks.find(produk => produk.produk_nama ===
                    document.getElementById('namaproduk').value)?.produk_nama;
                
                if (typeof kemasans === 'object') {
                    Object.keys(kemasans).forEach(function(key) {
                        tmp.push(kemasans[key]);
                    })
                }
                kemasans = tmp
                if (cekname) {
                    document.getElementById('kodeproduk').value = produks.find(produk => produk.produk_nama ===
                        document.getElementById('namaproduk').value).produk_kode
                } else {
                    document.getElementById('kodeproduk').value = ""
                }
            });

            $("#bahannama").change(function() {
                var tmp = []
                var cekname = bahanbakus.find(bahanbaku => bahanbaku.bahanbaku_nama ===
                    document.getElementById('bahannama').value)?.bahanbaku_nama;
                if (typeof bahanbakus === 'object') {
                    Object.keys(bahanbakus).forEach(function(key) {
                        tmp.push(bahanbakus[key]);
                    })
                    bahanbakus = tmp
                }

                // console.log(bahanbakus);
                if (cekname) {
                    document.getElementById('bahankode').value = bahanbakus.find(bahanbaku => bahanbaku
                        .bahanbaku_nama ===
                        document.getElementById('bahannama').value).bahanbaku_kode
                } else {
                    document.getElementById('bahankode').value = ""
                }
            });
            $("#kemasannama").change(function() {
                var tmp = [];

                if (typeof kemasans === 'object') {
                    Object.keys(kemasans).forEach(function(key) {
                        tmp.push(kemasans[key]);

                    })
                    kemasans = tmp
                }                //console.log(kemasans);
                var cekname = kemasans.find(kemasan => kemasan.kemasan_nama ===
                    document.getElementById('kemasannama').value)?.kemasan_nama;
                
                if (cekname) {
                    document.getElementById('kemasankode').value = kemasans.find(kemasan => kemasan.kemasan_nama ===
                        document.getElementById('kemasannama').value).kemasan_kode
                } else {
                    document.getElementById('kemasankode').value = ""
                }
            });
            $("#produknama").change(function() {
                var tmp = []
                if (typeof produks === 'object') {
                    Object.keys(produks).forEach(function(key) {
                        tmp.push(produks[key]);
                    })
                    produks = tmp
                }
                var cekname = produks.find(produk => produk.produk_nama ===
                    document.getElementById('produknama').value)?.produk_nama;
               

                if (cekname) {
                    document.getElementById('produkkode').value = produks.find(produk => produk.produk_nama ===
                        document.getElementById('produknama').value).produk_kode
                } else {
                    document.getElementById('produkkode').value = ""
                }
            });

            $(document).on('click', "#editbahan", function() {
                var nama = $(this).data('nama');
                var satuan = $(this).data('satuan');
                var ruangan = $(this).data('ruangan');
                var jumlah = $(this).data('jumlah');
                var kode = $(this).data('kode');
                var cpid = $(this).data('cpid');
                var protap = $(this).data('protap');
                console.log(ruangan);
                $("#protap_bahan").val(protap);
                $("#bahannama").val(nama);
                $("#bahansatuan").val(satuan);
                $("#bahanjumlah").val(parseInt(jumlah));
                $("#bahanruang").val(ruangan);
                document.getElementById('bahankode').value = kode;
                document.getElementById('cpbahan').value = cpid;
            })

            $(document).on('click', "#editproduk", function() {
                var nama = $(this).data('nama');
                var satuan = $(this).data('satuan');
                var ruangan = $(this).data('ruangan');
                var jumlah = $(this).data('jumlah');
                var kode = $(this).data('kode');
                var cpid = $(this).data('cpid');
                var protap = $(this).data('protap');
                console.log(ruangan);

                $("#protap_produk").val(protap);
                $("#produknama").val(nama);
                $("#produksatuan").val(satuan);
                $("#produkjumlah").val(parseInt(jumlah));
                $("#produkruang").val(ruangan);
                document.getElementById('produkkode').value = kode;
                document.getElementById('cpproduk').value = cpid;
            })

            $(document).on('click', "#editkemasan", function() {
                var nama = $(this).data('nama');
                var satuan = $(this).data('satuan');
                var ruangan = $(this).data('ruangan');
                var jumlah = $(this).data('jumlah');
                var kode = $(this).data('kode');
                var cpid = $(this).data('cpid');
                var protap = $(this).data('protap');
                console.log(ruangan);
                $("#protap_kemasan").val(protap);
                $("#kemasannama").val(nama);
                $("#kemasansatuan").val(satuan);
                $("#kemasanjumlah").val(parseInt(jumlah));
                $("#kemasanruang").val(ruangan);
                document.getElementById('kemasankode').value = kode;
                document.getElementById('cpkemasan').value = cpid;
            })

            $(document).ready(function() {
                $('#tabelproduk').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('/cp_bahan') }}",
                    columns: [{
                            data: 'protap_nama',
                            name: 'protap_nama'
                        }, {
                            data: 'kode',
                            name: 'kode'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'jumlah',
                            name: 'jumlah'
                        },
                        {
                            data: 'ruang',
                            name: 'ruang'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
                $('#tabelbahan').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('/cp_produk') }}",
                    columns: [{
                            data: 'protap_nama',
                            name: 'protap_nama'
                        }, {
                            data: 'kode',
                            name: 'kode'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'jumlah',
                            name: 'jumlah'
                        },
                        {
                            data: 'ruang',
                            name: 'ruang'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
                $('#tabelkemasan').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('/cp_kemasan') }}",
                    columns: [{
                            data: 'protap_nama',
                            name: 'protap_nama'
                        }, {
                            data: 'kode',
                            name: 'kode'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'jumlah',
                            name: 'jumlah'
                        },
                        {
                            data: 'ruang',
                            name: 'ruang'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                });
            })
        </script>
    </main>
@endsection
