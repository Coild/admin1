@extends('layout.app')
@section('title')
    <title>Pembersihan Ruangan</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Catatan Penerimaan Penyerahan dan Penyimpanan</h1>
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
                                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm4">
                                        Tambah Contoh Bahan Baku
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
                                                    <p class="statusMsg"></p>
                                                    <form role="form">
                                                        @csrf
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama
                                                                Bahan</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="nama_bahan" class="form-control"
                                                                    id="inputEmail3" placeholder="Nama Bahan" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No
                                                                Batch</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="nobatch" class="form-control"
                                                                    id="inputEmail3" placeholder="No Batch" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal
                                                                Pengambilan Contoh</label>
                                                            <div class="col-sm-10">
                                                                <input type="datetime-local" name="tanggal"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Kedaluwarsa</label>
                                                            <div class="col-sm-10">
                                                                <input type="datetime-local" name="kedaluwarsa"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah
                                                                bahan baku dalam master Box</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jumlah_box" class="form-control"
                                                                    id="inputEmail3"
                                                                    placeholder="Jumlah bahan baku dalam master Box" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah
                                                                Produk Yang Diambil</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jumlah_ambil"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Jumlah Produk Yang Diambil" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                                                dan Warna Kemasan</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jenis_warna_kemasan"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Jenis dan Warna Kemasan" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Kesimpulan</label>
                                                            <div class="col-sm-10">
                                                                <select style="height: 35px;" class="form-control"
                                                                    name="kesimpulan" id="inlineFormCustomSelect">
                                                                    <option selected>Pilih...</option>
                                                                    <option value="1">LULUS</option>
                                                                    <option value="0">DITOLAK</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary"
                                                            style="float:left; width: 100px;  margin-left:25px">SIMPAN</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- pop up end -->

                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Bahan Baku</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Tanggal Pengambilan Contoh</th>
                                                <th scope="col">Kedaluwarsa</th>
                                                <th scope="col">Jumlah bahan baku dalam master Box</th>
                                                <th scope="col">Jumlah Produk Yang Diambil</th>
                                                <th scope="col">Jenis Dan warna kemasan</th>
                                                <th scope="col">Kesimpulan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($data as $row)
                                                <?php $i = 0;
                                                $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $row['nama_bahan'] }}</td>
                                                    <td>{{ $row['no_batch'] }}</td>
                                                    <td>{{ $row['kedaluwarsa'] }}</td>
                                                    <td>{{ $row['nama_pemasok'] }}</td>
                                                    <td>{{ $row['tanggal'] }}</td>
                                                    <td>{{ $row['warna'] }}</td>
                                                    <td>{{ $row['bau'] }}</td>
                                                    <td>{{ $row['ph'] }}</td>
                                                    <td>{{ $row['berat_jenis'] }}</td>
                                                    <td><?php if ($row['kesimpulan'] == 1) {
                                                        echo 'Lulus';
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
                                            @endforeach --}}
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
                                    Produk Jadi
                                </div>
                                <div class="card-body">

                                    <!-- pop up -->
                                    <!-- Button to trigger modal -->
                                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm4">
                                        Tambah Contoh Produk Jadi
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalForm4" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Contoh Produk Jadi</h4>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <p class="statusMsg"></p>
                                                    <form role="form">
                                                        @csrf
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama
                                                                Produk Jadi</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="nama_produk_jadi"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Nama Produk Jadi" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No
                                                                Batch</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="nobatch" class="form-control"
                                                                    id="inputEmail3" placeholder="No Batch" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal
                                                                Pengambilan Contoh</label>
                                                            <div class="col-sm-10">
                                                                <input type="datetime-local" name="tanggal"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Kedaluwarsa</label>
                                                            <div class="col-sm-10">
                                                                <input type="datetime-local" name="kedaluwarsa"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah
                                                                bahan baku dalam master Box</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jumlah_box" class="form-control"
                                                                    id="inputEmail3"
                                                                    placeholder="Jumlah bahan baku dalam master Box" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah
                                                                Produk Yang Diambil</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jumlah_ambil"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Jumlah Produk Yang Diambil" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                                                dan Warna Kemasan</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jenis_warna_kemasan"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Jenis dan Warna Kemasan" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Kesimpulan</label>
                                                            <div class="col-sm-10">
                                                                <select style="height: 35px;" class="form-control"
                                                                    name="kesimpulan" id="inlineFormCustomSelect">
                                                                    <option selected>Pilih...</option>
                                                                    <option value="1">LULUS</option>
                                                                    <option value="0">DITOLAK</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary"
                                                            style="float:left; width: 100px;  margin-left:25px">SIMPAN</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- pop up end -->

                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Produk Jadi</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Tanggal Pengambilan Contoh</th>
                                                <th scope="col">Kedaluwarsa</th>
                                                <th scope="col">Jumlah Produk Jadi dalam master Box</th>
                                                <th scope="col">Jumlah Produk Yang Diambil</th>
                                                <th scope="col">Jenis Dan warna kemasan</th>
                                                <th scope="col">Kesimpulan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($data as $row)
                                                <?php $i = 0;
                                                $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $row['nama_bahan'] }}</td>
                                                    <td>{{ $row['no_batch'] }}</td>
                                                    <td>{{ $row['kedaluwarsa'] }}</td>
                                                    <td>{{ $row['nama_pemasok'] }}</td>
                                                    <td>{{ $row['tanggal'] }}</td>
                                                    <td>{{ $row['warna'] }}</td>
                                                    <td>{{ $row['bau'] }}</td>
                                                    <td>{{ $row['ph'] }}</td>
                                                    <td>{{ $row['berat_jenis'] }}</td>
                                                    <td><?php if ($row['kesimpulan'] == 1) {
                                                        echo 'Lulus';
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
                                            @endforeach --}}
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
                                    Bahan Pengemas
                                </div>
                                <div class="card-body">

                                    <!-- pop up -->
                                    <!-- Button to trigger modal -->
                                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm4">
                                        Tambah Contoh Bahan Pengemas
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalForm4" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Contoh Bahan Pengemas</h4>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <p class="statusMsg"></p>
                                                    <form role="form">
                                                        @csrf
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama
                                                                Bahan Pengemas</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="nama_bahan_pengemas"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Nama Bahan Pengemas" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No
                                                                Batch</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="nobatch" class="form-control"
                                                                    id="inputEmail3" placeholder="No Batch" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Tanggal
                                                                Pengambilan Contoh</label>
                                                            <div class="col-sm-10">
                                                                <input type="datetime-local" name="tanggal"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Kedaluwarsa</label>
                                                            <div class="col-sm-10">
                                                                <input type="datetime-local" name="kedaluwarsa"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah
                                                                bahan baku dalam master Box</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jumlah_box" class="form-control"
                                                                    id="inputEmail3"
                                                                    placeholder="Jumlah bahan baku dalam master Box" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah
                                                                Produk Yang Diambil</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jumlah_ambil"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Jumlah Produk Yang Diambil" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis
                                                                dan Warna Kemasan</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" name="jenis_warna_kemasan"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Jenis dan Warna Kemasan" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Kesimpulan</label>
                                                            <div class="col-sm-10">
                                                                <select style="height: 35px;" class="form-control"
                                                                    name="kesimpulan" id="inlineFormCustomSelect">
                                                                    <option selected>Pilih...</option>
                                                                    <option value="1">LULUS</option>
                                                                    <option value="0">DITOLAK</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary"
                                                            style="float:left; width: 100px;  margin-left:25px">SIMPAN</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- pop up end -->

                                    <table class="table mt-5">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Bahan Pengemas</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Tanggal Pengambilan Contoh</th>
                                                <th scope="col">Kedaluwarsa</th>
                                                <th scope="col">Jumlah Bahan Pengemas dalam master Box</th>
                                                <th scope="col">Jumlah Produk Yang Diambil</th>
                                                <th scope="col">Jenis Dan warna kemasan</th>
                                                <th scope="col">Kesimpulan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- @foreach ($data as $row)
                                                <?php $i = 0;
                                                $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $row['nama_bahan'] }}</td>
                                                    <td>{{ $row['no_batch'] }}</td>
                                                    <td>{{ $row['kedaluwarsa'] }}</td>
                                                    <td>{{ $row['nama_pemasok'] }}</td>
                                                    <td>{{ $row['tanggal'] }}</td>
                                                    <td>{{ $row['warna'] }}</td>
                                                    <td>{{ $row['bau'] }}</td>
                                                    <td>{{ $row['ph'] }}</td>
                                                    <td>{{ $row['berat_jenis'] }}</td>
                                                    <td><?php if ($row['kesimpulan'] == 1) {
                                                        echo 'Lulus';
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
                                            @endforeach --}}
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
