@extends('layout.app')
@section('title')
    <title>Pemusnahan Produk</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Catatan Pemusnahan Produk</h1>
            <ol class="breadcrumb mb-4">Pemusnahan Produk</li>
            </ol>
            <div class="row">

                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm"
                            onclick="setdatetoday()">
                            Tambah Pemusnahan Produk
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Entry Pemusnahan Produk
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_pemusnahanproduk" id='forminput'>
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <i class="fas fa-table me-1"></i>
                                                    Pemusnahan
                                                </div>
                                                <div class="card-header" id="headertgl">

                                                </div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="card-body">

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Kode
                                                            Pemusnahan</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="kode_pemusnahan" class="form-control"
                                                                id="inputEmail3" placeholder="Kode Pemusnahan" />
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id='ambil_tanggal' class="form-control"
                                                        name="tanggal" placeholder="" />

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk
                                                            Jadi</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="nama_produk_jadi"
                                                                class="form-control" id="inputEmail3"
                                                                placeholder="Nama Produk Jadi" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">No
                                                            Batch</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="no_batch" class="form-control"
                                                                id="inputEmail3" placeholder="No Batch" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Asal Produk
                                                            Jadi</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="asal_produk_jadi"
                                                                class="form-control" id="inputEmail3"
                                                                placeholder="Asal Produk Jadi" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah
                                                            Produk Jadi</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="jumlah_produk_jadi"
                                                                class="form-control" id="inputEmail3"
                                                                placeholder="Jumlah Produk Jadi" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alasan
                                                            Pemusnahan</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="alasan_pemusnahan"
                                                                class="form-control" id="inputEmail3"
                                                                placeholder="Alasan Pemusnahan" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Cara
                                                            Pemusnahan</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="cara_pemusnahan" class="form-control"
                                                                id="inputEmail3" placeholder="Cara Pemusnahan" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-2 col-form-label">Petugas</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="petugas" class="form-control"
                                                                id="inputEmail3" placeholder="Petugas" />
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
                                <th scope="col">No</th>
                                <th scope="col">Kode Pemusnahan Produk</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk Jadi</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Asal Produk Jadi</th>
                                <th scope="col">Jumlah Produk Jadi</th>
                                <th scope="col">Alasan Pemusnahan</th>
                                <th scope="col">Cara Pemusnahan</th>
                                <th scope="col">Petugas</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data as $row)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row['id_produk_pemusnahan'] }}</td>
                                    <td>{{ $row['tanggal_pemusnahan'] }}</td>
                                    <td>{{ $row['nama_produk_jadi'] }}</td>
                                    <td>{{ $row['id_batch'] }}</td>
                                    <td>{{ $row['asal_produk_jadi'] }}</td>
                                    <td>{{ $row['jumlah_produk_jadi'] }}</td>
                                    <td>{{ $row['alasan_pemusnahan'] }}</td>
                                    <td>{{ $row['cara_pemunsnahan'] }}</td>
                                    <td>{{ $row['nama_petugas'] }}</td>
                                    <td>
                                        <form method="post" action="detil_batch">
                                            <input type="hidden" name="_token" value="" />
                                            <input type="hidden" name="nobatch" value="" />
                                            <button type="submit" class="btn btn-primary">Buka</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
