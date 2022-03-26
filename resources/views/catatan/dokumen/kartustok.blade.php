@extends('layout.app')
@section('title')
    <title>Kartu Stok</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Catatan Kartu Stok</h1>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Bahan Baku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Produk Antara</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Ruang Timbang</a>
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
                                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm4"
                                        onclick="setdatetoday1(1)">
                                        Tambah Kartu Stok Bahan Baku
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalForm4" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Contoh Bahan Baku</h4>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="card mb-4">
                                                        <div class="card-header" id='headertgl1'></div>
                                                        <div class="card-header">Bahan Baku</div>
                                                        <div class="card-body">
                                                            <p class="statusMsg"></p>
                                                            <form role="form" method="post" action="tambah_kartustok"
                                                                id='forminput1'>
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />
                                                                <div class="card-body">

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-4 col-form-label">Kode
                                                                            Kartu Stok</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="kode_stok"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Kode Kartu Stok" />
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" id='ambil_tanggal1'
                                                                        class="form-control 1" name="tanggal"
                                                                        placeholder="" />

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">No
                                                                            Batch</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="no_batch"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="No Batch" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Jumlah</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="jumlah"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Jumlah" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Nama
                                                                            Distributor</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="nama_distributor"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Nama Distributor" />
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <a class="btn btn-primary" onclick="salert()" href="#"
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

                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Distribusi</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Jumlah Produk</th>
                                                <th scope="col">Nama Distributor</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($data as $row)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $row['id_kartustok'] }}</td>
                                                    <td>{{ $row['tanggal'] }}</td>
                                                    <td>{{ $row['id_batch'] }}</td>
                                                    <td>{{ $row['jumlah'] }}</td>
                                                    <td>{{ $row['nama_distributor'] }}</td>
                                                    <td>
                                                        <form method="post" action="detil_batch">
                                                            <input type="hidden" name="_token" value="" />
                                                            <input type="hidden" name="nobatch" value="" />
                                                            <button type="submit" class="btn btn-primary">Buka</button>
                                                        </form>
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
                                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm5"
                                        onclick="setdatetoday1(2)">
                                        Tambah Penimbangan Produk Antara
                                    </button>

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
                                                            <form role="form" method="post"
                                                                action="tambah_penimbanganprodukantara" id='forminput2'>
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Kode
                                                                        Produk Antara</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="kode_produk"
                                                                            class="form-control 2" id="inputEmail3"
                                                                            placeholder="Kode Produk" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Nama
                                                                        Produk Antara</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="nama_produk"
                                                                            class="form-control 2" id="inputEmail3"
                                                                            placeholder="Nama Produk" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">No
                                                                        Batch</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="nobatch"
                                                                            class="form-control 2" id="inputEmail3"
                                                                            placeholder="No Batch" />
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="tanggal" id='ambil_tanggal2'
                                                                    class="form-control 2" placeholder="" />

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Asal Produk</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="asal_produk"
                                                                            class="form-control 2" id="inputEmail3"
                                                                            placeholder="Asal Produk" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jumlah
                                                                        Produk Antara</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="jumlah_produk"
                                                                            class="form-control 2" id="inputEmail3"
                                                                            placeholder="Jumlah
                                                                                                                                                                                                                                                                                Produk Antara" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Hasil
                                                                        Penimbangan</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="hasil_penimbangan"
                                                                            class="form-control 2" id="inputEmail3"
                                                                            placeholder="Hasil Penimbangan" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Untuk
                                                                        Produk</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="untuk_produk"
                                                                            class="form-control 2" id="inputEmail3"
                                                                            placeholder="Untuk Produk" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Persetujuan
                                                                        PJT</label>
                                                                    <div class="col-sm">
                                                                        <select style="height: 35px;"
                                                                            class="form-control 2" name="pjt"
                                                                            id="inlineFormCustomSelect">
                                                                            <option selected>Pilih...</option>
                                                                            <option value="1">Disetujui</option>
                                                                            <option value="0">Ditolak</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <a class="btn btn-primary" onclick="salert1(2)" href="#"
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

                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kode Distribusi</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Jumlah Produk</th>
                                                <th scope="col">Nama Distributor</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($data as $row)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $row['id_kartustok'] }}</td>
                                                    <td>{{ $row['tanggal'] }}</td>
                                                    <td>{{ $row['id_batch'] }}</td>
                                                    <td>{{ $row['jumlah'] }}</td>
                                                    <td>{{ $row['nama_distributor'] }}</td>
                                                    <td>
                                                        <form method="post" action="detil_batch">
                                                            <input type="hidden" name="_token" value="" />
                                                            <input type="hidden" name="nobatch" value="" />
                                                            <button type="submit" class="btn btn-primary">Buka</button>
                                                        </form>
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
                                    Ruang Timbang
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    <!-- Button to trigger modal -->
                                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm6"
                                        onclick="setdatetoday1(3)">
                                        Tambah Ruang Timbang
                                    </button>

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
                                                            <form role="form" method="post" action="tambah_ruangtimbang"
                                                                id='forminput3'>
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Kode
                                                                        Ruang Timbang</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="kode_ruangtimbang"
                                                                            class="form-control 3" id="inputEmail3"
                                                                            placeholder="Kode Ruang Timbang" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Nama
                                                                        Bahan Baku</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="nama_bahanbaku"
                                                                            class="form-control 3" id="inputEmail3"
                                                                            placeholder="Nama Bahan Baku" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">No Loth</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="no_loth"
                                                                            class="form-control 3" id="inputEmail3"
                                                                            placeholder="No Loth" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jumlah Bahan
                                                                        Baku</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="jumlah_bahanbaku"
                                                                            class="form-control 3" id="inputEmail3"
                                                                            placeholder="Jumlah Bahan Baku" />
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="tanggal" id='ambil_tanggal3'
                                                                    class="form-control 3" placeholder="" />

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Jumlah
                                                                        Permintaan</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="jumlah_permintaan"
                                                                            class="form-control 3" id="inputEmail3"
                                                                            placeholder="Jumlah Permintaan" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Hasil
                                                                        Penimbangan</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="hasil_penimbangan"
                                                                            class="form-control 3" id="inputEmail3"
                                                                            placeholder="Hasil Penimbangan" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Untuk
                                                                        Produk</label>
                                                                    <div class="col-sm">
                                                                        <input type="text" name="untuk_produk"
                                                                            class="form-control 3" id="inputEmail3"
                                                                            placeholder="Untuk Produk" />
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="inputEmail3"
                                                                        class="col-sm-3 col-form-label">Persetujuan
                                                                        PJT</label>
                                                                    <div class="col-sm">
                                                                        <select style="height: 35px;"
                                                                            class="form-control 3" name="pjt"
                                                                            id="inlineFormCustomSelect">
                                                                            <option selected>Pilih...</option>
                                                                            <option value="1">Disetujui</option>
                                                                            <option value="0">Ditolak</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <a class="btn btn-primary" onclick="salert1(3)" href="#"
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

                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Kode Bahan Baku</th>
                                                <th scope="col">Nama Bahan Baku</th>
                                                <th scope="col">No Loth</th>
                                                <th scope="col">Jumlah Bahan Baku</th>
                                                <th scope="col">Jumlah Permintaan</th>
                                                <th scope="col">Hasil Penimbangan (Kg)</th>
                                                <th scope="col">Untuk Produk</th>
                                                <th scope="col">Persetujuan PJT</th>
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
                                                    <td>{{ $row['id_ruangtimbang'] }}</td>
                                                    <td>{{ $row['nama_bahan_baku'] }}</td>
                                                    <td>{{ $row['no_loth'] }}</td>
                                                    <td>{{ $row['jumlah_bahan_baku'] }}</td>
                                                    <td>{{ $row['jumlah_permintaan'] }}</td>
                                                    <td>{{ $row['hasil_penimbangan'] }}</td>
                                                    <td>{{ $row['untuk_produk'] }}</td>
                                                    <td><?php if ($row['pjt'] == 1) {
                                                        echo 'Disetujui';
                                                    } else {
                                                        echo 'Ditolak';
                                                    } ?></td>
                                                    <td>
                                                        <form method="post" action="detil_batch">
                                                            <input type="hidden" name="_token" value="" />
                                                            <input type="hidden" name="nobatch" value="" />
                                                            <button type="submit" class="btn btn-primary">Buka</button>
                                                        </form>
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
@endsection
