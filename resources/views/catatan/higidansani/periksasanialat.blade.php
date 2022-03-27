@extends('layout.app')
@section('title')
<title>COA</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Peralatan </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Catatan Pembersihan Alat</li>
        </ol>
        <form action="/input_catatbersih" method="post">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row">
                <!-- Entry Data -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Entry Data
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Bulan</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="height: 35px;" name="bulan" id="inlineFormCustomSelect">
                                    <option selected>Choose...</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Pelaksana</label>
                            <div class="col-sm-10">
                                <input type="text" name="batchnum" class="form-control" id="inputPassword3" placeholder="Pelaksana">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Disetujui Oleh</label>
                            <div class="col-sm-10">
                                <input type="text" name="batchnum" class="form-control" id="inputPassword3" placeholder="Disetujui Oleh">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="batchnum" class="form-control" id="inputPassword3" placeholder="Keterangan">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian yang dibersihkan  -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Daftar yang Dibersihkan
                    </div>
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                            Tambah Data Alat
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Entry Data
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- pop up end -->
                        <div class="table-responsive-lg">
                            <form>
                                <table class="table col-lg-13">
                                    <thead>

                                        <tr>
                                            <th scope="col" style="width:5%" class="text-center">No</th>
                                            <th scope="col" style="width:35%" class="text-center">Bagian yang Dibersihkan</th>
                                            <th scope="col" style="width:30%" class="text-center">Tanggal</th>
                                            <th scope="col" style="width:30%" class="text-center">Jam</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <td scope="col" class="text-center">1</td>
                                        <td scope="col" class="text-center">Spatula</td>
                                        <td scope="col">
                                            <center>
                                                <input type="date" style="width: 80%;" class="form-control" id="tgl" name="tgl" />
                                            </center>
                                        </td>
                                        <td scope="col">
                                            <center>
                                                <input type="time" style="width: 80%;" class="form-control" id="jam" name="jam" />
                                            </center>
                                        </td>
                                        <td scope="col" class="justify-content-center"></td>
                                    </tbody>
                                </table>
                                <div class="col-lg-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 25px;">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Semula  class="d-flex justify-content-center"-->
        </form>

</main>
@endsection