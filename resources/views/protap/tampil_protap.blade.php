@extends('layout.app')
@section('title')
<title>PROTAP - {{ $judul[0] }}</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">PROTAP </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{ $judul[0] }}</li>
        </ol>
        <div class="row">

            <!--  -->
            <div class="card mb-4">

                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if (Auth::user()->level == 2)
                    <button class="btn btn-success btn-lg" onclick="setdatetoday()" data-toggle="modal" data-target="#modalForm">
                        Tambah PROTAP
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Entry PROTAP
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form action="/input_protap/{{ $jenis }}" method="post" enctype="multipart/form-data" role="form" id='forminput1'>

                                        @if (count($judul) <= 1) <div class="form-group">
                                            <label for="inputName">Nama PROTAP</label>
                                            <input type="text" class="form-control 1" id="inputName" name="nama" />
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nomor PROTAP</label>
                                    <input type="text" class="form-control 1" id="inputNo" name="nomor" />
                                </div>
                                @else
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis
                                        PROTAP</label>
                                    <div class="col-sm">
                                        <select style="height: 35px;" class="form-control 1" name="detil" id="inlineFormCustomSelect">
                                            <option selected>Pilih...</option>
                                            <?php
                                            $panjang = count($judul);
                                            for ($i = 1; $i < $panjang; $i++) { ?>
                                                <option value="{{ $i }}">
                                                    {{ $judul[$i] }}
                                                </option>
                                            <?php  }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nama PROTAP</label>
                                    <input type="text" class="form-control 1" id="inputName" name="nama" />
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Nomer PROTAP</label>
                                    <input type="text" class="form-control 1" id="inputNo" name="nomor" />
                                </div>
                                @endif
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />


                                <div class="form-group">
                                    <label for="inputName">Disusun Oleh</label>
                                    <select name="diajukan" id="inputName" class="form-control 1">
                                        @foreach ($ajukan as $data)
                                        <option value="{{$data['namadepan']}} {{$data['namabelakang']}}">
                                            {{$data['namadepan']}} {{$data['namabelakang']}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <!-- <input type="text" class="form-control 1" id="inputName" name="diajukan" /> -->
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Tanggal Disusun</label>
                                    <input type="date" class="form-control 1" id="inputName" name="tgl_diajukan" />
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Disetjui Oleh</label>
                                    <input type="text" class="form-control 1" id="inputName" name="disetujui" value="{{$pemilik ['namadepan']}} {{$pemilik   ['namabelakang']}}" readonly />
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Tanggal Disetjui</label>
                                    <input type="date" class="form-control 1" id="inputName" name="tgl_disetujui" />
                                </div>

                                <input type="hidden" id='ambil_tanggal' name="tanggal" placeholder="" />

                                <div class="form-group">
                                    <label for="inputName">Ruangan</label>
                                    <input type="text" class="form-control 1" id="inputName" name="ruangan" />
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="exampleFormControlFile1">Pilih
                                        File Protap</label>
                                    <div class="col-sm">
                                        <input type="file" name="upload" class="form-control 1" id="fileform" onchange="return filecheck()">
                                    </div>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                    <a href="#" type="submit" class="btn btn-primary submitBtn" onclick="salert1(1)">
                                        Tambah
                                    </a>
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
                            <th scope="col">Nama PROTAP</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($list_protap as $row)
                        <?php $i++;
                        $nama = $row['protap_nama'];
                        ?>
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $row['protap_nama'] }}</td>
                            <td>
                                @if (Auth::user()->level == 2)
                                <a href="#" type="button" class="btn btn-danger" onclick="hapusprotap({msg: 'Apakah Anda Yakin Hapus {{$row['protap_nama']}}?',id:{{ $row['protap_id'] }},url:'hapus_protap/{{ $row['protap_id'] }}/{{ $row['protap_jenis'] }}'})">Hapus</a>
                                @endif
                                <a href="/asset/protap/{{ $row['protap_file'] }}" button type="button" class="btn btn-primary">Buka</a>
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