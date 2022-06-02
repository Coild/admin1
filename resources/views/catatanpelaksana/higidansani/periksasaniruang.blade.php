@extends('layout.app')
@section('title')
    <title>Periksa Ruang</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Ruangan </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Catatan Pembersihan Ruangan</li>
            </ol>
            <div class="row">
                <!-- Entry Data -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Pembersihan Alat pada Ruangan
                    </div>
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                            Tambah Catatan Kebersihan Ruangan
                        </button>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Entry Data</h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <div class="card">
                                            {{-- <div class="card-header" id='headertgl1'></div> --}}
                                            <div class="card-body">
                                                <p class="statusMsg"></p>
                                                <form role="form" action="tambah_periksaruang" method="post" id='forminput1'>
                                                    @csrf
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <div class="card-body">
                                                        <input type="hidden" id="ambil_tanggal">
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">No. Prosedur</label>
                                                            <div class="col-sm">
                                                                
                                                                <select class="form-control 1"
                                                                    name="nomer_prosedur" id="nomer_prosedur1">
                                                                    @foreach ($data2 as $row)
                                                                        <option value="{{ $row['protap_id'] }}">
                                                                            {{ $row['protap_nama'] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Ruangan</label>
                                                            <div class="col-sm">
                                                                <input class="form-control 1" type='text' placeholder="Ruangan" name="nama_ruangan" id="nama_ruangan">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal</label>
                                                            <div class="col-sm">
                                                                <input type="date" name="tanggal_prosedur" class="form-control 1 " id="tanggal_prosedur">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Cara Pembersihan</label>
                                                            <div class="col-sm">
                                                                <input type='text' class="form-control 1"
                                                                placeholder="Cara pembersihan" name="cara_pembersihan"
                                                                id="cara_pembersihan"/>
                                                            </div>
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

                    </div>
                    <table class="table display nowrap hide" style="width:100%" id="tabel1">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No. Prosedur</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Cara pembersihan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data as $row)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row['protap_nama'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row['tanggal_prosedur'])->format('j F, Y') }}</td>
                                    <td>{{ $row['nama_ruangan'] }}</td>
                                    <td>{{ $row['cara_pembersihan'] }}</td>
                                    <td>
                                        @if ($row['status'] == 0)
                                            Diajukan
                                        @else
                                            Diterima
                                        @endif
                                    </td>
                                    <td>


                                        @if (Auth::user()->level != 2)
                                            <?php if ($row['status'] == 0) { ?>
                                            <form method="post" action="detilruangan" class="float-left mr-2">
                                                @csrf
                                                <input type="hidden" name="id_ruangan"
                                                    value="{{ $row['id_periksaruang'] }}" />
                                                <input type="hidden" name="nama_ruangan"
                                                    value="{{ $row['nama_ruangan'] }}" />
                                                <input type="hidden" name="pelaksana" value="{{ $row->user_id }}" />
                                                <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                <button type="submit" class="btn btn-success"> Lihat</button>
                                            </form>
                                            <a href="#" type="button" data-toggle="modal" data-target="#modalForm"
                                                class="btn btn-primary" onclick="editdata({{ $row }})">Edit</a>
                                            <?php } elseif ($row['status'] == 1) { ?>
                                            <form method="post" action="detilruangan" class="float-left mr-2">
                                                @csrf
                                                <input type="hidden" name="id_ruangan"
                                                    value="{{ $row['id_periksaruang'] }}" />
                                                <input type="hidden" name="nama_ruangan"
                                                    value="{{ $row['nama_ruangan'] }}" />
                                                <input type="hidden" name="pelaksana" value="{{ $row->user_id }}" />
                                                <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                <button type="submit" class="btn btn-success"> Lihat</button>
                                            </form>
                                            <a href="#" type="submit" data-toggle="modal" data-target="#modalForm"
                                                class="btn btn-danger disabled"
                                                onclick="editdata({{ $row }})">Edit</a>
                                            <?php } ?>
                                        @else
                                            <?php if ($row['status'] == 0) { ?>
                                            <form method="post" action="detilruangan" class="float-left mr-2">
                                                @csrf
                                                <input type="hidden" name="id_ruangan"
                                                    value="{{ $row['id_periksaruang'] }}" />
                                                <input type="hidden" name="nama_ruangan"
                                                    value="{{ $row['nama_ruangan'] }}" />
                                                <input type="hidden" name="pelaksana" value="{{ $row->user_id }}" />
                                                <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                <button type="submit" class="btn btn-success"> Lihat</button>
                                            </form>
                                            <form method="post" action="terimaperiksaruang" id="formTerimaLaporan{{ $row['id_periksaruang'] }}">
                                                @csrf
                                                <input type="hidden" name="id"
                                                    value="{{ $row['id_periksaruang'] }}" />
                                                <button type="button" onclick="buttonTerimaLaporan({{ $row['id_periksaruang'] }})" class="btn btn-primary">Terima</button>
                                            </form>
                                            <?php } elseif ($row['status'] == 1) { ?>
                                            <form method="post" action="detilruangan" class="float-left mr-2">
                                                @csrf
                                                <input type="hidden" name="id_ruangan"
                                                    value="{{ $row['id_periksaruang'] }}" />
                                                <input type="hidden" name="nama_ruangan"
                                                    value="{{ $row['nama_ruangan'] }}" />
                                                <input type="hidden" name="pelaksana" value="{{ $row->user_id }}" />
                                                <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                <button type="submit" class="btn btn-success"> Lihat</button>
                                            </form>
                                            <form method="post" action="terimapenarikanproduk">
                                                @csrf
                                                <input type="hidden" name="id"
                                                    value="{{ $row['id_produk_penarikan'] }}" />
                                                <button type="submit" class="btn btn-danger disabled">Terima</button>
                                            </form>
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

        <script>
            function editdata(params) {
                // console.log(params)
                $("#forminput1").attr("action", "edit_periksaruang");
                    var inputid = '<input type="hidden" name="id" class ="form-control" value="' + params.id_periksaruang + '"/>'
                    $(inputid).insertAfter("#ambil_tanggal")
                    // $("#id").val(params.id_periksaruang)
                    
                    const formatYmd = new Date(params.tanggal_prosedur).toISOString().slice(0, 10);
                    $("#nomer_prosedur1").val(params.nomer_prosedur)
                    $("#nama_ruangan").val(params.nama_ruangan)
                    $("#tanggal_prosedur").val(formatYmd)
                    $("#cara_pembersihan").val(params.cara_pembersihan)
            }
        </script>
    </main>
@endsection
