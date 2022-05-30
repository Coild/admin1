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
                                                Tambah Pembersihan Alat
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="tambah_periksaalat" method="post" id="forminput">
                                                <div class="card-header" id='headertglx'></div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        @csrf
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        {{-- <input type="hidden" name="tanggal" id='ambil_tanggalx'
                                                            class="form-control" placeholder="" /> --}}
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">PROTAP
                                                            Nomor</label>
                                                        <div class="col-sm">
                                                            <select style="height: 35px;" class="form-control"
                                                                name="pob_nomor" id="nama_ruangan">
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
                                                            <select style="height: 35px;" class="form-control"
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
                                                            <input placeholder="Nama Alat" class="form-control"
                                                                name="nama_alat" type="text" id="nama_alat" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Type
                                                            Merk</label>
                                                        <div class="col-sm">
                                                            <input placeholder="Bagian Alat" class="form-control"
                                                                name="type_merk" id="type_merk" type="text" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 d-flex justify-content-center">
                                                        <a class="btn btn-primary" onclick="salert()" href="#"
                                                            style="float:left;  margin-left:25px" role="button">Tambah
                                                            Catatan Pembersihan Alat</a>
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
                                            <td>{{ $row['pob_nomor'] }}</td>
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
                                                        <input type="hidden" name="status" value="{{$row['status']}}" />
                                                        <button type="submit" class="btn btn-success">Lihat</button>
                                                    </form>
                                                    <form method="post" action="detilalat{{ $row['id_periksaalat'] }}" class="float-left mr-2" id="detilalat{{ $row['id_periksaalat'] }}">
                                                        @csrf
                                                         
                                                        <input type="hidden" name="pob_nomor" value="{{ $row['pob_nomor'] }}" />
                                                        <input type="hidden" name="nama_ruangan" value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="nama_alat" value="{{ $row['nama_alat'] }}" />
                                                        <input type="hidden" name="type_merk" value="{{ $row['type_merk'] }}" />

                                                        <input type="hidden" name="status" value="{{$row['status']}}" />
                                                        <button type="button" onclick="buttonModalEdit({{ $row['id_periksaalat'] }})" class="btn btn-primary">Edit</button>
                                                    </form>
                                                    <?php } elseif ($row['status'] == 1) { ?>
                                                    <form method="post" action="detilalat" class="float-left mr-2">
                                                        @csrf
                                                        <input type="hidden" name="id_alat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <input type="hidden" name="nama_ruangan"
                                                            value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="status" value="{{$row['status']}}" />
                                                        <button type="submit" class="btn btn-success">Lihat</button>
                                                    </form>
                                                    
                                                    <form method="post" action="detilalat" class="float-left mr-2">
                                                        @csrf
                                                        <input type="hidden" name="id_alat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <input type="hidden" name="nama_ruangan"
                                                            value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="status" value="{{$row['status']}}" />
                                                        <button type="button" class="btn btn-danger disabled">Edit</button>
                                                    </form>
                                                    <?php } ?>
                                                </td>
                                            @else
                                                <td>
                                                    <?php if ($row['status'] == 0) { ?>
                                                    <form method="post" action="detilalat" class="float-left mr-2">
                                                        @csrf
                                                        <input type="hidden" name="id_periksaruang"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <input type="hidden" name="nama_ruangan"
                                                            value="{{ $row['nama_ruangan'] }}" />
                                                        <input type="hidden" name="status" value="{{$row['status']}}" />
                                                        <button type="submit" class="btn btn-success">Lihat</button>
                                                    </form>
                                                    <form action="/terima_periksaalat" method="post" class="float-left mr-2">
                                                        @csrf
                                                        
                                                        <input type="hidden" name="id_periksaalat"
                                                            value="{{ $row['id_periksaalat'] }}" />
                                                        <button type="submit" class="btn btn-primary">Terima</button>
                                                    </form>
                                                    <?php } elseif ($row['status'] == 1) { ?>
                                                        <form method="post" action="detilalat" class="float-left mr-2">
                                                            @csrf
                                                            <input type="hidden" name="id_alat"
                                                                value="{{ $row['id_periksaalat'] }}" />
                                                            <input type="hidden" name="nama_ruangan"
                                                                value="{{ $row['nama_ruangan'] }}" />
                                                            <input type="hidden" name="status" value="{{$row['status']}}" />
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

                 <!-- Modal -->
                 <div class="modal fade" id="modalFormEdit" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">
                                    Edit Pembersihan Alat
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="edit_periksaalat" method="post" id="forminput2">
                                    <div class="card-header" id='headertglx'></div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="hidden" name="id" id='modalid_alat'
                                                class="form-control 2"/>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">PROTAP
                                                Nomor</label>
                                            <div class="col-sm">
                                                <select style="height: 35px;" class="form-control 2"
                                                    name="pob_nomor" id="modalpob_nomor">
                                                    
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
                                                <select style="height: 35px;" class="form-control 2"
                                                    name="nama_ruangan" id="modalnama_ruangan">
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
                                                <input placeholder="Nama Alat" class="form-control 2"
                                                    name="nama_alat" type="text" id="modalnama_alat" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Type
                                                Merk</label>
                                            <div class="col-sm">
                                                <input placeholder="Bagian Alat" class="form-control 2"
                                                    name="type_merk" id="modaltype_merk" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex justify-content-center">
                                            <button class="btn btn-primary" type="submit"
                                                style="float:left;  margin-left:25px" role="button">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    function editdata(params) {
                        $("#forminput").attr("action", "edit_periksaalat");
                        var inputid = '<input type="hidden" name="id" class ="form-control " value="' + params
                            .id_periksaalat + '"/>'
                        $(inputid).insertAfter("#ambil_tanggalx")
                        console.log(params);
                        $("#nama_ruangan").val(params.nama_ruangan)
                        $("#nama_alat").val(params.nama_alat)
                        $("#bagian_alat").val(params.bagian_alat)
                        $("#cara_pembersihan").val(params.cara_pembersihan)
                        $("#pelaksana").val(params.pelaksana)
                        $("#keterangan").val(params.keterangan)
                    }


                    function buttonModalEdit(p) {
                        $('#modalFormEdit').modal('show');
                        // var lantai = $(this).data('lantai');
                        $idform = 'detilalat' + p;

                    
                        var pob_nomor = $('#' + $idform + '').find('input[name="pob_nomor"]').val();
                        var nama_ruangan = $('#' + $idform + '').find('input[name="nama_ruangan"]').val();
                        var nama_alat = $('#' + $idform + '').find('input[name="nama_alat"]').val();
                        var type_merk = $('#' + $idform + '').find('input[name="type_merk"]').val();
                        
                        // console.log(pob_nomor);
                        // console.log(nama_ruangan);
                        // console.log(nama_alat);
                        // console.log(type_merk);
                        $('#modalid_alat').val(p);
                        $('#modalpob_nomor').val(pob_nomor).change();
                        $('#modalnama_ruangan').val(nama_ruangan).change();
                        $('#modalnama_alat').val(nama_alat);
                        $('#modaltype_merk').val(type_merk);
                    }
                    
                </script>
    </main>
@endsection
