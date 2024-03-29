@extends('layout.app')
@section('title')
    <title>Spesifikasi Bahan Kemas</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"> Spesifikasi Bahan Kemas </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{ session('pabrik') }}</li>
            </ol>
            <div class="row">

                <!--  -->
                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                            Tambah Spesifikasi Bahan Kemas
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Masukan Data
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form action="/tambah_bahan_kemas" method="post" enctype="multipart/form-data"
                                            role="form" id="forminput1">

                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="form-group">
                                                <label for="inputName">Sesuai PROTAP</label>
                                                <select name="protap" id="protap" class="form-control 1">
                                                    @foreach ($protap as $isi)
                                                        <option value="{{ $isi['protap_id'] }}">{{ $isi['protap_nama'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputName">Keterangan</label>
                                                <input type="text" class="form-control 1" id="inputName"
                                                    name="nama" />
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Pilih File</label>
                                                <input type="file" name="upload" class="form-control 1" id="fileform"
                                                    onchange="return filecheck()">
                                                <p style="font-size: 15px; color:red;">*Hanya menerima file PDF</p>
                                            </div>
                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary submitBtn"
                                                    onclick="salert1(1)">
                                                    Tambah
                                                </button>
                                            </div>


                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!--  -->

                        <table class="table" id="tabel1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($list as $row)
                                    <?php $i++;
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $row['keterangan'] }}</td>
                                        <td>
                                            <form action="/hapus_bahan_kemas" method="post"
                                                id="hapusBB{{ $row['spesifikasi_id'] }}">
                                                @csrf
                                                <input type="hidden" name="idBB" value="{{ $row['spesifikasi_id'] }}">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="buttonHapusBB({{ $row['spesifikasi_id'] }})">Hapus</button>
                                            </form>
                                            {{-- <a href="/asset/coa/{{$row['file']}}" button type="button" class="btn btn-primary">Buka</button> --}}
                                            <form action="/lihatpdf" method="post">
                                                @csrf
                                                <input type="hidden" name="path" value="/asset/coa/{{ $row['file'] }}">
                                                <button type="submit" class="btn btn-success" onclick="">
                                                    Buka</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- <a class="btn btn-primary" href="#">Edit</a>
                        <a class="btn btn-primary" href="#">Cetak</a> -->

    </main>
@endsection
