@extends('layout.app')
@section('title')
<title>Penimbangan</title>
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Catatan Penimbangan</h1>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Bahan Baku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Produk Antara</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Hasil Penimbangan</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bahan Baku
                            </div>
                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm4" onclick="setdatetoday1(1)">
                                    Tambah Penimbangan Bahan Baku
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modalForm4" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Penimbangan Bahan Baku
                                                </h4>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <div class="card mb-4">
                                                    <div class="card-header" id='headertgl1'></div>
                                                    <div class="card-header">Bahan Baku</div>
                                                    <div class="card-body">
                                                        <p class="statusMsg"></p>
                                                        <form role="form" method="post" action="tambah_penimbanganbahan" id='forminput1'>
                                                            @csrf
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan
                                                                    Baku</label>
                                                                <div class="col-sm">
                                                                    <input class="form-control 1" list="listnamabahanbaku" type="text" name='nama_bahan' id="isi_bahan">
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
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">No Loth</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="no_loth" class="form-control 1" id="inputEmail3" placeholder="No Loth" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                                    Suplier</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="nama_suplier" class="form-control 1" id="inputEmail3" placeholder="Nama Suplier" />
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="tanggal" id='ambil_tanggal1' class="form-control 1" placeholder="" />

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Bahan
                                                                    Baku</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="jumlah_bahan" class="form-control 1" id="inputEmail3" placeholder="Jumlah Bahan Baku" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                                                    Penimbangan</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="hasil_penimbangan" class="form-control 1" id="inputEmail3" placeholder="Hasil Penimbangan" />
                                                                </div>
                                                            </div>

                                                            <a class="btn btn-primary" onclick="salert1(1)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- pop up end -->
                                @endif




                                <table class="table mt-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Nama Bahan Baku</th>
                                            <th scope="col">No Loth</th>
                                            <th scope="col">Nama Suplier</th>
                                            <th scope="col">Jumlah Bahan Baku</th>
                                            <th scope="col">Hasil Penimbangan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($data as $row)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $row['tanggal'] }}</td>
                                            <td>{{ $row['nama_bahan'] }}</td>
                                            <td>{{ $row['no_loth'] }}</td>
                                            <td>{{ $row['nama_suplier'] }}</td>
                                            <td>{{ $row['jumlah_bahan'] }}</td>
                                            <td>{{ $row['hasil_penimbangan'] }}</td>
                                            <td>
                                                <?php if ($row['status'] == 0) {
                                                    echo 'Diajukan';
                                                } elseif ($row['status'] == 1) {
                                                    echo 'Diterima';
                                                } ?>
                                            </td>
                                            <td>
                                                @if (Auth::user()->level == 2)
                                                <form method="post" action="terimapenimbanganbahan">
                                                    @csrf
                                                    <input type="hidden" name="nobatch" value="{{ $row['no_loth'] }}" />
                                                    <button type="submit" class="btn btn-primary">terima</button>
                                                </form>
                                                @else

                                                <button id="klik_bahan" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editBahan" data-tanggal="{{ $row['tanggal'] }}" data-nama="{{ $row['nama_bahan'] }}" data-noloth="{{ $row['no_loth'] }}" data-suplai="{{ $row['nama_suplier'] }}" data-jbahan="{{ $row['jumlah_bahan'] }}" data-hasil="{{ $row['hasil_penimbangan'] }}" data-id="{{ $row['timbang_bahan_id']}}">edit</button>

                                                @endif
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
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Produk Antara
                            </div>
                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm5" onclick="setdatetoday1(2)">
                                    Tambah Penimbangan Produk Antara
                                </button>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="modalForm5" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Penimbangan Produk Antara
                                                </h4>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <div class="card mb-4">
                                                    <div class="card-header" id='headertgl2'></div>
                                                    <div class="card-header">Produk Antara</div>
                                                    <div class="card-body">
                                                        <p class="statusMsg"></p>
                                                        <form role="form" method="post" action="tambah_penimbanganprodukantara" id='forminput2'>
                                                            @csrf
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Produk
                                                                    Antara</label>
                                                                <div class="col-sm">
                                                                    <input class="form-control 2" list="listnamaproduk" type="text" name='nama' id="namaproduk">
                                                                    </input>
                                                                    <datalist id='listnamaproduk'>
                                                                        @foreach ($produkantara as $row)
                                                                        <option value="{{ $row['produkantara_nama'] }}">
                                                                            {{ $row['produkantara_nama'] }}
                                                                        </option>
                                                                        @endforeach
                                                                    </datalist>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                                                    Batch</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="nobatch" class="form-control 2" id="inputEmail3" placeholder="No Batch" />
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="tanggal" id='ambil_tanggal2' class="form-control 2" placeholder="" />

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Asal Produk</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="asal_produk" class="form-control 2" id="inputEmail3" placeholder="Asal Produk" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                                                    Produk Antara</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="jumlah_produk" class="form-control 2" id="inputEmail3" placeholder="Jumlah
                                                                                                                                                                                                                                                                                                                                                                                                                    Produk Antara" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                                                    Penimbangan</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="hasil_penimbangan" class="form-control 2" id="inputEmail3" placeholder="Hasil Penimbangan" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                                                    Produk</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="untuk_produk" class="form-control 2" id="inputEmail3" placeholder="Untuk Produk" />
                                                                </div>
                                                            </div>

                                                            <a class="btn btn-primary" onclick="salert1(2)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- pop up end -->

                                <table class="table mt-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Nama Produk Antara</th>
                                            <th scope="col">No Batch</th>
                                            <th scope="col">Asal Produk</th>
                                            <th scope="col">Jumlah Produk Antara</th>
                                            <th scope="col">Hasil Penimbangan</th>
                                            <th scope="col">Untuk Produk</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($data1 as $row)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $row['tanggal'] }}</td>
                                            <td>{{ $row['nama_produk_antara'] }}</td>
                                            <td>{{ $row['no_batch'] }}</td>
                                            <td>{{ $row['asal_produk'] }}</td>
                                            <td>{{ $row['jumlah_produk'] }}</td>
                                            <td>{{ $row['hasil_penimbangan'] }}</td>
                                            <td>{{ $row['untuk_produk'] }}</td>
                                            <td>
                                                <?php if ($row['status'] == 0) {
                                                    echo 'Diajukan';
                                                } elseif ($row['status'] == 1) {
                                                    echo 'Diterima';
                                                } ?>
                                            </td>
                                            <td>
                                                @if (Auth::user()->level == 2)
                                                <form method="post" action="terimapenimbanganproduk">
                                                    @csrf
                                                    <input type="hidden" name="nobatch" value="{{ $row['no_batch'] }}" />
                                                    <button type="submit" class="btn btn-primary">terima</button>
                                                </form>
                                                @else

                                                <button id="klikproduk" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editProduk" data-tanggal="{{ $row['tanggal'] }}" data-nama="{{ $row['nama_produk_antara'] }}" data-nobatch="{{ $row['no_batch'] }}" data-asal="{{ $row['asal_produk'] }}" data-jumlah="{{ $row['jumlah_produk'] }}" data-hasil="{{ $row['hasil_penimbangan'] }}" data-produk="{{ $row['untuk_produk'] }}" data-id="{{ $row['timbang_produk_id']}}">edit</button>
                                                @endif
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
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="container-fluid px-4">
                    <div class="row">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Hasil Penimbangan
                            </div>
                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm6" onclick="setdatetoday1(3)">
                                    Tambah Hasil Penimbangan
                                </button>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="modalForm6" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Ruang Timbang</h4>
                                            </div>

                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <div class="card mb-4">
                                                    <div class="card-header" id='headertgl3'></div>
                                                    <div class="card-header">Ruang Timbang</div>
                                                    <div class="card-body">
                                                        <p class="statusMsg"></p>
                                                        <form role="form" method="post" action="tambah_ruangtimbang" id='forminput3'>
                                                            @csrf
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan
                                                                    Baku</label>
                                                                <div class="col-sm">
                                                                    <input class="form-control 3" list="listnamabahanbaku" type="text" name='nama_bahanbaku' id="namabahanbaku">
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
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">No Loth</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="no_loth" class="form-control 3" id="inputEmail3" placeholder="No Loth" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Bahan
                                                                    Baku</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="jumlah_bahanbaku" class="form-control 3" id="inputEmail3" placeholder="Jumlah Bahan Baku" />
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="tanggal" id='ambil_tanggal3' class="form-control 3" placeholder="" />

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                                                    Permintaan</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="jumlah_permintaan" class="form-control 3" id="inputEmail3" placeholder="Jumlah Permintaan" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                                                    Penimbangan</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="hasil_penimbangan" class="form-control 3" id="inputEmail3" placeholder="Hasil Penimbangan" />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                                                    Produk</label>
                                                                <div class="col-sm">
                                                                    <input type="text" name="untuk_produk" class="form-control 3" id="inputEmail3" placeholder="Untuk Produk" />
                                                                </div>
                                                            </div>

                                                            <a class="btn btn-primary" onclick="salert1(3)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- pop up end -->

                                <table class="table mt-5">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Nama Bahan Baku</th>
                                            <th scope="col">No Loth</th>
                                            <th scope="col">Jumlah Bahan Baku</th>
                                            <th scope="col">Jumlah Permintaan</th>
                                            <th scope="col">Hasil Penimbangan</th>
                                            <th scope="col">Untuk Produk</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($data2 as $row)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $row['tanggal'] }}</td>
                                            <td>{{ $row['nama_bahan_baku'] }}</td>
                                            <td>{{ $row['no_loth'] }}</td>
                                            <td>{{ $row['jumlah_bahan_baku'] }}</td>
                                            <td>{{ $row['jumlah_permintaan'] }}</td>
                                            <td>{{ $row['hasil_penimbangan'] }}</td>
                                            <td>{{ $row['untuk_produk'] }}</td>
                                            <td>
                                                <?php if ($row['status'] == 0) {
                                                    echo 'Diajukan';
                                                } elseif ($row['status'] == 1) {
                                                    echo 'Diterima';
                                                } ?>
                                            </td>
                                            <td>
                                                @if (Auth::user()->level == 2)
                                                <form method="post" action="terimapenimbanganruang">
                                                    @csrf
                                                    <input type="hidden" name="nobatch" value="{{ $row['no_loth'] }}" />
                                                    <button type="submit" class="btn btn-primary">terima</button>
                                                </form>
                                                @else

                                                <button id="klikruang" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editRuang" data-tanggal="{{ $row['tanggal'] }}" data-nama="{{ $row['nama_bahan_baku'] }}" data-noloth="{{ $row['no_loth'] }}" data-jbahan="{{ $row['jumlah_bahan_baku'] }}" data-jminta="{{ $row['jumlah_permintaan'] }}" data-hasil="{{ $row['hasil_penimbangan'] }}" data-produk="{{ $row['untuk_produk'] }}" data-id="{{ $row['id_ruangtimbang']}}">edit</button>

                                                @endif
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
        </div>
    </div>
</main>
<!-- Modal Bahan -->
<div class="modal fade" id="editBahan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Penimbangan Bahan Baku
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-header" id='headertgl1'></div>
                    <div class="card-header">Bahan Baku</div>
                    <div class="card-body">
                        <p class="statusMsg"></p>
                        <form role="form" method="post" action="edit_penimbanganbahan" id='forminput4'>
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" id="isi_bahanid">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan
                                    Baku</label>
                                <div class="col-sm">
                                    <input class="form-control 4" list="listnamabahanbaku" type="text" name='nama_bahan' id="bahanbahan">
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
                                <label for="inputEmail3" class="col-sm-3 col-form-label">No Loth</label>
                                <div class="col-sm">
                                    <input type="text" name="no_loth" class="form-control 4" placeholder="No Loth" id="isi_nolothbahan" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                    Suplier</label>
                                <div class="col-sm">
                                    <input type="text" name="nama_suplier" class="form-control 4" placeholder="Nama Suplier" id="isi_suplaibahan" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Bahan
                                    Baku</label>
                                <div class="col-sm">
                                    <input type="text" name="jumlah_bahan" class="form-control 4" id="isi_jbahan" placeholder="Jumlah Bahan Baku" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                    Penimbangan</label>
                                <div class="col-sm">
                                    <input type="text" name="hasil_penimbangan" class="form-control 4" id="isi_hasilbahan" placeholder="Hasil Penimbangan" />
                                </div>
                            </div>

                            <a class="btn btn-primary" onclick="salert1(4)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pop up end -->

