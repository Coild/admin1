@extends('layout.app')
@section('title')
    <title>Periksa ruangan</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Catatan Periksa Ruangan</h1>
            <ol class="breadcrumb mb-4">Periksa Ruangan</li>
            </ol>
            <div class="row">

                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm"
                                onclick="setdatetoday()">
                                Tambah Ruangan
                            </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Entry Ruangan
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_ruang" id='forminput'>
                                            <div class="card mb-4">
                                                <div class="card-header" id='headertgl'></div>
                                                <div class="card-header">
                                                    <i class="fas fa-table me-1"></i>
                                                    Ruangan
                                                </div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nomer
                                                            Prosedur</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="nomer_prosedur" class="form-control" id="nomer_prosedur"
                                                                placeholder="Nomer prosedur" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                            Ruangan</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="nama" class="form-control" id="nama"
                                                                placeholder="Nama Ruangan" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="tanggal" id='ambil_tanggal'
                                                    class="form-control" placeholder="" />
                                                <a class="btn btn-primary" onclick="salert()" href="#"
                                                    style="float:left; width: 100px;  margin-left:25px" role="button">
                                                    Simpan</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>

                <table class="table" style="text-align: center;" id="tabel1" >
                    <thead>
                        <tr>
                            <th scope="col" rowspan="3">No</th>
                            <th scope="col" rowspan="3" >Nama Ruangan</th>
                            <th scope="col" colspan="8">Bagian yang dibersihkan</th>
                            <th scope="col" rowspan="3">Action</th>
                        </tr>
                        <tr>                            
                            <th scope="col" colspan="2">Lantai</th>    
                            <th scope="col" colspan="2">Meja</th>    
                            <th scope="col" colspan="2">Jendela</th>    
                            <th scope="col" colspan="2">Langit-langit</th>    
                        </tr>
                        <tr>
                            <th scope="col">Tgl</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Tgl</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Tgl</th>
                            <th scope="col">Jam</th>
                            <th scope="col">Tgl</th>
                            <th scope="col">Jam</th>    
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($data as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row['nama_ruangan'] }}</td>
                                <td scope="col">Tgl</td>
                                <td scope="col">Jam</td>
                                <td scope="col">Tgl</td>
                                <td scope="col">Jam</td>
                                <td scope="col">Tgl</td>
                                <td scope="col">Jam</td>
                                <td scope="col">Tgl</td>
                                <td scope="col">Jam</td>
                                <td>
                                    <form method="post" action="detilruangan" class="float-left mr-2">
                                        @csrf
                        <input type="hidden" name="id_ruangan"  value="{{ $row['id_periksaruang'] }}" />
                        <button type="submit" class="btn btn-primary"> Lihat</button>
                                    </form>
                                    @if (Auth::user()->level == 2)
                                    @else
                                        <button id="klik_kemas" type="button" class="btn btn-success"
                                            data-toggle="modal">Edit</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection
