@extends('layout.app')
@section('title')
    <title>Detail  Pengoprasian Alat Utama</title>
@endsection
@section('content')
<?php $data =[];  ?>
    <main>
        <div class="container-fluid px-4">
            <h1>Catatan Pengoprasian Alat Utama</h1>
            <ol class="breadcrumb mb-4">Detail Pengoprasian Alat Utama</li>
            </ol>
            <div class="row">

                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm"
                                onclick="setdatetoday()">
                                Tambah Pengoprasian Alat Utama
                            </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Detail Pengoprasian Alat Utama
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_operasialat" id='forminput'>
                                            <div class="card mb-4">
                                                <div class="card-header" id='headertgl'></div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <i class="fas fa-table me-1"></i>
                                                        Pembersihan Alat Utama
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Mulai</label>
                                                            <div class="col-sm">
                                                                <input type="datetime-local" name="mulai"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Tipe/Merek" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">selesai</label>
                                                            <div class="col-sm">
                                                                <input type="datetime-local" name="selesai"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Tipe/Merek" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Oleh</label>
                                                            <div class="col-sm">
                                                                <input type="text" name="oleh" class="form-control"
                                                                    id="inputEmail3" placeholder="Oleh" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Keterangan</label>
                                                            <div class="col-sm">
                                                                <input type="text" name="ket" class="form-control"
                                                                    id="inputEmail3" placeholder="Keterangan" />
                                                            </div>
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
                        <!--  -->

                    </div>

                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">Mulai</th>
                                <th scope="col">Selesai</th>
                                <th scope="col">Oleh</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <?php $i = 0;
                                $i++; ?>
                                <tr>
                                    <td>{{ $row['mulai'] }}</td>
                                    <td>{{ $row['selesai'] }}</td>
                                    <td>{{ $row['oleh'] }}</td>
                                    <td>{{ $row['ket'] }}</td>
                                    <td>

                                        @if (Auth::user()->level == 2)
                                            <form method="post" action="terimaoperasialat" >
                                                @csrf
                                                <input type="hidden" name="nobatch" value="{{ $row['id_operasi'] }}" />
                                                <button type="submit" class="btn btn-primary">terima</button>
                                            </form>
                                        @else
                                            <form method="post" action="#" class="float-left mr-2">
                                                @csrf
                                                <input type="hidden" name="nobatch" value="" />
                                                <button type="submit" class="btn btn-primary">lihat</button>
                                            </form>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editalat" >edit</button>
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

     <!-- Modal -->
     <div class="modal fade" id="editalat" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Edit Pengoprasian Alat Utama
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_operasialat" id='forminput'>
                                            <div class="card mb-4">
                                                <div class="card-header" id="headertgl">

                                                </div>
                                                <div class="card-header" id='headertgl'></div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <i class="fas fa-table me-1"></i>
                                                        Pembersihan Alat Utama
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Mulai</label>
                                                            <div class="col-sm">
                                                                <input type="datetime-local" name="mulai"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Tipe/Merek" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">selesai</label>
                                                            <div class="col-sm">
                                                                <input type="datetime-local" name="selesai"
                                                                    class="form-control" id="inputEmail3"
                                                                    placeholder="Tipe/Merek" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Oleh</label>
                                                            <div class="col-sm">
                                                                <input type="text" name="oleh" class="form-control"
                                                                    id="inputEmail3" placeholder="Oleh" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Keterangan</label>
                                                            <div class="col-sm">
                                                                <input type="text" name="ket" class="form-control"
                                                                    id="inputEmail3" placeholder="Keterangan" />
                                                            </div>
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
                        <!--  -->
@endsection