<!-- Modal Produk-->
<div class="modal fade" id="editProduk" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Penimbangan Produk Antara
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-header" id='headertgl2'></div>
                    <div class="card-header">Produk Antara</div>
                    <div class="card-body">
                        <p class="statusMsg"></p>
                        <form role="form" method="post" action="edit_penimbanganprodukantara" id='forminput5'>
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" id="isi_produkid">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Produk
                                    Antara</label>
                                <div class="col-sm">
                                    <input class="form-control 5" list="listnamaproduk" type="text" name='nama' id="isi_produknama">
                                    </input>
                                    <datalist id='listnamaproduk'>
                                        @foreach ($produkantara as $row)
                                        <option value="{{ $row['produkantara_nama'] }}">
                                            {{ $row['produkantara_nama'] }}
                                        </option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                    Batch</label>
                                <div class="col-sm">
                                    <input type="text" name="nobatch" class="form-control 5" id="isi_nobatch" placeholder="No Batch" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Asal Produk</label>
                                <div class="col-sm">
                                    <input type="text" name="asal_produk" class="form-control 5" id="isi_asalproduk" placeholder="Asal Produk" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                    Produk Antara</label>
                                <div class="col-sm">
                                    <input type="text" name="jumlah_produk" class="form-control 5" id="isi_jumlahproduk" placeholder="Jumlah
                                                                                                                                                                                                                                                                                                                                                                                                                    Produk Antara" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                    Penimbangan</label>
                                <div class="col-sm">
                                    <input type="text" name="hasil_penimbangan" class="form-control 5" id="isi_hasilproduk" placeholder="Hasil Penimbangan" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                    Produk</label>
                                <div class="col-sm">
                                    <input type="text" name="untuk_produk" class="form-control 5" id="isi_produkproduk" placeholder="Untuk Produk" />
                                </div>
                            </div>

                            <a class="btn btn-primary" onclick="salert1(5)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pop up end -->

