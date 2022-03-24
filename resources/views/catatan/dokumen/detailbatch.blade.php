@extends('layout.app')
@section('title')
<title>Pembersihan Ruangan</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengolahan Batch</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengolahan Batch</li>
        </ol>
        <div class="row">
            @foreach ($data as $row)
            <?php $nobatch = $row['nomor_batch']; 
            $status = $row['status'];?>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bagian Produksi
                </div>

                <div class="card-body">


                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Sesuai Dengan POB No</label>
                        <div class="col-sm-10">
                            <p class="form-control"> {{ $row['pob'] }} </p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Produk
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Produk</label>
                        <div class="col-sm-10">
                            <p class="form-control"> {{ $row['kode_produk'] }} </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <p class="form-control"> {{ $row['nama_produk'] }} </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Batch</label>
                        <div class="col-sm-10">
                            <p class="form-control"> {{ $row['nomor_batch'] }} </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Besar Batch</label>
                        <div class="col-sm-10">
                            <p class="form-control"> {{ $row['besar_batch'] }} </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Bentuk Sediaan</label>
                        <div class="col-sm-10">
                            <p class="form-control"> {{ $row['bentuk_sedia'] }} </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Kemasan</label>
                        <div class="col-sm-10">
                            <p class="form-control"> {{ $row['kemasan'] }} </p>
                        </div>
                    </div>



                </div>

            </div>
            @endforeach

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Komposisi
                </div>
                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    <button  class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm" <?php if($status>0) {echo 'disabled';} ?>>
                        Tambah Komposisi
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Entry Kopmosisi
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form action="/input_komposisi" method="post" role="form">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="nobatch" value="{{ $row['nomor_batch'] }}" />
                                        <div class="form-group">
                                            <label for="inputName">Nama BB</label>
                                            <input type="text" name="id" class="form-control" id="inputName" placeholder="Nama BB" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Kode BB</label>
                                            <input type="text" name="nama" class="form-control" id="inputName" placeholder="Kode BB" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMessage">Persentase</label>
                                            <input type="text" name="persen" class="form-control" id="inputName" placeholder="Persentase" />
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary submitBtn" onclick="submitContactForm()">
                                                Tambah
                                            </button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama BB</th>
                                <th scope="col">Kode BB</th>
                                <th scope="col">Persentase (%)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($list_kom as $row)
                            <?php $i++;
                            ?>
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $row['kompisisi_nama'] }}</td>
                                <td>{{ $row['komposisi_id'] }}</td>
                                <td>{{ $row['komposisi_persen'] }}</td>
                                <td>
                                    <a href="/hapus_komposisi/{{ $row['komposisi_id'] }}/{{ $id }}" type="button" class="btn btn-danger" onclick="return confirm('Hapus? ')">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Peralatan
                </div>
                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm1" <?php if($status>0) {echo 'disabled';} ?>>
                        Tambah Peralatan
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Entry Peralatan
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form action="/input_peralatan" method="post" role="form">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="nobatch" value="{{ $row['nomor_batch'] }}" />
                                        <div class="form-group">
                                            <label for="inputName">Nama Alat</label>
                                            <input name="nama" type="text" class="form-control" id="inputName" placeholder="Nama Alat" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Kode Alat</label>
                                            <input name="kode" type="text" class="form-control" id="inputName" placeholder="Kode Alat" />
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary submitBtn" onclick="submitContactForm()">
                                                Tambah
                                            </button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Alat</th>
                                <th scope="col">Kode Alat</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($list_alat as $row)
                            <?php $i++;
                            ?>
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $row['peralatan_nama'] }}</td>
                                <td>{{ $row['peralatan_id'] }}</td>
                                <td>
                                    <a href="/hapus_peralatan/{{ $row['peralatan_id'] }}" type="button" class="btn btn-danger" onclick="return confirm('Hapus? ')">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Penimbangan
                </div>
                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm2" <?php if($status>0) {echo 'disabled';} ?>>
                        Data Penimbangan
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm2" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Entry Penimbangan
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form action="/input_penimbangan" method="post" role="form">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="nobatch" value="{{ $row['nomor_batch'] }}" />
                                        <div class="form-group">
                                            <label for="inputName">Kode Bahan</label>
                                            <input type="text" name="kode_bahan" class="form-control" id="inputName" placeholder="Kode Bahan" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Nama Bahan</label>
                                            <input type="text" name="nama_bahan" class="form-control" id="inputName" placeholder="Nama Bahan" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Nomor Loth</label>
                                            <input type="text" name="no_loth" class="form-control" id="inputName" placeholder="Nomor Loth" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Jumlah yang Dibutuhkan</label>
                                            <input type="text" name="jumlah_butuh" class="form-control" id="inputName" placeholder="Jumlah yang Dibutuhkan" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Jumlah yang Ditimbang</label>
                                            <input type="text" name="jumlah_timbang" class="form-control" id="inputName" placeholder="Jumlah yang Ditimbang" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Ditimbang Oleh</label>
                                            <input type="text" name="ditimbang" class="form-control" id="inputName" placeholder="Ditimbang Oleh" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Diperiksa Oleh</label>
                                            <input type="text" name="diperiksa" class="form-control" id="inputName" placeholder="Diperiksa Oleh" />
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary submitBtn" onclick="submitContactForm()">
                                                Tambah
                                            </button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Bahan</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Nomor Loth</th>
                                <th scope="col">Jml Dibutuhkan</th>
                                <th scope="col">Jml Ditimbang</th>
                                <th scope="col">Ditimbang Oleh</th>
                                <th scope="col">Diperiksa Oleh</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($list_nimbang as $row)
                            <?php $i++;
                            ?>
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $row['penimbangan_kodebahan'] }}</td>
                                <td>{{ $row['penimbangan_namabahan'] }}</td>
                                <td>{{ $row['penimbangan_loth'] }}</td>
                                <td>{{ $row['penimbangan_jumlahbutuh'] }}</td>
                                <td>{{ $row['penimbangan_jumlahtimbang'] }}</td>
                                <td>{{ $row['penimbangan_timbangoleh'] }}</td>
                                <td>{{ $row['penimbangan_periksaoleh'] }}</td>
                                <td>
                                    <a href="hapus_penimbangan/{{ $row['penimbangan_id'] }}" type="button" class="btn btn-danger" onclick="return confirm('Hapus? ')">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Produk

                    <div class="dropdown float-right">
                        <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown button
                        </button>
                        <div class="dropdown-menu">
                            <li><a class="nav-link active bg-white text-dark" href="#tab-0" data-toggle="tab">Padat</a>
                            </li>
                            <li><a class="nav-link bg-white text-dark" href="#tab-1" data-toggle="tab">Cair</a></li>
                            <li><a class="nav-link bg-white text-dark" href="#tab-2" data-toggle="tab">kental</a></li>
                            <li><a class="nav-link bg-white text-dark" href="#tab-3" data-toggle="tab">Bubuk</a></li>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                            <div class="panel blank-panel">

                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-0">
                                            <b>tab-0</b>
                                        </div>
                                        <div class="tab-pane" id="tab-1">
                                            <b>tab-1</b>
                                        </div>
                                        <div class="tab-pane" id="tab-2">
                                            <b>tab-2</b>
                                        </div>
                                        <div class="tab-pane " id="tab-3">
                                            <div class="wrapper wrapper-content animated fadeInRight">
                                                <b>tab-3</b>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <center>
                        <form action="/ajukan_batch/{{$nobatch}}">
                        <button type="submit" class="btn btn-success btn-lg mt-5" <?php if($status>0) {echo 'disabled';} ?>>
                            Ajukan
                        </button>
                        </form>
                    </center>
                    <!-- <table class="table">
                            <tr>
                                <th scope="col">Tahap Pengolahan</th>
                                <th scope="col">Paraf Bagian Pengawasa Mutu</th>
                            </tr>
                        </table>

                        <form>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-8 col-form-label">Bahan yang sudah dikirim dari gudang bahan baku akan
                                    ditimbang terlebih dahulu</label>
                                <div class="col-sm-10">
                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option selected>Choose...</option>
                                        <option value="1">Tari</option>
                                        <option value="2">Dira</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-8 col-form-label">Bahan yang sudah ditimbang, ditimang diruang
                                    mixing</label>
                                <div class="col-sm-10">
                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option selected>Choose...</option>
                                        <option value="1">Tari</option>
                                        <option value="2">Dira</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-8 col-form-label">Setelah Selesai, Proses mixing akan dikarantina
                                    terlebih dahulu</label>
                                <div class="col-sm-10">
                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option selected>Choose...</option>
                                        <option value="1">Tari</option>
                                        <option value="2">Dira</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-8 col-form-label">Setelah dinyatakan lulus, baru kemudian dibawa keruang
                                    filling untuk dilakukan pengemasan</label>
                                <div class="col-sm-10">
                                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option selected>Choose...</option>
                                        <option value="1">Tari</option>
                                        <option value="2">Dira</option>
                                    </select>
                                </div>
                            </div>
                        </form> -->
                </div>
            </div>
        </div>
    </div>
</main>
@endsection