@extends('layout.app')
@section('title')
    <title>Pengemasan Batch</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Catatan Pengemasan Batch</h1>
            <ol class="breadcrumb mb-4">Pengemasan Batch</li>
            </ol>
            <div class="row">

                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm"
                                onclick="setdatetoday()">
                                Tambah Pengemasan Batch
                            </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Entry Pengemasan Batch
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_pengemasanbatchproduk" id='forminput'>
                                            <div class="card mb-4">
                                                <div class="card-header" id='headertgl'></div>
                                                <div class="card-header">
                                                    <i class="fas fa-table me-1"></i>
                                                    Pengemasan Batch
                                                </div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="card-body">

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                                            Produk</label>
                                                        <div class="col-sm">
                                                            <select style="height: 35px;" id='kodeproduk'
                                                                class="form-control" name="kode_produk">
                                                                <option selected>Choose...</option>
                                                                @foreach ($produk as $row)
                                                                    <option value="{{ $row['produk_kode'] }}"
                                                                        data-nama="{{ $row['produk_nama'] }}">
                                                                        {{ $row['produk_kode'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                            Produk</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="nama_produk" readonly
                                                                class="form-control" id="namaproduk"
                                                                placeholder="Nama Produk" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                                            Batch</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="no_batch" class="form-control"
                                                                id="inputEmail3" placeholder="No Batch" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Besar
                                                            Batch</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="besar_batch" class="form-control"
                                                                id="inputEmail3" placeholder="Besar Batch" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Bentuk
                                                            Sediaan</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="bentuk_sediaan" class="form-control"
                                                                id="inputEmail3" placeholder="Bentuk Sediaan" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">Kemasan</label>
                                                        <div class="col-sm">
                                                            <select style="height: 35px;" name="kemasan"
                                                                class="form-control" id="inlineFormCustomSelect">
                                                                <option selected>Choose...</option>
                                                                @foreach ($kemasan as $row)
                                                                    <option value="{{ $row['kemasan_nama'] }}">
                                                                        {{ $row['kemasan_nama'] }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">Mulai</label>
                                                        <div class="col-sm">
                                                            <input type="datetime-local" name="mulai" class="form-control"
                                                                id="inputEmail3" placeholder="Tipe/Merek" />
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

                                                </div>
                                                <a class="btn btn-primary" onclick="salert()" href="#"
                                                    style="float:left; width: 100px;  margin-left:25px" role="button">
                                                    Simpan</a>
                                            </div>
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
                                <th scope="col">Kode Produk</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Besar Batch</th>
                                <th scope="col">Bentuk Sediaan</th>
                                <th scope="col">Kemasan</th>
                                <th scope="col">Tanggal Pengolahan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <?php $i = 0;
                                $i++; ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $row['kode_produk'] }}</td>
                                    <td>{{ $row['nama_produk'] }}</td>
                                    <td>{{ $row['no_batch'] }}</td>
                                    <td>{{ $row['besar_batch'] }}</td>
                                    <td>{{ $row['bentuksediaan'] }}</td>
                                    <td>{{ $row['kemasan'] }}</td>
                                    <td>{{ $row['mulai'] }} sampai
                                        {{ $row['selesai'] }}
                                    </td>
                                    <td>
                                        <?php if ($row['status'] == 0) {
                                            echo 'Diajukan';
                                        } elseif ($row['status'] == 1) {
                                            echo 'Diterima';
                                        } ?>
                                    </td>
                                    <td>

                                        @if (Auth::user()->level == 2)
                                            <form method="post" action="terimaoperasialat">
                                                @csrf
                                                <input type="hidden" name="nobatch" value="{{ $row['id_operasi'] }}" />
                                                <button type="submit" class="btn btn-primary">terima</button>
                                            </form>
                                        @else
                                            <form method="post" action="detil_batch">
                                                @csrf
                                                <input type="hidden" name="nobatch" value="" />
                                                <button type="submit" class="btn btn-primary">edit</button>
                                            </form>
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
            $("#kodeproduk").change(function() {
                const $this = $(this); // Cache $(this)
                const dataVal = $this.find(":selected").data("nama"); // Get data value
                document.getElementById('namaproduk').value = dataVal;
            });
        </script>
    </main>
@endsection