<!-- Modal Ruang-->
<div class="modal fade" id="editRuang" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ruang Timbang</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="card mb-4">
                    <div class="card-header" id='headertgl3'></div>
                    <div class="card-header">Hasil Timbang</div>
                    <div class="card-body">
                        <p class="statusMsg"></p>
                        <form role="form" method="post" action="edit_ruangtimbang" id='forminput6'>
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="id" id="isi_ruangid">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan
                                    Baku</label>
                                <div class="col-sm">
                                    <input class="form-control 6" list="listnamabahanbaku" type="text" name='nama_bahanbaku' id="isi_namaruang">
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
                                <label for="inputEmail3" class="col-sm-3 col-form-label">No Loth</label>
                                <div class="col-sm">
                                    <input type="text" name="no_loth" class="form-control 6" id="isi_nolothruang" placeholder="No Loth" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Bahan
                                    Baku</label>
                                <div class="col-sm">
                                    <input type="text" name="jumlah_bahanbaku" class="form-control 6" id="isi_jruang" placeholder="Jumlah Bahan Baku" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                    Permintaan</label>
                                <div class="col-sm">
                                    <input type="text" name="jumlah_permintaan" class="form-control 6" id="isi_jminta" placeholder="Jumlah Permintaan" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                    Penimbangan</label>
                                <div class="col-sm">
                                    <input type="text" name="hasil_penimbangan" class="form-control 6" id="isi_hasilruang" placeholder="Hasil Penimbangan" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                    Produk</label>
                                <div class="col-sm">
                                    <input type="text" name="untuk_produk" class="form-control 6" id="isi_produkruang" placeholder="Untuk Produk" />
                                </div>
                            </div>

                            <a class="btn btn-primary" onclick="salert1(6)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pop up end -->
<script>
    $(document).on('click', "#klik_bahan", function() {
        var nama = $(this).data('nama');
        var tanggal = $(this).data('tanggal');
        var noloth = $(this).data('noloth');
        var suplai = $(this).data('suplai');
        var jbahan = $(this).data('jbahan');
        var hasil = $(this).data('hasil');
        var id = $(this).data('id');

        console.log("ini " + nama + " ruangan " + tanggal);
        $("#bahanbahan").val(nama);
        // $("#isi_tanggal").val(tanggal);
        $("#isi_nolothbahan").val(noloth);
        $("#isi_suplaibahan").val(suplai);
        $("#isi_jbahan").val(jbahan);
        $("#isi_hasilbahan").val(hasil);
        $("#isi_bahanid").val(id);
        // document.getElementById('cpbahan').value = cpid;
    })
    $(document).on('click', "#klikproduk", function() {
        var nama = $(this).data('nama');
        // var tanggal = $(this).data('tanggal');
        var nobatch = $(this).data('nobatch');
        var asal = $(this).data('asal');
        var jumlah = $(this).data('jumlah');
        var hasil = $(this).data('hasil');
        var produk = $(this).data('produk');
        var id = $(this).data('id');

        console.log("ini " + nama + " ruangan " + nobatch);
        $("#isi_produknama").val(nama);
        // $("#isi_tanggal").val(tanggal);
        $("#isi_nobatch").val(nobatch);
        $("#isi_asalproduk").val(asal);
        $("#isi_jumlahproduk").val(jumlah);
        $("#isi_hasilproduk").val(hasil);
        $("#isi_produkproduk").val(produk);
        $("#isi_produkid").val(id);
        // document.getElementById('cpbahan').value = cpid;
    })
    $(document).on('click', "#klikruang", function() {
       
        var nama = $(this).data('nama');
        // var tanggal = $(this).data('tanggal');
        var noloth = $(this).data('noloth');
        var jruang = $(this).data('jbahan');
        var jminta = $(this).data('jminta');
        var hasil = $(this).data('hasil');
        var produk = $(this).data('produk');
        var id = $(this).data('id');

        console.log("ini " + nama + " ruangan " + id);
        $("#isi_namaruang").val(nama);
        // $("#isi_tanggal").val(tanggal);
        $("#isi_nolothruang").val(noloth);
        $("#isi_jruang").val(jruang);
        $("#isi_jminta").val(jminta);
        $("#isi_hasilruang").val(hasil);
        $("#isi_produkruang").val(produk);
        $("#isi_ruangid").val(id);
    })
</script>
@endsection