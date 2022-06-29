@extends('layout.app')
@section('title')
<title>Pendistribusian Produk</title>
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1>Catatan Pendistribusian Produk</h1>
        <ol class="breadcrumb mb-4">Pendistribusian Produk</li>
        </ol>
        <div class="row">

            <div class="card mb-4">
                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if (Auth::user()->level != 2)
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm" onclick="setdatetoday()">
                        Tambah Pendistribusian Produk
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Entry Pendistribusian Produk
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form method="post" action="tambah_distribusi" id='forminput'>
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-table me-1"></i>
                                                Distribusi
                                            </div>
                                            <div class="card-header" id='headertgl'></div>
                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="card-body">

                                            <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                        Dengan PROTAP No</label>
                                    <div class="col-sm">
                                        {{-- <input type="text" name="protap" class="form-control 17" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                        <select name="protap" class="form-control">
                                            @foreach ($protap as $isi)
                                            <option value="{{$isi['protap_id']}}">{{$isi['protap_nama']}}</option>
                                            @endforeach

                                        </select>
                                        <div id="error-box" style="color: red"></div>
                                    </div>
                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Kode
                                                        Pendistribusian</label>
                                                    <div class="col-sm">
                                                        <input type="text" name="kode_distribusi" class="form-control" id="inputEmail3" placeholder="Kode Pendistribusian" />
                                                    </div>
                                                </div>

                                                <input type="hidden" id='ambil_tanggal' class="form-control" name="tanggal" placeholder="" />

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                                        Batch</label>
                                                    <div class="col-sm">
                                                        <input type="text" name="no_batch" class="form-control" id="inputEmail3" placeholder="No Batch" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
                                                    <div class="col-sm">

                                                        <div class="row">
                                                            <div class="col-sm-8" data-tip="Hanya angka saja">
                                                                <input type="number" name="jumlah" class="form-control" id="inputEmail3" placeholder="Jumlah" />
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <select class="form-select" name="satuan" id="satuuan">
                                                                    <option value="gr"> gr</option>
                                                                    <option value="kg"> kg</option>
                                                                    <option value="ml"> ml</option>
                                                                    <option value="L"> L</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                        Distributor</label>
                                                    <div class="col-sm">
                                                        <input type="text" name="nama_distributor" class="form-control" id="inputEmail3" placeholder="Nama Distributor" />
                                                    </div>
                                                </div>

                                            </div>
                                            <a class="btn btn-primary" onclick="salert()" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->

                </div>

                <table class="table mt-5" id="tabel1">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Sesuai PROTAP</th>
                            <th scope="col">Kode Distribusi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">No Batch</th>
                            <th scope="col">Jumlah Produk</th>
                            <th scope="col">Nama Distributor</th>
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
                            <td>{{ $row['kode_distribusi'] }}</td>
                            <td>{{ $row['tanggal'] }}</td>
                            <td>{{ $row['id_batch'] }}</td>
                            <td>{{ $row['jumlah'] }}</td>
                            <td>{{ $row['nama_distributor'] }}</td>
                            <td>
                                <?php if ($row['status'] == 0) {
                                    echo 'Diajukan';
                                } elseif ($row['status'] == 1) {
                                    echo 'Diterima';
                                } ?>
                            </td>
                            <td>
                                @if (Auth::user()->level == 2)
                                <?php if ($row['status'] == 0) { ?>
                                    <form method="post" action="terimadistribusiproduk" id="terimalaporan{{ $row['id_distribusi'] }}">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{ $row['id_distribusi'] }}" />
                                        <button type="button" onclick="TerimaLaporan({{ $row['id_distribusi'] }})" class="btn btn-primary">terima</button>
                                    </form>
                                <?php } elseif ($row['status'] == 1) { ?>
                                    <form method="post" action="terimadistribusiproduk">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{ $row['id_distribusi'] }}" />
                                        <button type="submit" class="btn btn-danger disabled">terima</button>
                                    </form>
                                <?php } ?>

                                @else
                                <?php if ($row['status'] == 0) { ?>
                                    <button id="klikdis" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#edit_distribusi" data-protap="{{ $row['protap_id'] }}" data-kode="{{ $row['kode_distribusi'] }}" data-nobatch="{{ $row['id_batch'] }}" 
                                    data-jumlah="{{ preg_replace('/[^0-9]/', '', $row['jumlah']) }}" 
                                    data-satuan="{{ preg_replace('/[^a-zA-Z]+/', '', $row['jumlah']) }}" 
                                    data-nama="{{ $row['nama_distributor'] }}" data-id="{{ $row['id_distribusi'] }}">edit</button>
                                <?php } elseif ($row['status'] == 1) { ?>
                                    <button id="klikdis" type="submit" class="btn btn-danger disabled" data-toggle="modal" data-target="#edit_distribusi" data-kode="{{ $row['kode_distribusi'] }}" data-nobatch="{{ $row['id_batch'] }}" data-jumlah="{{ $row['jumlah'] }}" data-nama="{{ $row['nama_distributor'] }}" data-id="{{ $row['id_distribusi'] }}">edit</button>
                                <?php } ?>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="edit_distribusi" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Entry Pendistribusian Produk
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form method="post" action="edit_distribusi" id='forminput1'>
                        <input type="hidden" name="id" id="isi_id">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Distribusi
                            </div>
                            <div class="card-header" id='headertgl'></div>
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                        Dengan PROTAP No</label>
                                    <div class="col-sm">
                                        {{-- <input type="text" name="protap" class="form-control 17" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                        <select name="protap" class="form-control 1" id="protap">
                                            @foreach ($protap as $isi)
                                            <option value="{{$isi['protap_id']}}">{{$isi['protap_nama']}}</option>
                                            @endforeach

                                        </select>
                                        <div id="error-box" style="color: red"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Kode
                                        Pendistribusian</label>
                                    <div class="col-sm">
                                        <input type="text" name="kode_distribusi" class="form-control 1" id="isi_kode" placeholder="Kode Pendistribusian" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="no_batch" class="form-control 1" id="isi_nobatch" placeholder="No Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col-sm">

                                        <div class="row">
                                            <div class="col-sm-8" data-tip="Hanya angka saja">
                                                <input type="number" name="jumlah" class="form-control 1" id="isi_jumlah" placeholder="Jumlah" />
                                            </div>
                                            <div class="col-sm-4">
                                                <select class="form-select" name="satuan" id="satuan">
                                                    <option value="gr"> gr</option>
                                                    <option value="kg"> kg</option>
                                                    <option value="ml"> ml</option>
                                                    <option value="L"> L</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                        Distributor</label>
                                    <div class="col-sm">
                                        <input type="text" name="nama_distributor" class="form-control 1" id="isi_nama" placeholder="Nama Distributor" />
                                    </div>
                                </div>

                            </div>
                            <a class="btn btn-primary" onclick="salert1(1)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
</main>
<script>
    $(document).on('click', "#klikdis", function() {
        var nama = $(this).data('nama');
        var kode = $(this).data('kode');
        var nobatch = $(this).data('nobatch');
        var jumlah = $(this).data('jumlah');
        var id = $(this).data('id');
        var protap = $(this).data('protap');
        var satuan = $(this).data('satuan');

        $("#protap").val(protap);
        $("#satuan").val(satuan);
        $("#isi_nobatch").val(nobatch);
        $("#isi_jumlah").val(jumlah);
        $("#isi_kode").val(kode);
        $("#isi_nama").val(nama);
        $("#isi_id").val(id);
        // document.getElementById('cpbahan').value = cpid;
    })
</script>
@endsection