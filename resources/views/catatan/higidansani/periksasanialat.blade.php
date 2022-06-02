@extends('layout.app')
@section('title')
    <title>Periksa Pembersihan Alat</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Peralatan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Catatan Pembersihan Peralatan</li>
            </ol>
            <div class="row">
                <!-- Entry Data -->
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        <!-- Modal -->

                        <!-- pop up end -->
                        <div class="table-responsive-lg">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Pembersihan Alat
                            </div>
                            @if (Auth::user()->level != 2)
                                <button class="btn btn-success btn-lg mt-3" data-toggle="modal" data-target="#modalForm">
                                    Tambah Pembersihan Alat
                                </button>
                            @endif

                            <!-- Modal -->
                            <div class="modal fade" id="modalForm" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">
                                                Entry Data
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="tambah_periksaalat" method="post" id="forminput1">
                                                <div class="card-header" id='headertglx'></div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        @csrf
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <input type="hidden" id='ambil_tanggalx' />
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">PROTAP
                                                            Nomor</label>
                                                        <div class="col-sm">
                                                            <select style="height: 35px;" class="form-control 1"
                                                                name="pob_nomor" id="pob_nomor">
                                                                @foreach ($data2 as $row)
                                                                    <option value="{{ $row['protap_id'] }}">
                                                                        {{ $row['protap_nama'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                            Ruangan</label>
                                                        <div class="col-sm">
                                                            <select style="height: 35px;" class="form-control 1"
                                                                name="nama_ruangan" id="nama_ruangan">
                                                                @foreach ($data1 as $row)
                                                                    <option value="{{ $row['nama_ruangan'] }}">
                                                                        {{ $row['nama_ruangan'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                            Alat</label>
                                                        <div class="col-sm">
                                                            <input placeholder="Nama Alat" class="form-control 1" name="nama_alat" type="text" id="nama_alat" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Type
                                                            Merk</label>
                                                        <div class="col-sm">
                                                            <input placeholder="Bagian Alat" class="form-control 1"
                                                                name="type_merk" id="type_merk" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 d-flex justify-content-center">
                                                        <a class="btn btn-primary" onclick="salert1(1)" href="#"
                                                            style="float:left;  margin-left:25px" role="button">Simpan</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table mt-3" id="tabel1">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">PROTAP Nomor</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Ruangan</th>
                                        <th scope="col">Nama Alat</th>
                                        <th scope="col">Type Merk</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($data as $row)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $row['protap_nama'] }}</td>
                                            <td>{{ $row['tanggal'] }}</td>
                                            <td>{{ $row['nama_ruangan'] }}</td>
                                            <td>{{ $row['nama_alat'] }}</td>
                                            <td>{{ $row['type_merk'] }}</td>
                                            <td>
                                                @if ($row['status'] == 0)
                                                    Diajukan
                                                @else
                                                    Diterima
                                                @endif
                                            </td>
                                            @if (Auth::user()->level != 2)
                                                <td>
                                                    <?php if ($row['status'] == 0) { ?>
                                                    <form method="post" action="detilalat" class="float-left mr-2">
                                                        @csrf
                                                        <input type="hidden" name="id_alat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <input type="hidden" name="nama_ruangan"
                                                            value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                        <button type="submit" class="btn btn-success">Lihat</button>
                                                    </form>
                                                    <a href="#" type="button" data-toggle="modal" data-target="#modalForm"
                                                        class="btn btn-primary"
                                                        onclick="editdata({{ $row }})">Edit</a>
                                                    <?php } elseif ($row['status'] == 1) { ?>
                                                    <form method="post" action="detilalat" class="float-left mr-2">
                                                        @csrf
                                                        <input type="hidden" name="id_alat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <input type="hidden" name="nama_ruangan"
                                                            value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                        <button type="submit" class="btn btn-success">Lihat</button>
                                                    </form>

                                                    <form method="post" action="detilalat" class="float-left mr-2">
                                                        @csrf
                                                        <input type="hidden" name="id_alat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <input type="hidden" name="nama_ruangan"
                                                            value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                        <button type="button" class="btn btn-danger disabled">Edit</button>
                                                    </form>
                                                    <?php } ?>
                                                </td>
                                            @else
                                                <td>
                                                    <?php if ($row['status'] == 0) { ?>
                                                    <form method="post" action="detilalat" class="float-left mr-2">
                                                        @csrf
                                                        <input type="hidden" name="id_alat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <input type="hidden" name="nama_ruangan"
                                                            value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                        
                                                        <button type="submit" class="btn btn-success">Lihat</button>
                                                    </form>
                                                    <form method="post" action="terima_periksaalat"
                                                        id="formTerimaLaporan{{ $row['id_periksaalat'] }}">
                                                        @csrf
                                                        <input type="hidden" name="id_periksaalat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <button type="button"
                                                            onclick="buttonTerimaLaporan({{ $row['id_periksaalat'] }})"
                                                            class="btn btn-primary">Terima</button>
                                                    </form>

                                                    <?php } elseif ($row['status'] == 1) { ?>
                                                    <form method="post" action="detilalat" class="float-left mr-2">
                                                        @csrf
                                                        <input type="hidden" name="id_alat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <input type="hidden" name="nama_ruangan"
                                                            value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="status" value="{{ $row['status'] }}" />
                                                        <button type="submit" class="btn btn-success"> Lihat</button>
                                                    </form>
                                                    <form method="post" action="terimapemusnahanprodukjadi">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <button type="submit"
                                                            class="btn btn-danger disabled">Terima</button>
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

                <script>
                    function editdata(params) {
                        $("#forminput1").attr("action", "edit_periksaalat");
                        var inputid = '<input type="hidden" name="id" class ="form-control " value="' + params
                            .id_periksaalat + '"/>'
                        $(inputid).insertAfter("#ambil_tanggalx")
                        // console.log(params);
                        $("#pob_nomor").val(params.pob_nomor)
                        $("#nama_ruangan").val(params.nama_ruangan)
                        $("#nama_alat").val(params.nama_alat)
                        $("#type_merk").val(params.type_merk)
                    }
                </script>
    </main>
@endsection
