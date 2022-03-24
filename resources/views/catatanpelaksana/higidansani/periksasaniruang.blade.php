@extends('layout.app')
@section('title')
<title>COA</title>
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
                    Entry Data
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu Pembersihan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="bulan" id="inlineFormCustomSelect">
                                <option selected>Choose...</option>
                                <option value="1">Pagi</option>
                                <option value="2">Sore</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Ruangan</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="bulan" id="inlineFormCustomSelect">
                                <option selected>Choose...</option>
                                <option value="1">Pagi</option>
                                <option value="2">Sore</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Pembersihan Alat pada Ruangan
                </div>
                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                        Tambah Data Ruangan
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
                                        <th scope="col" style="width:45%" class="text-center">Nama Ruangan</th>
                                        <th scope="col" style="width:50%" class="text-center">Item yang Dibersihkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td scope="col" class="text-center">1</td>
                                    <td scope="col" class="text-center">
                                        <div class="form-group row">
                                            <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu</label> -->
                                            <div class="col-sm-10">
                                                <select class="form-control" name="bulan" id="inlineFormCustomSelect">
                                                    <option selected>Choose...</option>
                                                    <option value="1">Ruang mixing,filling,pengemasan primer</option>
                                                    <option value="2">Ruang timbang</option>
                                                    <option value="3">Ruang ...</option>
                                                    <option value="4">Ruang ...</option>
                                                    <option value="5">Ruang ...</option>
                                                    <option value="6">Ruang ...</option>
                                                    <option value="7">Ruang ...</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        
                                            <div style="padding-left:10%;" class="form-group row">
                                                <div class="col-sm-6">Lantai/ Dinding</div>
                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="lantaidinding" class="custom-control-input" id="customSwitch1">
                                                        <label class="custom-control-label" for="customSwitch1">Sudah</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="padding-left:10%;" class="form-group row">
                                                <div class="col-sm-6">Meja</div>
                                                <div class="col-sm-5">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="meja" class="custom-control-input" id="customSwitch2">
                                                        <label class="custom-control-label" for="customSwitch2">Sudah</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="padding-left:10%;" class="form-group row">
                                                <div class="col-sm-6">Jendela</div>
                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="jendela" class="custom-control-input" id="customSwitch3">
                                                        <label class="custom-control-label" for="customSwitch3">Sudah</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="padding-left:10%;" class="form-group row">
                                                <div class="col-sm-6">Langit-langit/ Plafon</div>
                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="plafon" class="custom-control-input" id="customSwitch4">
                                                        <label class="custom-control-label" for="customSwitch4">Sudah</label>
                                                    </div>
                                                </div>
                                            </div>
                                        
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
            <!-- <a class="btn btn-primary" href="#">Edit</a>
                    <a class="btn btn-primary" href="#">Cetak</a> -->

</main>
@endsection