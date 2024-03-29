@extends('layout.app')
@section('title')
    <title>Pengambilan Sampel</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Catatan Pengambilan Sampel</h1>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
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
                                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm4"
                                            onclick="setdatetoday1(1)">
                                            Tambah Sampel Bahan Baku
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalForm4" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Sampel Bahan Baku</h4>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <div class="card mb-4">
                                                            <div class="card-header" id='headertgl1'></div>
                                                            <div class="card-header">Bahan Baku</div>
                                                            <div class="card-body">
                                                                <p class="statusMsg"></p>
                                                                <form role="form" method="post"
                                                                    action="tambah_contohbahan" id='forminput1'>
                                                                    @csrf
                                                                    <input type="hidden" name="_token"
                                                                        value="{{ csrf_token() }}" />
                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Sesuai
                                                                            Dengan PROTAP No</label>
                                                                        <div class="col-sm">
                                                                            <select name="protap" class="form-control 1">
                                                                                @foreach ($protap1 as $isi)
                                                                                    <option value="{{ $isi['protap_id'] }}">
                                                                                        {{ $isi['protap_nama'] }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                            <div id="error-box" style="color: red"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Nama Bahan
                                                                            Baku</label>
                                                                        <div class="col-sm">
                                                                            <input class="form-control 1"
                                                                                list="listnamabahanbaku" type="text"
                                                                                name='nama_bahan' id="namabahanbaku"
                                                                                autocomplete="off">
                                                                            </input>
                                                                            <datalist id='listnamabahanbaku'>
                                                                                @foreach ($bahanbaku as $row)
                                                                                    <option
                                                                                        value="{{ $row['bahanbaku_nama'] }}">
                                                                                        {{ $row['bahanbaku_nama'] }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </datalist>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Kode
                                                                            Bahan Baku</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="kode_bahan" readonly
                                                                                class="form-control 1" id="kodebahanbaku"
                                                                                placeholder="Kode Bahan Baku" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">No
                                                                            Batch</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="nobatch"
                                                                                class="form-control 1"
                                                                                placeholder="No Batch" maxlength="20"/>
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" name="tanggal"
                                                                        id='ambil_tanggal1' />

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Kedaluwarsa</label>
                                                                        <div class="col-sm">
                                                                            <input type="date" name="kedaluwarsa"
                                                                                class="form-control 1" placeholder="" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Jumlah
                                                                            Bahan Baku dalam Box</label>
                                                                        <div class="col-sm">
                                                                            <div class="row">
                                                                                <div class="col-sm-8"
                                                                                    data-tip="Hanya angka saja">
                                                                                    <input type="number"
                                                                                        name="jumlah_box"
                                                                                        class="form-control 1"
                                                                                        placeholder="Jumlah Bahan Baku dalam Box"
                                                                                        id="inputnumber"/>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-select"
                                                                                        name="satuanbox" id="">
                                                                                        <option value="gr"> gr</option>
                                                                                        <option value="kg"> kg</option>
                                                                                        <option value="ml"> ml</option>
                                                                                        <option value="L"> L</option>
                                                                                        <option value="Pcs"> Pcs
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Jumlah
                                                                            Produk Yang Diambil</label>
                                                                        <div class="col-sm">
                                                                            <div class="row">
                                                                                <div class="col-sm-8"
                                                                                    data-tip="Hanya angka saja">
                                                                                    <input type="number"
                                                                                        name="jumlah_ambil"
                                                                                        class="form-control 1"
                                                                                        placeholder="Jumlah Produk Yang Diambil" />
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <select class="form-select"
                                                                                        name="satuanproduk"
                                                                                        id="">
                                                                                        <option value="gr"> gr</option>
                                                                                        <option value="kg"> kg</option>
                                                                                        <option value="ml"> ml</option>
                                                                                        <option value="L"> L</option>
                                                                                        <option value="Pcs"> Pcs
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Jenis
                                                                            dan Warna Kemasan</label>
                                                                        <div class="col-sm">
                                                                            <input type="text"
                                                                                name="jenis_warna_kemasan"
                                                                                class="form-control 1"
                                                                                placeholder="Jenis dan Warna Kemasan" />
                                                                        </div>
                                                                    </div>
                                                                    <a class="btn btn-primary" onclick="salert1(1)"
                                                                        href="#"
                                                                        style="float:left; width: 100px;  margin-left:25px"
                                                                        role="button">Simpan</a>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- pop up end -->

                                    <table id="tabel1" class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Sesuai PROTAP</th>
                                                <th scope="col">Kode Bahan Baku</th>
                                                <th scope="col">Nama Bahan Baku</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Tanggal Pengambilan Sampel</th>
                                                <th scope="col">Kedaluwarsa</th>
                                                <th scope="col">Jumlah Bahan Baku Dalam Box</th>
                                                <th scope="col">Jumlah Produk Yang Diambil</th>
                                                <th scope="col">Jenis Dan warna kemasan</th>
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
                                                    <td>{{ $row['protap_nama'] }}</td>
                                                    <td>{{ $row['kode_bahan'] }}</td>
                                                    <td>{{ $row['nama_bahanbaku'] }}</td>
                                                    <td>{{ $row['no_batch'] }}</td>
                                                    <td>{{ $row['tanggal_ambil'] }}</td>
                                                    <td>{{ $row['kedaluwarsa'] }}</td>
                                                    <td>{{ $row['jumlah_kemasanbox'] }}</td>
                                                    <td>{{ $row['jumlah_produk'] }}</td>
                                                    <td>{{ $row['jenis_warnakemasan'] }}</td>
                                                    <td>
                                                        @if ($row['status'] == 0)
                                                            {{ 'Diajukan' }}
                                                        @else
                                                            {{ 'Diterima' }}
                                                        @endif
                                                    </td>
                                                    @if (Auth::user()->level != 2)
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                            <form action="#">
                                                                @csrf
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button id="klikbahan" type="button" data-toggle="modal"
                                                                    data-target="#editbahan"
                                                                    data-protap="{{ $row['protap_id'] }}"
                                                                    data-kode="{{ $row['kode_bahan'] }}"
                                                                    data-nama="{{ $row['nama_bahanbaku'] }}"
                                                                    data-nobatch="{{ $row['no_batch'] }}"
                                                                    data-tglambil="{{ $row['tanggal_ambil'] }}"
                                                                    data-kadaluarsa="{{ $row['kedaluwarsa'] }}"
                                                                    data-jumlahbox="{{ preg_replace('/[^0-9]/', '', $row['jumlah_kemasanbox']) }}"
                                                                    data-satuanbox="{{ preg_replace('/[^a-zA-Z]+/', '', $row['jumlah_kemasanbox']) }}"
                                                                    data-jumlahproduk="{{ preg_replace('/[^0-9]/', '', $row['jumlah_produk']) }}"
                                                                    data-satuanproduk="{{ preg_replace('/[^a-zA-Z]+/', '', $row['jumlah_produk']) }}"
                                                                    data-jeniswarna="{{ $row['jenis_warnakemasan'] }}"
                                                                    data-id="{{ $row['id_bahanbaku'] }}"
                                                                    class="btn btn-primary">Edit</button>
                                                            </form>
                                                            <?php } elseif ($row['status'] == 1) { ?>

                                                            <button id="klikbahan" type="button" data-toggle="modal"
                                                                data-target="#editbahan"
                                                                data-kode="{{ $row['kode_bahan'] }}"
                                                                data-nama="{{ $row['nama_bahanbaku'] }}"
                                                                data-nobatch="{{ $row['no_batch'] }}"
                                                                data-tglambil="{{ $row['tanggal_ambil'] }}"
                                                                data-kadaluarsa="{{ $row['kedaluwarsa'] }}"
                                                                data-jumlahbox="{{ $row['jumlah_kemasanbox'] }}"
                                                                data-jumlahproduk="{{ $row['jumlah_produk'] }}"
                                                                data-jeniswarna="{{ $row['jenis_warnakemasan'] }}"
                                                                data-id="{{ $row['id_bahanbaku'] }}"
                                                                class="btn btn-danger disabled">Edit</button>

                                                            <?php } ?>
                                                        </td>
                                                    @else
                                                        <?php if ($row['status'] == 0) { ?>
                                                        <td>
                                                            <form method="post" action="terimaambilbahanbaku"
                                                                id="terimalaporan1{{ $row['id_bahanbaku'] }}">
                                                                @csrf
                                                                <input type="hidden" name="nobatch"
                                                                    value="{{ $row['no_batch'] }}" />

                                                                <input type="hidden" name="id"
                                                                    value="{{ $row['id_bahanbaku'] }}" />
                                                                <button type="button"
                                                                    onclick="TerimaLaporanMultiP(1,{{ $row['id_bahanbaku'] }})"
                                                                    class="btn btn-primary">Terima</button>
                                                            </form>
                                                        </td>
                                                        <?php } elseif ($row['status'] == 1) { ?>
                                                        <td>
                                                            <form method="post" action="terimaambilbahanbaku"
                                                                id="terimalaporan2">
                                                                @csrf
                                                                <input type="hidden" name="nobatch"
                                                                    value="{{ $row['no_batch'] }}" />
                                                                <button type="button" onclick="TerimaLaporanMultiP(2)"
                                                                    class="btn btn-danger" disabled>Terima</button>
                                                            </form>
                                                        </td>
                                                        <?php } ?>
                                                    @endif
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
                                    Produk
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    <!-- Button to trigger modal -->
                                    @if (Auth::user()->level != 2)
                                        <button class="btn btn-success btn-lg" data-toggle="modal"
                                            data-target="#modalForm5" onclick="setdatetoday1(2)">
                                            Tambah Sampel Produk
                                        </button>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalForm5" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Sampel Produk</h4>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="card mb-4">
                                                        <div class="card-header" id='headertgl2'></div>
                                                        <div class="card-header">Produk</div>
                                                        <div class="card-body">
                                                            <p class="statusMsg"></p>
                                                            <form role="form" method="post"
                                                                action="tambah_contohproduk" id='forminput2'>
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Sesuai
                                                                        Dengan PROTAP No</label>
                                                                    <div class="col-sm">
                                                                        <select name="protap" class="form-control 2">
                                                                            @foreach ($protap2 as $isi)
                                                                                <option value="{{ $isi['protap_id'] }}">
                                                                                    {{ $isi['protap_nama'] }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        <div id="error-box" style="color: red"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Nama Produk</label>
                                                                    <div class="col-sm">
                                                                        <input class="form-control 2"
                                                                            list="listnamaproduk" type="text"
                                                                            name='nama_produk' id="namaproduk"
                                                                            autocomplete="off">
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
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Kode
                                                                        Produk</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="kode_produk" readonly
                                                                            class="form-control 2" id="kodeproduk"
                                                                            placeholder="Kode Produk" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">No
                                                                        Batch</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="nobatch"
                                                                            class="form-control 2"
                                                                            placeholder="No Batch" maxlength="20"/>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="tanggal" id='ambil_tanggal2'
                                                                    class="form-control 2" placeholder="" />

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Kedaluwarsa</label>
                                                                    <div class="col-sm">
                                                                        <input type="date" name="kedaluwarsa"
                                                                            class="form-control 2" placeholder="" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jumlah
                                                                        Produk dalam Box</label>
                                                                    <div class="col-sm">

                                                                        <div class="row">
                                                                            <div class="col-sm-8"
                                                                                data-tip="Hanya angka saja">
                                                                                <input type="number" name="jumlah_box"
                                                                                    class="form-control 2"
                                                                                    placeholder="Jumlah Produk Dalam Box" />
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <select class="form-select"
                                                                                    name="satuanbox" id="">
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

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jumlah
                                                                        Produk Yang Diambil</label>
                                                                    <div class="col-sm">

                                                                        <div class="row">
                                                                            <div class="col-sm-8"
                                                                                data-tip="Hanya angka saja">
                                                                                <input type="number" name="jumlah_ambil"
                                                                                    class="form-control 2"
                                                                                    placeholder="Jumlah Produk Yang Diambil" />
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <select class="form-select"
                                                                                    name="satuanproduk" id="">
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

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jenis
                                                                        dan Warna Kemasan</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="jenis_warna_kemasan"
                                                                            class="form-control 2"
                                                                            placeholder="Jenis dan Warna Kemasan" />
                                                                    </div>
                                                                </div>

                                                                <a class="btn btn-primary" onclick="salert1(2)"
                                                                    href="#"
                                                                    style="float:left; width: 100px;  margin-left:25px"
                                                                    role="button">Simpan</a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- pop up end -->

                                    <table id="tabel2" class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Sesuai PROTAP</th>
                                                <th scope="col">Kode Produk</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Tanggal Pengambilan Sampel</th>
                                                <th scope="col">Kedaluwarsa</th>
                                                <th scope="col">Jumlah Produk dalam Box</th>
                                                <th scope="col">Jumlah Produk Yang Diambil</th>
                                                <th scope="col">Jenis Dan warna kemasan</th>
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
                                                    <td>{{ $row['protap_nama'] }}</td>
                                                    <td>{{ $row['kode_produk'] }}</td>
                                                    <td>{{ $row['nama_produkjadi'] }}</td>
                                                    <td>{{ $row['no_batch'] }}</td>
                                                    <td>{{ $row['tanggal_ambil'] }}</td>
                                                    <td>{{ $row['kedaluwarsa'] }}</td>
                                                    <td>{{ $row['jumlah_kemasanbox'] }}</td>
                                                    <td>{{ $row['jumlah_produk'] }}</td>
                                                    <td>{{ $row['jenis_warnakemasan'] }}</td>
                                                    <td>
                                                        @if ($row['status'] == 0)
                                                            {{ 'Diajukan' }}
                                                        @else
                                                            {{ 'Diterima' }}
                                                        @endif
                                                    </td>
                                                    @if (Auth::user()->level != 2)
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                            <form action="#">
                                                                @csrf
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button id="klikproduk" type="button"
                                                                    data-toggle="modal" data-target="#editproduk"
                                                                    data-protap="{{ $row['protap_id'] }}"
                                                                    data-kode="{{ $row['kode_produk'] }}"
                                                                    data-nama="{{ $row['nama_produkjadi'] }}"
                                                                    data-nobatch="{{ $row['no_batch'] }}"
                                                                    data-tglambil="{{ $row['tanggal_ambil'] }}"
                                                                    data-kadaluarsa="{{ $row['kedaluwarsa'] }}"
                                                                    data-jumlahbox="{{ preg_replace('/[^0-9]/', '', $row['jumlah_kemasanbox']) }}"
                                                                    data-satuanbox="{{ preg_replace('/[^a-zA-Z]+/', '', $row['jumlah_kemasanbox']) }}"
                                                                    data-jumlahproduk="{{ preg_replace('/[^0-9]/', '', $row['jumlah_produk']) }}"
                                                                    data-satuanproduk="{{ preg_replace('/[^a-zA-Z]+/', '', $row['jumlah_produk']) }}"
                                                                    data-jeniswarna="{{ $row['jenis_warnakemasan'] }}"
                                                                    data-id="{{ $row['id_produkjadi'] }}"
                                                                    class="btn btn-primary">Edit</button>
                                                            </form>
                                                            <?php } elseif ($row['status'] == 1) { ?>
                                                            <form action="#">
                                                                @csrf
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button id="klikproduk" type="submit"
                                                                    data-toggle="modal" data-target="#editproduk"
                                                                    data-kode="{{ $row['kode_produk'] }}"
                                                                    data-nama="{{ $row['nama_produkjadi'] }}"
                                                                    data-nobatch="{{ $row['no_batch'] }}"
                                                                    data-tglambil="{{ $row['tanggal_ambil'] }}"
                                                                    data-kadaluarsa="{{ $row['kedaluwarsa'] }}"
                                                                    data-jumlahbox="{{ $row['jumlah_kemasanbox'] }}"
                                                                    data-jumlahproduk="{{ $row['jumlah_produk'] }}"
                                                                    data-jeniswarna="{{ $row['jenis_warnakemasan'] }}"
                                                                    data-id="{{ $row['id_produkjadi'] }}"
                                                                    class="btn btn-danger disabled">Edit</button>
                                                            </form>
                                                            <?php } ?>


                                                        </td>
                                                    @else
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                            <form method="post" action="terimaambilprodukjadi"
                                                                id="terimalaporan2{{ $row['id_produkjadi'] }}">
                                                                @csrf

                                                                <input type="hidden" name="no"
                                                                    value="{{ $row['id_produkjadi'] }}" />
                                                                <input type="hidden" name="nobatch"
                                                                    value="{{ $row['no_batch'] }}" />
                                                                <input type="hidden" name="id"
                                                                    value="{{ $row['id_produkjadi'] }}" />
                                                                <button type="button"
                                                                    onclick="TerimaLaporanMultiP(2,{{ $row['id_produkjadi'] }})"
                                                                    class="btn btn-primary">Terima</button>
                                                            </form>
                                                            <?php } elseif ($row['status'] == 1) { ?>
                                                            <form method="post" action="terimaambilprodukjadi"
                                                                id="terimalaporan4">
                                                                @csrf
                                                                <input type="hidden" name="nobatch"
                                                                    value="{{ $row['no_batch'] }}" />
                                                                <button type="button" onclick="TerimaLaporanMultiP(4)"
                                                                    class="btn btn-danger" disabled>Terima</button>
                                                            </form>
                                                            <?php } ?>
                                                        </td>
                                                    @endif
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
                                    Kemasan
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    <!-- Button to trigger modal -->
                                    @if (Auth::user()->level != 2)
                                        <button class="btn btn-success btn-lg" data-toggle="modal"
                                            data-target="#modalForm6" onclick="setdatetoday1(3)">
                                            Tambah Sampel Kemasan
                                        </button>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalForm6" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Sampel Kemasan</h4>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="card mb-4">
                                                        <div class="card-header" id='headertgl3'></div>
                                                        <div class="card-header">Kemasan</div>
                                                        <div class="card-body">
                                                            <p class="statusMsg"></p>
                                                            <form role="form" method="post"
                                                                action="tambah_contohkemasan" id='forminput3'>
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Sesuai
                                                                        Dengan PROTAP No</label>
                                                                    <div class="col-sm">
                                                                        <select name="protap" class="form-control 3">
                                                                            @foreach ($protap3 as $isi)
                                                                                <option value="{{ $isi['protap_id'] }}">
                                                                                    {{ $isi['protap_nama'] }}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        <div id="error-box" style="color: red"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Nama
                                                                        Kemasan</label>
                                                                    <div class="col-sm">
                                                                        <input class="form-control 3"
                                                                            list="listnamakemasan" type="text"
                                                                            name='nama_kemasan' id="namakemasan"
                                                                            autocomplete="off">
                                                                        </input>
                                                                        <datalist id='listnamakemasan'>
                                                                            @foreach ($kemasan as $row)
                                                                                <option
                                                                                    value="{{ $row['kemasan_nama'] }}">
                                                                                    {{ $row['kemasan_nama'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        </datalist>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Kode
                                                                        Kemasan</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="kode_kemasan" readonly
                                                                            class="form-control 3" id="kodekemasan"
                                                                            placeholder="Kode Kemasan" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">No
                                                                        Batch</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="nobatch"
                                                                            class="form-control 3"
                                                                            placeholder="No Batch" maxlength="20"/>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="tanggal" id='ambil_tanggal3'
                                                                    class="form-control 3" placeholder="" />

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Kedaluwarsa</label>
                                                                    <div class="col-sm">
                                                                        <input type="date" name="kedaluwarsa"
                                                                            class="form-control 3" placeholder="" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jumlah
                                                                        Kemasan dalam Box</label>
                                                                    <div class="col-sm">

                                                                        <div class="row">
                                                                            <div class="col-sm-8"
                                                                                data-tip="Hanya angka saja">
                                                                                <input type="number" name="jumlah_box"
                                                                                    class="form-control 3"
                                                                                    placeholder="Jumlah Kemasan dalam Box" />
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <select class="form-select"
                                                                                    name="satuanbox" id="">
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

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jumlah
                                                                        Kemasan Yang Disampling</label>
                                                                    <div class="col-sm">

                                                                        <div class="row">
                                                                            <div class="col-sm-8"
                                                                                data-tip="Hanya angka saja">
                                                                                <input type="number" name="jumlah_ambil"
                                                                                    class="form-control 3"
                                                                                    placeholder="Jumlah Produk Yang Diambil" />
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <select class="form-select"
                                                                                    name="satuanproduk" id="">
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

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jenis
                                                                        dan Warna Kemasan</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="jenis_warna_kemasan"
                                                                            class="form-control 3"
                                                                            placeholder="Jenis dan Warna Kemasan" />
                                                                    </div>
                                                                </div>

                                                                <a class="btn btn-primary" onclick="salert1(3)"
                                                                    href="#"
                                                                    style="float:left; width: 100px;  margin-left:25px"
                                                                    role="button">Simpan</a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- pop up end -->

                                    <table id="tabel3" class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Sesuai PROTAP</th>
                                                <th scope="col">Kode Bahan Baku</th>
                                                <th scope="col">Nama Bahan Baku</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Tanggal Pengambilan Sampel</th>
                                                <th scope="col">Kedaluwarsa</th>
                                                <th scope="col">Jumlah Kemasan Dalam Box</th>
                                                <th scope="col">Jumlah Produk Yang Diambil</th>
                                                <th scope="col">Jenis Dan warna kemasan</th>
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
                                                    <td>{{ $row['protap_nama'] }}</td>
                                                    <td>{{ $row['kode_kemasan'] }}</td>
                                                    <td>{{ $row['nama_kemasan'] }}</td>
                                                    <td>{{ $row['no_batch'] }}</td>
                                                    <td>{{ $row['tanggal_ambil'] }}</td>
                                                    <td>{{ $row['kedaluwarsa'] }}</td>
                                                    <td>{{ $row['jumlah_kemasanbox'] }}</td>
                                                    <td>{{ $row['jumlah_produk'] }}</td>
                                                    <td>{{ $row['jenis_warnakemasan'] }}</td>
                                                    <td>
                                                        @if ($row['status'] == 0)
                                                            {{ 'Diajukan' }}
                                                        @else
                                                            {{ 'Diterima' }}
                                                        @endif
                                                    </td>
                                                    @if (Auth::user()->level != 2)
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                            <form action="#">
                                                                @csrf
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button id="klikkemasan" type="button"
                                                                    data-toggle="modal" data-target="#editkemasan"
                                                                    data-protap="{{ $row['protap_id'] }}"
                                                                    data-kode="{{ $row['kode_kemasan'] }}"
                                                                    data-nama="{{ $row['nama_kemasan'] }}"
                                                                    data-nobatch="{{ $row['no_batch'] }}"
                                                                    data-tglambil="{{ $row['tanggal_ambil'] }}"
                                                                    data-kadaluarsa="{{ $row['kedaluwarsa'] }}"
                                                                    data-jumlahbox="{{ preg_replace('/[^0-9]/', '', $row['jumlah_kemasanbox']) }}"
                                                                    data-satuanbox="{{ preg_replace('/[^a-zA-Z]+/', '', $row['jumlah_kemasanbox']) }}"
                                                                    data-jumlahproduk="{{ preg_replace('/[^0-9]/', '', $row['jumlah_produk']) }}"
                                                                    data-satuanproduk="{{ preg_replace('/[^a-zA-Z]+/', '', $row['jumlah_produk']) }}"
                                                                    data-jeniswarna="{{ $row['jenis_warnakemasan'] }}"
                                                                    data-id="{{ $row['id_kemasan'] }}"
                                                                    class="btn btn-primary">Edit</button>
                                                            </form>
                                                            <?php } elseif ($row['status'] == 1) { ?>
                                                            <form action="#">
                                                                @csrf
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button id="klikkemasan" type="submit"
                                                                    data-toggle="modal" data-target="#editkemasan"
                                                                    data-kode="{{ $row['kode_kemasan'] }}"
                                                                    data-nama="{{ $row['nama_kemasan'] }}"
                                                                    data-nobatch="{{ $row['no_batch'] }}"
                                                                    data-tglambil="{{ $row['tanggal_ambil'] }}"
                                                                    data-kadaluarsa="{{ $row['kedaluwarsa'] }}"
                                                                    data-jumlahbox="{{ $row['jumlah_kemasanbox'] }}"
                                                                    data-jumlahproduk="{{ $row['jumlah_produk'] }}"
                                                                    data-jeniswarna="{{ $row['jenis_warnakemasan'] }}"
                                                                    data-id="{{ $row['id_kemasan'] }}"
                                                                    class="btn btn-danger disabled">Edit</button>
                                                            </form>
                                                            <?php } ?>

                                                        </td>
                                                    @else
                                                        <td>
                                                            <?php if ($row['status'] == 0) { ?>
                                                            <form method="post" action="terimaambilbahankemas"
                                                                id="terimalaporan3{{ $row['id_kemasan'] }}">
                                                                @csrf
                                                                <input type="hidden" name="nobatch"
                                                                    value="{{ $row['no_batch'] }}" />

                                                                <input type="hidden" name="id"
                                                                    value="{{ $row['id_kemasan'] }}" />
                                                                <button type="button"
                                                                    onclick="TerimaLaporanMultiP(3,{{ $row['id_kemasan'] }})"
                                                                    class="btn btn-primary">Terima</button>
                                                            </form>
                                                            <?php } elseif ($row['status'] == 1) { ?>
                                                            <form method="post" action="terimaambilbahankemas"
                                                                id="terimalaporan6">
                                                                @csrf
                                                                <input type="hidden" name="nobatch"
                                                                    value="{{ $row['no_batch'] }}" />
                                                                <button type="button" onclick="TerimaLaporanMultiP(6)"
                                                                    class="btn btn-danger" disabled>Terima</button>
                                                            </form>
                                                            <?php } ?>

                                                        </td>
                                                    @endif
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

        <!-- Modal Edit Bahan -->
        <div class="modal fade" id="editbahan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Sampel Bahan Baku</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl1'></div>
                            <div class="card-header">Bahan Baku</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="edit_contohbahan" id='forminput7'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" id="id_bahan" />
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                            Dengan PROTAP No</label>
                                        <div class="col-sm">
                                            <select name="protap" class="form-control 7" id="bahan_protap">
                                                @foreach ($protap1 as $isi)
                                                    <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div id="error-box" style="color: red"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama Bahan
                                            Baku</label>
                                        <div class="col-sm">
                                            <input class="form-control 7" list="listnamabahanbaku" type="text"
                                                name='nama_bahan' id="bahan_nama" autocomplete="off">
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
                                            <input type="text" name="kode_bahan" readonly class="form-control 7"
                                                id="bahan_kode" placeholder="Kode Bahan Baku" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                            Batch</label>
                                        <div class="col-sm">
                                            <input type="text" name="nobatch" class="form-control 7"
                                                tch" id="bahan_nobatch" />
                                        </div>
                                    </div>

                                    <input type="hidden" name="tanggal" id='ambil_tanggal1' class="tanggal"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kedaluwarsa</label>
                                        <div class="col-sm">
                                            <input type="date" name="kedaluwarsa" class="form-control 7"
                                                placeholder="" id="bahan_kadaluarsa" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                            Bahan Baku dalam Box</label>
                                        <div class="col-sm">
                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah_box" class="form-control 7"
                                                        placeholder="Jumlah Bahan Baku dalam Box" id="bahan_jumlahbox" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuanbox" id="bahan_box">
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

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                            Produk Yang Diambil</label>
                                        <div class="col-sm">

                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah_ambil" class="form-control 7"
                                                        placeholder="Jumlah Produk Yang Diambil" id="bahan_jumlahambil" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuanproduk" id="bahan_produk">
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

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis
                                            dan Warna Kemasan</label>
                                        <div class="col-sm">
                                            <input type="text" name="jenis_warna_kemasan" class="form-control 7"
                                                placeholder="Jenis dan Warna Kemasan" id="bahan_jeniswarna" />
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" onclick="salert1(7)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editproduk" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Sampel Produk</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl2'></div>
                            <div class="card-header">Produk</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="edit_contohproduk" id='forminput8'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" id="id_produk" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                            Dengan PROTAP No</label>
                                        <div class="col-sm">

                                            <select name="protap" class="form-control 8" id="produk_protap">
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
                                            <input class="form-control 8" list="listnamaproduk" type="text"
                                                name='nama_produk' id="produk_nama" autocomplete="off">
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
                                            <input type="text" name="kode_produk" readonly class="form-control 8"
                                                id="produk_kode" placeholder="Kode Produk" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                            Batch</label>
                                        <div class="col-sm">
                                            <input type="text" name="nobatch" class="form-control 8"
                                                tch" id="produk_nobatch" />
                                        </div>
                                    </div>

                                    <input type="hidden" name="tanggal" id='ambil_tanggal2' class="tanggal"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kedaluwarsa</label>
                                        <div class="col-sm">
                                            <input type="date" name="kedaluwarsa" class="form-control 8"
                                                placeholder="" id="produk_kadaluarsa" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                            Produk dalam Box</label>
                                        <div class="col-sm">

                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah_box" class="form-control 8"
                                                        placeholder="Jumlah Produk Dalam Box" id="produk_jumlahbox" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuanbox" id="produk_box">
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

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                            Produk Yang Diambil</label>
                                        <div class="col-sm">

                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah_ambil" class="form-control 8"
                                                        placeholder="Jumlah Produk Yang Diambil"
                                                        id="produk_jumlahambil" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuanproduk" id="produk_produk">
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

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis
                                            dan Warna Kemasan</label>
                                        <div class="col-sm">
                                            <input type="text" name="jenis_warna_kemasan" class="form-control 8"
                                                placeholder="Jenis dan Warna Kemasan" id="produk_jeniswarna" />
                                        </div>
                                    </div>

                                    <a class="btn btn-primary" onclick="salert1(8)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Kemasan-->
        <div class="modal fade" id="editkemasan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Edit Sampel Kemasan</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl3'></div>
                            <div class="card-header">Kemasan</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="edit_contohkemasan" id='forminput9'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" id="id_kemasan" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                            Dengan PROTAP No</label>
                                        <div class="col-sm">
                                            <select name="protap" class="form-control 9" id="kemasan_protap">
                                                @foreach ($protap3 as $isi)
                                                    <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div id="error-box" style="color: red"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                            Kemasan</label>
                                        <div class="col-sm">
                                            <input class="form-control 9" list="listnamakemasan" type="text"
                                                name='nama_kemasan' id="kemasan_nama" autocomplete="off">
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
                                            <input type="text" name="kode_kemasan" readonly class="form-control 9"
                                                id="kemasan_kode" placeholder="Kode Kemasan" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                            Batch</label>
                                        <div class="col-sm">
                                            <input type="text" name="nobatch" class="form-control 9"
                                                placeholder="No Batch" id="kemasan_nobatch" maxlength="20"/>
                                        </div>
                                    </div>

                                    <input type="hidden" name="tanggal" id='ambil_tanggal3' class="tanggal"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kedaluwarsa</label>
                                        <div class="col-sm">
                                            <input type="date" name="kedaluwarsa" class="form-control 9"
                                                placeholder="" id="kemasan_kadaluarsa" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                            Kemasan dalam Box</label>
                                        <div class="col-sm">

                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah_box" class="form-control 9"
                                                        placeholder="Jumlah Kemasan dalam Box" id="kemasan_jumlahbox" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuanbox" id="kemasan_box">
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

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah kemasan yang
                                            disampel</label>
                                        <div class="col-sm">

                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah_ambil" class="form-control 9"
                                                        placeholder="Jumlah Kemasan Yang Diambil"
                                                        id="kemasan_jumlahambil" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuanproduk"
                                                        id="kemasan_produk">
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

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis
                                            dan Warna Kemasan</label>
                                        <div class="col-sm">
                                            <input type="text" name="jenis_warna_kemasan" class="form-control 9"
                                                placeholder="Jenis dan Warna Kemasan" id="kemasan_jeniswarna" />
                                        </div>
                                    </div>

                                    <a class="btn btn-primary" onclick="salert1(9)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            var produks = JSON.parse('<?= json_encode($produk) ?>')
            var kemasans = JSON.parse('<?= json_encode($kemasan) ?>')
            var bahanbakus = JSON.parse('<?= json_encode($bahanbaku) ?>')

            numericPattern = '/^[0-9]*$/';
            function numericOnly(event) {
                return this.numericPattern.test(event.key);
            }
            $("#namabahanbaku").change(function() {
                var tmp = []
                if (typeof bahanbakus === 'object') {
                    Object.keys(bahanbakus).forEach(function(key) {
                        tmp.push(bahanbakus[key]);
                    })
                    bahanbakus = tmp
                }
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
                    kemasans = tmp
                }
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
                    produks = tmp
                }
                var cekname = produks.find(produk => produk.produk_nama ===
                    document.getElementById('namaproduk').value)?.produk_nama;
                
                if (cekname) {
                    document.getElementById('kodeproduk').value = produks.find(produk => produk.produk_nama ===
                        document.getElementById('namaproduk').value).produk_kode
                } else {
                    document.getElementById('kodeproduk').value = ""
                }
            });

            $("#bahan_nama").change(function() {
                var tmp = []
                if (typeof bahanbakus === 'object') {
                    Object.keys(bahanbakus).forEach(function(key) {
                        tmp.push(bahanbakus[key]);
                    })

                    bahanbakus = tmp
                }
                var cekname = bahanbakus.find(bahanbaku => bahanbaku.bahanbaku_nama ===
                    document.getElementById('bahan_nama').value)?.bahanbaku_nama;
                
                if (cekname) {
                    document.getElementById('bahan_kode').value = bahanbakus.find(bahanbaku => bahanbaku
                        .bahanbaku_nama ===
                        document.getElementById('bahan_nama').value).bahanbaku_kode
                } else {
                    document.getElementById('bahan_kode').value = ""
                }
            });
            $("#kemasan_nama").change(function() {
                var tmp = []
                if (typeof kemasans === 'object') {
                    Object.keys(kemasans).forEach(function(key) {
                        tmp.push(kemasans[key]);
                    })
                    kemasans = tmp
                }
                var cekname = kemasans.find(kemasan => kemasan.kemasan_nama ===
                    document.getElementById('kemasan_nama').value)?.kemasan_nama;
               

                if (cekname) {
                    document.getElementById('kemasan_kode').value = kemasans.find(kemasan => kemasan.kemasan_nama ===
                        document.getElementById('kemasan_nama').value).kemasan_kode
                } else {
                    document.getElementById('kemasan_kode').value = ""
                }
            });
            $("#produk_nama").change(function() {
                var tmp = []
                if (typeof produks === 'object') {
                    Object.keys(produks).forEach(function(key) {
                        tmp.push(produks[key]);
                    })
                    produks = tmp
                }
                var cekname = produks.find(produk => produk.produk_nama ===
                    document.getElementById('produk_nama').value)?.produk_nama;
                

                if (cekname) {
                    document.getElementById('produk_kode').value = produks.find(produk => produk.produk_nama ===
                        document.getElementById('produk_nama').value).produk_kode
                } else {
                    document.getElementById('produk_kode').value = ""
                }
            });


            $(document).on('click', "#klikbahan", function() {
                var nama = $(this).data('nama');
                var kode = $(this).data('kode');
                var tglambil = $(this).data('tglambil');
                var kadaluarsa = $(this).data('kadaluarsa');
                var nobatch = $(this).data('nobatch');
                var jumlahbox = $(this).data('jumlahbox');
                var jumlahproduk = $(this).data('jumlahproduk');
                var satuanbox = $(this).data('satuanbox');
                var satuanproduk = $(this).data('satuanproduk');
                var jeniswarna = $(this).data('jeniswarna');
                var id = $(this).data('id');
                var protap = $(this).data('protap');

                $("#bahan_protap").val(protap);
                $("#bahan_nama").val(nama);
                $("#bahan_box").val(satuanbox);
                $("#bahan_produk").val(satuanproduk);
                $("#bahan_kode").val(kode);
                $("#bahan_tglambil").val(tglambil);
                $("#bahan_nobatch").val(nobatch);
                $("#bahan_kadaluarsa").val(kadaluarsa);
                $("#bahan_jumlahambil").val(jumlahproduk);
                $("#bahan_jumlahbox").val(jumlahbox);
                $("#bahan_jeniswarna").val(jeniswarna);
                $("#id_bahan").val(id);
            })

            $(document).on('click', "#klikproduk", function() {
                var nama = $(this).data('nama');
                var kode = $(this).data('kode');
                var tglambil = $(this).data('tglambil');
                var kadaluarsa = $(this).data('kadaluarsa');
                var nobatch = $(this).data('nobatch');
                var jumlahbox = $(this).data('jumlahbox');
                var jumlahproduk = $(this).data('jumlahproduk');
                var satuanbox = $(this).data('satuanbox');
                var satuanproduk = $(this).data('satuanproduk');
                var jeniswarna = $(this).data('jeniswarna');
                var id = $(this).data('id');
                var protap = $(this).data('protap');


                $("#produk_protap").val(protap);
                $("#produk_nama").val(nama);
                $("#produk_kode").val(kode);
                $("#produk_box").val(satuanbox);
                $("#produk_produk").val(satuanproduk);
                $("#produk_tglambil").val(tglambil);
                $("#produk_nobatch").val(nobatch);
                $("#produk_kadaluarsa").val(kadaluarsa);
                $("#produk_jumlahambil").val(jumlahproduk);
                $("#produk_jumlahbox").val(jumlahbox);
                $("#produk_jeniswarna").val(jeniswarna);
                $("#id_produk").val(id);
            })

            $(document).on('click', "#klikkemasan", function() {
                var nama = $(this).data('nama');
                var kode = $(this).data('kode');
                var tglambil = $(this).data('tglambil');
                var kadaluarsa = $(this).data('kadaluarsa');
                var nobatch = $(this).data('nobatch');
                var jumlahbox = $(this).data('jumlahbox');
                var jumlahproduk = $(this).data('jumlahproduk');
                var satuanbox = $(this).data('satuanbox');
                var satuanproduk = $(this).data('satuanproduk');
                var jeniswarna = $(this).data('jeniswarna');
                var id = $(this).data('id');
                var protap = $(this).data('protap');


                $("#kemasan_protap").val(protap);
                $("#kemasan_kode").val(kode);
                $("#kemasan_nama").val(nama);
                $("#kemasan_box").val(satuanbox);
                $("#kemasan_produk").val(satuanproduk);
                $("#kemasan_tglambil").val(tglambil);
                $("#kemasan_nobatch").val(nobatch);
                $("#kemasan_kadaluarsa").val(kadaluarsa);
                $("#kemasan_jumlahambil").val(jumlahproduk);
                $("#kemasan_jumlahbox").val(jumlahbox);
                $("#kemasan_jeniswarna").val(jeniswarna);
                $("#id_kemasan").val(id);
            })

            // $(document).ready(function() {
            //     $('#dataTable1').DataTable()
            //     $('#dataTable2').DataTable()
            //     $('#dataTable3').DataTable()
            // })
        </script>
    </main>
@endsection
