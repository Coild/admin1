@extends('layout.app')
@section('title')
    <title>Pengolahan Batch</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Pengolahan Batch</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Pengolahan Batch</li>
            </ol>
            <div class="row">
                    <?php $nobatch = $data['nomor_batch'];
                    // $status = $data['status'];
                    $awal = 0;
                    $akhir = 0; ?>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Bagian Produksi
                        </div>

                        <div class="card-body">


                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Sesuai Dengan Protap Nomor</label>
                                <div class="col-sm-10">
                                    <p class="form-control"> {{ $data['pob'] }} </p>
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
                                    <p class="form-control"> {{ $data['kode_produk'] }} </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-sm-10">
                                    <p class="form-control"> {{ $data['nama_produk'] }} </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Batch</label>
                                <div class="col-sm-10">
                                    <p class="form-control"> {{ $data['nomor_batch'] }} </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Besar Batch</label>
                                <div class="col-sm-10">
                                    <p class="form-control"> {{ $data['besar_batch'] }} </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Bentuk Sediaan</label>
                                <div class="col-sm-10">
                                    <p class="form-control"> {{ $data['bentuk_sedia'] }} </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Kemasan</label>
                                <div class="col-sm-10">
                                    <p class="form-control"> {{ $data['kemasan'] }} </p>
                                </div>
                            </div>



                        </div>

                    </div>

                <!-- pop up end -->


            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Komposisi
            </div>
            <div class="card-body">
                <!-- pop up -->
                <!-- Button to trigger modal -->
                @if (Auth::user()->level != 2)
                    @if($status == 1)
                        <button class="btn btn-success btn-lg disabled" data-toggle="modal" data-target="#modalForm">
                            Tambah Komposisi
                        </button>
                    @else
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                            Tambah Komposisi
                        </button>
                    @endif

                @endif

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
                                <form action="/input_komposisi" method="post" role="form" id ="forminput1">
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="nobatch" value="{{ $nobatch }}" />
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm">Nama BB</label>
                                        <div class="col-sm">

                                        <input type="text" name="nama" class="form-control 1" id="inputName"
                                            placeholder="Nama BB" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm">Kode BB</label>
                                        <div class="col-sm">
                                        <input type="text" name="id" class="form-control 1" id="inputName"
                                            placeholder="Kode BB" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMessage" class="col-sm">Persentase</label>
                                        <div class="col-sm" data-tip="Hanya angka saja">
                                            <input type="number" name="persen" class="form-control 1" id="inputName"
                                            placeholder="Persentase" />
                                        </div>

                                    </div>
                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="button" class="btn btn-primary submitBtn"
                                            onclick="salert1(1)">
                                            Tambah
                                        </button>
                                    </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- pop up end -->

                <table class="table" id="tabel1">
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
                                <td>{{ $row['komposisi_kode'] }}</td>
                                <td>{{ $row['komposisi_persen'] }}</td>
                                <td>
                                    @if (Auth::user()->level != 2)
                                        <a href="/hapus_komposisi/{{ $row['komposisi_id'] }}" type="button"
                                        class="btn btn-danger @if($status != 0) disabled @endif" onclick="return confirm('Hapus? ')">Hapus</a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Peralatan
                </div>
                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if (Auth::user()->level != 2)
                        <button class="btn btn-success btn-lg @if($status != 0) disabled @endif" data-toggle="modal" data-target="#modalForm1">Tambah Peralatan
                        </button>
                    @endif

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
                                    <form action="/input_peralatan" method="post" role="form" id="forminput2">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="nobatch" value="{{ $nobatch }}" />
                                        <div class="form-group">
                                            <label for="inputName">Nama Alat</label>
                                            <input name="nama" type="text" class="form-control 2" id="inputName"
                                                placeholder="Nama Alat" />
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Kode Alat</label>
                                            <input name="kode" type="text" class="form-control 2" id="inputName"
                                                placeholder="Kode Alat" />
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn btn-primary submitBtn"
                                                onclick="salert1(2)">
                                                Tambah
                                            </button>
                                        </div>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->

                    <table class="table" id="tabel2">
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
                                    <td>{{ $row['peralatan_kode'] }}</td>
                                    <td>
                                        @if (Auth::user()->level != 2)
                                            <a href="/hapus_peralatan/{{ $row['peralatan_id'] }}" type="button"
                                            class="btn btn-danger @if($status != 0) disabled @endif" onclick="return confirm('Hapus? ')">Hapus</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Penimbangan
                    </div>
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg @if($status != 0) disabled @endif" data-toggle="modal" data-target="#modalForm2">Data Penimbangan
                            </button>
                        @endif
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
                                        <form action="/input_penimbangan" method="post" role="form" id="forminput3">
                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="hidden" name="nobatch" value="{{ $nobatch }}" />
                                            <div class="form-group">
                                                <label for="inputName">Kode Bahan</label>
                                                <input type="text" name="kode_bahan" class="form-control 3" id="inputName"
                                                    placeholder="Kode Bahan" />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Nama Bahan</label>
                                                <input type="text" name="nama_bahan" class="form-control 3" id="inputName"
                                                    placeholder="Nama Bahan" />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Nomor Loth</label>
                                                <input type="text" name="no_loth" class="form-control 3" id="inputName"
                                                    placeholder="Nomor Loth" />
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Jumlah yang Dibutuhkan</label>
                                                <div data-tip="Hanya angka saja">
                                                <input type="number" name="jumlah_butuh" class="form-control 3"
                                                    id="inputName" placeholder="Jumlah yang Dibutuhkan" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="inputEmail">Jumlah yang Ditimbang</label>
                                                <div data-tip="Hanya angka saja">
                                                <input type="number" name="jumlah_timbang" class="form-control 3"
                                                    id="inputName" placeholder="Jumlah yang Ditimbang" />
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="inputEmail">Ditimbang Oleh</label>
                                                <input type="text" name="ditimbang" class="form-control 3" id="inputName"
                                                    placeholder="Ditimbang Oleh" />
                                            </div>

                                            <div class="form-group">
                                                <label for="inputEmail">Diperiksa Oleh</label>
                                                <input type="text" name="diperiksa" class="form-control 3" id="inputName"
                                                    placeholder="Diperiksa Oleh" />
                                            </div>
                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary submitBtn"
                                                    onclick="salert1(3)">
                                                    Tambah
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- pop up end -->

                        <table class="table" id="tabel3">
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
                                            @if (Auth::user()->level != 2)
                                                <a href="hapus_penimbangan/{{ $row['penimbangan_id'] }}" type="button"class="btn btn-danger @if($status != 0) disabled @endif" onclick="return confirm('Hapus? ')">Hapus</a>
                                            @endif
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
                        Pegolahan
                    </div>
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg @if($status != 0) disabled @endif" data-toggle="modal" data-target="#modalForm3">Perlakuan
                            </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="modalForm3" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Masukan keterangan
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form action="/input_olah" method="post" role="form" id="forminput5">
                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="hidden" name="nobatch" value="{{ $nobatch }}" />
                                            <div class="form-group">
                                                <label for="inputName">Isi</label>
                                                <input type="text" name="isi" class="form-control 5" id="inputName"
                                                    placeholder="keterangan" />
                                            </div>

                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary submitBtn"
                                                    onclick="salert1(5)">
                                                    Tambah
                                                </button>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <!-- pop up end -->

                        <table class="table" id="tabel4">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Pengolahan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($list_olah as $row)
                                    <?php $i++;
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $row['isi'] }}</td>
                                        <td>
                                            @if (Auth::user()->level != 2)
                                                <a href="/hapus_olah/{{ $row['produksi_id'] }}" type="button"
                                                class="btn btn-danger @if($status != 0) disabled @endif" onclick="return confirm('Hapus? ')">Hapus</a>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <?php foreach ($rekon as $row) {
                        $awal = $row['awal'];
                        $akhir = $row['akhir'];
                    } ?>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Rekonsiliasi hasil

                        </div>
                        <div class="card-body">

                            <form action="/input_rekonsiliasi" method="post" role="form" id="forminput6">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="nobatch" value="{{ $nobatch }}" />
                                <div class="form-group">
                                    <label for="inputName">Perkiraan</label>
                                    <input type="text" name="awal" value="{{ $awal }}" class="form-control  6"
                                        id="inputName" placeholder="keterangan" />
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Hasil</label>
                                    <input type="text" name="akhir" value="{{ $akhir }}" class="form-control 6"
                                        id="inputName" placeholder="keterangan" />
                                </div>
                                @if (Auth::user()->level != 2)
                                    <center>
                                        <button type="button" onclick="salert1(6)" class="btn btn-success btn-lg" <?php if ($status > 0) {
                                            echo 'disabled';
                                        } ?>> Simpan
                                        </button>
                                    </center>
                                @endif

                            </form>
                            {{-- @if (Auth::user()->level == 2)
                                <center>
                                    <form action="/pjt_pengolahanbatch" method="post" id="terimalaporan{{ $id }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button onclick="TerimaLaporan({{ $id }})" type="button" class="btn btn-primary btn-lg">
                                            Terima
                                        </button>
                                    </form>
                                </center>
                            @endif --}}

                        </div>
                    </div>


                </div>
            </div>
    </main>
@endsection
