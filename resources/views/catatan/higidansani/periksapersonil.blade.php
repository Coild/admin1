@extends('layout.app')
@section('title')
    <title>COA</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Periksa Personil </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Higiene dan Sanitasi Periksa Personil</li>
            </ol>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm"
                                onclick="setdatetoday()">
                                Tambah Pemeriksaan Personil
                            </button>
                        @endif
                        

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Entry Periksa Personil
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_periksapersonil" enctype="multipart/form-data" id='forminput7'>
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <i class="fas fa-table me-1"></i>
                                                    Personil
                                                </div>
                                                <div class="card-header" id="headertgl">
                                                </div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="card-body">

                                                    <input type="hidden" id='ambil_tanggal'
                                                        name="tanggal" placeholder="" />

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                            Personil</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="nama_personil" class="form-control 7"
                                                                id="nama_personil" placeholder="Nama Personil" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label"
                                                            for="exampleFormControlFile1">Surat Sehat</label>
                                                        <div class="col-sm">
                                                            <input type="file" name="file" class="form-control 7"
                                                                id="fileform" onchange="return filecheck()">
                                                        </div>
                                                    </div>

                                                </div>
                                                <a class="btn btn-primary" onclick="salert1(7)" href="#"
                                                    style="float:left; width: 100px;  margin-left:25px"
                                                    role="button">Simpan</a>
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
                                <th scope="col">Nama Personil</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data as $row)
                                <?php
                                $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row['nama'] }}</td>
                                    <td>
                                        @if (Auth::user()->level == 2)
                                            {{-- <form method="post" action="terimapenimbanganproduk">
                                                @csrf
                                                <input type="hidden" name="nobatch" value="{{ $row['personil_id'] }}" />
                                                <button type="submit" class="btn btn-primary">Terima</button>
                                            </form> --}}
                                            <a href="asset/health_personil/{{ $row['nama_file'] }}"
                                                class="btn btn-primary">Buka</a>
                                        @else
                                            <a href="asset/health_personil/{{ $row['nama_file'] }}"
                                                class="btn btn-primary">Buka</a>
                                            <a href="#" type="submit" data-toggle="modal" data-target="#modalForm"
                                                class="btn btn-primary" onclick="editdata({{ $row }})">Edit</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        function editdata(params) {
            setdatetoday()
            $("#forminput7").attr("action", "edit_periksapersonil");
            var inputid = '<input type="hidden" id="id" name="id" class ="form-control" value="' + params
                .personil_id + '"/>'
            var filename = '<input type="hidden" id="filename" name="filename" class ="form-control" value="' + params
                .nama_file + '"/>'
            $(inputid).insertAfter("#ambil_tanggal")
            $(filename).insertAfter("#ambil_tanggal")
            $("#nama_personil").val(params.nama)
            var source = '<p>' + params.nama_file +
                ' <i class="fas fa-download"></i> <a href="asset/health_personil/' +
                params
                .nama_file +
                '" >Buka</a></p> '
            $(source).insertBefore("#fileform")
        }
    </script>
@endsection
