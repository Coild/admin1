@extends('layout.app')
@section('title')
<title>Pembersihan Ruangan</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengolahan Batch</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengolahan Batch</li>
        </ol>
        <div class="row">

            <div class="card mb-4">

                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                        Tambah Pengolahan Batch
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modalForm" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Entry Perizinan
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form method="post" action="tambah_batch">
                                        <div>

                                            <div class="card-header">
                                                <i class="fas fa-table me-1"></i>
                                                Bagian Produksi
                                            </div>

                                            <div class="card-body">

                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sesuai
                                                        Dengan POB No</label>
                                                    <div class="col-sm-10">
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
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode
                                                        Produk</label>
                                                    <div class="col-sm-10">
                                                        <select style="height: 35px;" class="form-control" name="kode_produk" id="inlineFormCustomSelect">
                                                            <option selected>Choose...</option>
                                                            <option value="1">rsl</option>
                                                            <option value="2">kyt</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama
                                                        Produk</label>
                                                    <div class="col-sm-10">
                                                        <select style="height: 35px;" class="form-control" name="nama_produk" id="inlineFormCustomSelect">
                                                            <option selected>Choose...</option>
                                                            <option value="1">Rosela</option>
                                                            <option value="2">Kunyit</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor
                                                        Batch</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="no_batch" class="form-control" id="inputEmail3" placeholder="Nomor Batch" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Besar
                                                        Batch</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="besar_batch" class="form-control" id="inputEmail3" placeholder="Besar Batch" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Bentuk
                                                        Sediaan</label>
                                                    <div class="col-sm-10">
                                                        <select style="height: 35px;" class="form-control" name="bentuk sediaan" id="inlineFormCustomSelect">
                                                            <option selected>Choose...</option>
                                                            <option value="1">Serbuk Tabur</option>
                                                            <option value="2">Cair</option>
                                                            <option value="2">Cairan Kental</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kemasan</label>
                                                    <div class="col-sm-10">
                                                        <select style="height: 35px;" name="kemasan" class="form-control" id="inlineFormCustomSelect">
                                                            <option selected>Choose...</option>
                                                            <option value="1">Pot</option>
                                                            <option value="2">Pouch</option>
                                                            <option value="2">Sachet</option>
                                                        </select>
                                                    </div>
                                                </div>



                                            </div>
                                            <button type="submit" class="btn btn-primary" style="float:left; width: 100px;  margin-left:25px">SIMPAN</button>
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
                            <th scope="col">Nomor Batch</th>
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
                            <td>{{ $row['nomor_batch'] }}</td>
                            <td>
                                @if ($row['status'] == 0)
                                    {{'Belum Diajukan'}}
                                @elseif ($row['status'] == 1)
                                    {{'Diajukan'}}
                                @else
                                    {{'Diterima'}}
                                @endif
                                

                            </td>
                            <td>
                                <a class="btn btn-primary" href="detil_batch/{{ $row['nomor_batch'] }}">Buka</a>
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