@extends('layout.app')
@section('title')
    <title>Penarikan Produk</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Catatan Penarikan Produk</h1>
            <ol class="breadcrumb mb-4">Penarikan Produk</li>
            </ol>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm"
                                onclick="setdatetoday()">
                                Tambah Penarikan Produk
                            </button>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Entry Penarikan Produk
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_penarikan" id='forminput1'>
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <i class="fas fa-table me-1"></i>
                                                    Penarikan
                                                </div>
                                                <div class="card-header" id="headertgl">
                                                </div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="card-body">

                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">Protap</label>
                                                        <div class="col-sm">
                                                            <select style="height: 35px;" class="form-control 1"
                                                                name="protap_induk" id="protap_induk">
                                                                @foreach ($data2 as $row)
                                                                    <option value="{{ $row['protap_id'] }}">
                                                                        {{ $row['protap_nama'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                                            Penarikan</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="kode_penarikan"
                                                                class="form-control 1" id="kode_penarikan"
                                                                placeholder="Kode Penarikan" />
                                                        </div>
                                                    </div>

                                                    <input type="hidden" id='ambil_tanggal' />

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                            Distributor</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="nama_distributor"
                                                                class="form-control 1" id="nama_distributor"
                                                                placeholder="Nama Distributor" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Produk Yang
                                                            Ditarik</label>
                                                        <div class="col-sm">
                                                            <input type="text" list="listproduk" style="height: 35px;"
                                                                id='produkditarik' class="form-control 1"
                                                                name="produk_ditarik" autocomplete="off">
                                                            </input>
                                                            <datalist id="listproduk">
                                                                @foreach ($produk as $row)
                                                                    <option value="{{ $row['produk_nama'] }}">
                                                                        {{ $row['produk_nama'] }}
                                                                    </option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                                            Produk Ditarik</label>
                                                        <div class="col-sm">

                                                            <div class="row">
                                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                                    <input type="number" name="jumlah_produk_ditarik"
                                                                        class="form-control 1" id="jumlah_produk_ditarik"
                                                                        placeholder="Jumlah Produk Ditarik" />
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" name="satuan"
                                                                        id="satuan">
                                                                        <option value="gr"> gr</option>
                                                                        <option value="kg"> kg</option>
                                                                        <option value="ml"> ml</option>
                                                                        <option value="L"> L</option>
                                                                        <option value="Pcs"> Pcs</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                                            Batch</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="no_batch" class="form-control 1"
                                                                id="no_batch" placeholder="No Batch" maxlength="20"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Alasan
                                                            Penarikan</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="alasan_penarikan"
                                                                class="form-control 1" id="alasan_penarikan"
                                                                placeholder="Alasan Penarikan" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <a class="btn btn-primary" onclick="salert1(1)" href="#"
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
                                <th scope="col">Protap</th>
                                <th scope="col">Kode Penarikan Produk</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Distributor</th>
                                <th scope="col">Produk Ditarik</th>
                                <th scope="col">Jumlah Produk Ditarik</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Alasan Penarikan</th>
                                <th scope="col">Status</th>
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
                                    <td>{{ $row['protap_nama'] }}</td>
                                    <td>{{ $row['kode_penarikan'] }}</td>
                                    <td>{{ $row['tanggal_penarikan'] }}</td>
                                    <td>{{ $row['nama_distributor'] }}</td>
                                    <td>{{ $row['produk_ditarik'] }}</td>
                                    <td>{{ $row['jumlah_produk_ditarik'] }}</td>
                                    <td>{{ $row['no_batch'] }}</td>
                                    <td>{{ $row['alasan_penarikan'] }}</td>
                                    <td><?php if ($row['status'] == 0) {
                                        echo 'Diajukan';
                                    } elseif ($row['status'] == 1) {
                                        echo 'Diterima';
                                    } ?></td>
                                    <td>
                                        @if (Auth::user()->level != 2)
                                            <?php if ($row['status'] == 0) { ?>
                                            <a href="#" type="submit" data-toggle="modal"
                                                data-target="#modalForm" class="btn btn-primary"
                                                onclick="editdata({{ $row }})">Edit</a>
                                            <?php } elseif ($row['status'] == 1) { ?>
                                            <a href="#" type="submit" data-toggle="modal"
                                                data-target="#modalForm" class="btn btn-danger disabled"
                                                onclick="editdata({{ $row }})">Edit</a>
                                            <?php } ?>
                                        @else
                                            <?php if ($row['status'] == 0) { ?>
                                            <form method="post" action="terimapenarikanproduk"
                                                id="formTerimaLaporan{{ $row['id_produk_penarikan'] }}">
                                                @csrf
                                                <input type="hidden" name="id"
                                                    value="{{ $row['id_produk_penarikan'] }}" />
                                                <button type="button"
                                                    onclick="buttonTerimaLaporan({{ $row['id_produk_penarikan'] }})"
                                                    class="btn btn-primary">Terima</button>
                                            </form>

                                            <?php } elseif ($row['status'] == 1) { ?>
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
                setdatetoday()
                $("#forminput1").attr("action", "edit_penarikan");
                var inputid = '<input type="hidden" name="id" class ="form-control" value="' + params
                    .id_produk_penarikan + '"/>'
                $(inputid).insertAfter("#ambil_tanggal")
                $("#protap_induk").val(params.protap)
                $("#kode_penarikan").val(params.kode_penarikan)
                $("#nama_distributor").val(params.nama_distributor)
                $("#produkditarik").val(params.produk_ditarik)
                $("#no_batch").val(params.no_batch)
                $("#alasan_penarikan").val(params.alasan_penarikan)
                $("#jumlah_produk_ditarik").val(params.jumlah_produk_ditarik.replace(/[^0-9]/g, ''))
                $("#satuan").val(params.jumlah_produk_ditarik.replace(/[^a-zA-Z]+/, ''))
            }
        </script>
    </main>
@endsection
