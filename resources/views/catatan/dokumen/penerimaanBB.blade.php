@extends('layout.app')
@section('title')
<title>Penerimaan Penyerahan dan Penyimpanan</title>
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Catatan Penerimaan Penyerahan dan Penyimpanan</h1>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Bahan Baku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Produk Jadi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Kemasan</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row">

                    <div class="card mb-4">

                        <div class="card-body">
                            <!-- pop up -->
                            <!-- Button to trigger modal -->
                            @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalBahan">
                                Tambah Bahan Baku
                            </button>
                            @endif


                        </div>

                        <table class="table mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Nomor Batch</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                    <div class="card mb-4">

                        <div class="card-body">
                            <!-- pop up -->
                            <!-- Button to trigger modal -->
                            @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalProduk">
                                Tambah Produk Jadi
                            </button>
                            @endif


                        </div>

                        <table class="table mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Nomor Batch</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row">

                    <div class="card mb-4">

                        <div class="card-body">
                            <!-- pop up -->
                            <!-- Button to trigger modal -->
                            @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalKemasan">
                                Tambah Kemasan
                            </button>
                            @endif


                        </div>

                        <table class="table mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Produk</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Nomor Batch</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Bahhan -->
    <div class="modal fade" id="modalBahan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Tamba Bahan Baku
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form method="post" action="tambah_batch" id='forminput'>
                        <div>
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bagian Produksi
                            </div>

                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                        Dengan PROTAP No</label>
                                    <div class="col-sm">
                                        <input type="text" name="pob" class="form-control" id="inputEmail3" placeholder="Nomor POB" />
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
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nomor
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="no_batch" class="form-control" id="inputEmail3" placeholder="Nomor Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Besar
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="besar_batch" class="form-control" id="inputEmail3" placeholder="Besar Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Bentuk
                                        Sediaan</label>
                                    <div class="col-sm">
                                        <input placeholder="Bentuk Sediaan" class="form-control" name="bentuk sediaan" type="text" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kategori</label>
                                    <div class="col-sm">
                                        <input placeholder="Kategori" class="form-control" name="kategori" type="text" />
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

    <!-- Modal Produk -->
    <div class="modal fade" id="modalProduk" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Tamba Produk Jadi
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form method="post" action="tambah_batch" id='forminput'>
                        <div>
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bagian Produksi
                            </div>

                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                        Dengan PROTAP No</label>
                                    <div class="col-sm">
                                        <input type="text" name="pob" class="form-control" id="inputEmail3" placeholder="Nomor POB" />
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
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nomor
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="no_batch" class="form-control" id="inputEmail3" placeholder="Nomor Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Besar
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="besar_batch" class="form-control" id="inputEmail3" placeholder="Besar Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Bentuk
                                        Sediaan</label>
                                    <div class="col-sm">
                                        <input placeholder="Bentuk Sediaan" class="form-control" name="bentuk sediaan" type="text" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kategori</label>
                                    <div class="col-sm">
                                        <input placeholder="Kategori" class="form-control" name="kategori" type="text" />
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

    <!-- Modal Kemasan -->
    <div class="modal fade" id="modalKemasan" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Tamba Kemasan
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form method="post" action="tambah_batch" id='forminput'>
                        <div>
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bagian Produksi
                            </div>

                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                        Dengan PROTAP No</label>
                                    <div class="col-sm">
                                        <input type="text" name="pob" class="form-control" id="inputEmail3" placeholder="Nomor POB" />
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
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nomor
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="no_batch" class="form-control" id="inputEmail3" placeholder="Nomor Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Besar
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="besar_batch" class="form-control" id="inputEmail3" placeholder="Besar Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Bentuk
                                        Sediaan</label>
                                    <div class="col-sm">
                                        <input placeholder="Bentuk Sediaan" class="form-control" name="bentuk sediaan" type="text" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kategori</label>
                                    <div class="col-sm">
                                        <input placeholder="Kategori" class="form-control" name="kategori" type="text" />
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
</main>
@endsection