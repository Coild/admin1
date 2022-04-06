@extends('layout.app')
@section('title')
    <title>Pemeriksaan/Pengujian Bahan</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Pemeriksaan/Pengujian Bahan</h1>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Bahan Baku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Bahan Kemas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-detail-tab" data-toggle="pill" href="#pills-detail" role="tab"
                        aria-controls="pills-detail" aria-selected="false">Produk Jadi</a>
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
                                            Tambah Pengujian Bahan Baku
                                        </button>
                                    @endif
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalForm4" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Pengujian Bahan Baku</h4>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="card mb-4">
                                                        <div class="card-header" id='headertgl1'></div>
                                                        <div class="card-header">Bahan Baku</div>
                                                        <div class="card-body">
                                                            <p class="statusMsg"></p>
                                                            <form role="form" method="post" action="tambah_pemeriksaanbahan"
                                                                id='forminput1'>
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />
                                                                <div class="card-body">

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-4 col-form-label">Kode
                                                                            Pengujian</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="kode_spesifikasi"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Kode Spesifikasi" />
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" id='ambil_tanggal1'
                                                                        class="form-control 1" name="tanggal"
                                                                        placeholder="" />

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Nama
                                                                            Bahan Baku</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="nama_bahanbaku"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Nama Bahan Baku" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Jenis Sediaan
                                                                            Bahan Baku</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="jenis_sediaan"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Jenis Sediaan Bahan Baku" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Warna</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="warna"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Warna" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Aroma</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="aroma"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Aroma" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Tekstur</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="tekstur"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Tekstur" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Bobot</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="bobot"
                                                                                class="form-control 1" id="inputEmail3"
                                                                                placeholder="Bobot" />
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <a class="btn btn-primary" onclick="salert1(1)" href="#"
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
                                                <th scope="col">Warna</th>
                                                <th scope="col">Aroma</th>
                                                <th scope="col">Tekstur</th>
                                                <th scope="col">Bobot</th>
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
                                                    <td>{{ $row['kode_spesifikasi'] }}</td>
                                                    <td>{{ $row['nama_bahanbaku'] }}</td>
                                                    <td>{{ $row['warna'] }}</td>
                                                    <td>{{ $row['aroma'] }}</td>
                                                    <td>{{ $row['tekstur'] }}</td>
                                                    <td>{{ $row['bobot'] }}</td>
                                                    <td><?php if ($row['status'] == 0) {
                                                        echo 'Diajukan';
                                                    } ?></td>
                                                    @if (Auth::user()->level != 2)
                                                        <td>
                                                            <form action="#">
                                                                <input type="hidden" name="_token" value="" />
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <form method="post" action="terimakartustokbahan">
                                                                @csrf
                                                                <!-- <input type="hidden" name="_token" value="" /> -->
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $row['id_batch'] }}" />
                                                                <button type="submit"
                                                                    class="btn btn-primary">Terima</button>
                                                            </form>
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
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Bahan Kemas
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    <!-- Button to trigger modal -->
                                    @if (Auth::user()->level != 2)
                                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm5"
                                            onclick="setdatetoday1(2)">
                                            Tambah Pengujian Bahan Kemas
                                        </button>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalForm5" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Pengujian Bahan Kemas
                                                    </h4>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="card mb-4">
                                                        <div class="card-header" id='headertgl2'></div>
                                                        <div class="card-header">Bahan Kemas</div>
                                                        <div class="card-body">
                                                            <p class="statusMsg"></p>
                                                            <form role="form" method="post"
                                                                action="tambah_pemeriksaanbahankemas" id='forminput2'>
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />
                                                                <div class="card-body">

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-4 col-form-label">Kode
                                                                            Pengujian</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="kode_spesifikasi"
                                                                                class="form-control 2" id="inputEmail3"
                                                                                placeholder="Kode Spesifikasi" />
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" id='ambil_tanggal2'
                                                                        class="form-control 2" name="tanggal"
                                                                        placeholder="" />

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Nama Bahan
                                                                            Kemas</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="nama_bahankemas"
                                                                                class="form-control 2" id="inputEmail3"
                                                                                placeholder="Nama Bahan Kemas" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Jenis Bahan
                                                                            Kemas</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="jenis_bahankemas"
                                                                                class="form-control 2" id="inputEmail3"
                                                                                placeholder="Bahan Kemas" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Warna</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="warna"
                                                                                class="form-control 2" id="inputEmail3"
                                                                                placeholder="Warna" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Ukuran Bahan
                                                                            Kemas</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="ukuran_bahankemas"
                                                                                class="form-control 2" id="inputEmail3"
                                                                                placeholder="Ukuran Bahan Kemas" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Bocor/Cacat</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="bocor_cacat"
                                                                                class="form-control 2" id="inputEmail3"
                                                                                placeholder="Bocor/Cacat" />
                                                                        </div>
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
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Kode Pengujian</th>
                                                <th scope="col">Nama Bahan Kemas</th>
                                                <th scope="col">Jenis Bahan Kemas</th>
                                                <th scope="col">Warna</th>
                                                <th scope="col">Ukuran Bahan Kemas</th>
                                                <th scope="col">Bocot / Cacat</th>
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
                                                    <td>{{ $row['kode_spesifikasi'] }}</td>
                                                    <td>{{ $row['nama_bahankemas'] }}</td>
                                                    <td>{{ $row['jenis_bahankemas'] }}</td>
                                                    <td>{{ $row['warna'] }}</td>
                                                    <td>{{ $row['ukuran'] }}</td>
                                                    <td>{{ $row['bocorcacat'] }}</td>
                                                    <td><?php if ($row['status'] == 0) {
                                                        echo 'Diajukan';
                                                    } ?></td>
                                                    @if (Auth::user()->level != 2)
                                                        <td>
                                                            <form action="#">
                                                                <input type="hidden" name="_token" value="" />
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <form method="post" action="#">
                                                                <input type="hidden" name="_token" value="" />
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button type="submit"
                                                                    class="btn btn-primary">Terima</button>
                                                            </form>
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
                <div class="tab-pane fade" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
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
                                    @if (Auth::user()->level != 2)
                                        <button class="btn btn-success btn-lg" data-toggle="modal"
                                            data-target="#modalForm6" onclick="setdatetoday1(3)">
                                            Tambah Pengujian Produk Jadi
                                        </button>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalForm6" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Pengujian Produk Jadi
                                                    </h4>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="card mb-4">
                                                        <div class="card-header" id='headertgl3'></div>
                                                        <div class="card-header">Produk Jadi</div>
                                                        <div class="card-body">
                                                            <p class="statusMsg"></p>
                                                            <form role="form" method="post"
                                                                action="tambah_pemeriksaanprodukjadi" id='forminput3'>
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="{{ csrf_token() }}" />
                                                                <div class="card-body">

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-4 col-form-label">Kode
                                                                            Pengujian</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="kode_spesifikasi"
                                                                                class="form-control 3" id="inputEmail3"
                                                                                placeholder="Kode Spesifikasi" />
                                                                        </div>
                                                                    </div>

                                                                    <input type="hidden" id='ambil_tanggal3'
                                                                        class="form-control 3" name="tanggal"
                                                                        placeholder="" />

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Nama Produk
                                                                            Jadi</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="nama_produkjadi"
                                                                                class="form-control 3" id="inputEmail3"
                                                                                placeholder="Nama Produk Jadi" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Kategori Produk
                                                                            Jadi</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="kategori"
                                                                                class="form-control 3" id="inputEmail3"
                                                                                placeholder="Kategori Produk
                                                                                                                                                        Jadi" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">No
                                                                            Batch</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="no_batch"
                                                                                class="form-control 3" id="inputEmail3"
                                                                                placeholder="No Batch" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Warna Produk
                                                                            Jadi</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="warna"
                                                                                class="form-control 3" id="inputEmail3"
                                                                                placeholder="Warna Produk Jadi" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Aroma</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="aroma"
                                                                                class="form-control 3" id="inputEmail3"
                                                                                placeholder="Aroma" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="inputEmail3"
                                                                            class="col-sm-3 col-form-label">Kemasan
                                                                            Bocor/Cacat</label>
                                                                        <div class="col-sm">
                                                                            <input type="text" name="bocor_cacat"
                                                                                class="form-control 3" id="inputEmail3"
                                                                                placeholder="Bocor/Cacat" />
                                                                        </div>
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
                                                <th scope="col">Kode Pengujian</th>
                                                <th scope="col">Nama Produk Jadi</th>
                                                <th scope="col">Kategori Produk Jadi</th>
                                                <th scope="col">No Batch</th>
                                                <th scope="col">Warna</th>
                                                <th scope="col">Aroma</th>
                                                <th scope="col">Bocot / Cacat</th>
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
                                                    <td>{{ $row['kode_spesifikasi'] }}</td>
                                                    <td>{{ $row['nama_produkjadi'] }}</td>
                                                    <td>{{ $row['kategori'] }}</td>
                                                    <td>{{ $row['no_batch'] }}</td>
                                                    <td>{{ $row['warna'] }}</td>
                                                    <td>{{ $row['aroma'] }}</td>
                                                    <td>{{ $row['bocorcacat'] }}</td>
                                                    <td><?php if ($row['status'] == 0) {
                                                        echo 'Diajukan';
                                                    } ?></td>
                                                    @if (Auth::user()->level != 2)
                                                        <td>
                                                            <form action="#">
                                                                <input type="hidden" name="_token" value="" />
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button type="submit" class="btn btn-primary">Edit</button>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <form method="post" action="#">
                                                                <input type="hidden" name="_token" value="" />
                                                                <input type="hidden" name="nobatch" value="" />
                                                                <button type="submit"
                                                                    class="btn btn-primary">Terima</button>
                                                            </form>
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
    </main>
@endsection
