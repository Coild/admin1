@extends('layout.app')
@section('title')
    <title>Detail Periksa Ruang</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Detail Pemeriksaan Ruang</h1>
            <ol class="breadcrumb mb-4">Pemeriksaan Ruang</li>
            </ol>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm"
                                onclick="setdatetoday()">
                                Tambah Pemeriksaan Ruang
                            </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Detail Pemeriksaan Ruang
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_periksaruang" id='forminput'>
                                            <div class="card mb-4">
                                                <div class="card-header" id='headertgl'></div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <i class="fas fa-table me-1"></i>
                                                        Pemeriksaan Ruang
                                                    </div>
                                                    <div class="card-body">
                                                        @csrf
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                        <input type="hidden" name="tanggal" id='ambil_tanggal'
                                                            class="form-control" placeholder="" />
                                                        <input type="hidden" name="id_ruangan" id='id_ruangan'
                                                            class="form-control" value=""
                                                            placeholder="" />
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Ruangan</label>
                                                            <div class="col-sm">
                                                                <input class="form-control" type='text' readonly
                                                                    placeholder="Ruangan" style="height: 35px;"
                                                                    value="
                                                                    name="nama_ruangan" id="inlineFormCustomSelect">
                                                                </input>
                                                            </div>
                                                        </div>

                                                        <div style="padding-left:10%;" class="form-group row">
                                                            <div class="col-sm-6">Lantai</div>
                                                            <div class="col-sm-6">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="hidden" name='lantai' value="Belum">
                                                                    <input type="checkbox" name="lantai"
                                                                        class="custom-control-input" value="Sudah"
                                                                        id="customSwitch1">
                                                                    <label class="custom-control-label"
                                                                        for="customSwitch1">Sudah</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="padding-left:10%;" class="form-group row">
                                                            <div class="col-sm-6">Dinding</div>
                                                            <div class="col-sm-6">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="hidden" name='dinding' value="Belum">
                                                                    <input type="checkbox" name="dinding"
                                                                        class="custom-control-input" value="Sudah"
                                                                        id="customSwitch2">
                                                                    <label class="custom-control-label"
                                                                        for="customSwitch2">Sudah</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="padding-left:10%;" class="form-group row">
                                                            <div class="col-sm-6">Meja</div>
                                                            <div class="col-sm-5">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="hidden" name='meja' value="Belum">
                                                                    <input type="checkbox" name="meja"
                                                                        class="custom-control-input" value="Sudah"
                                                                        id="customSwitch3">
                                                                    <label class="custom-control-label"
                                                                        for="customSwitch3">Sudah</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="padding-left:10%;" class="form-group row">
                                                            <div class="col-sm-6">Jendela</div>
                                                            <div class="col-sm-6">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="hidden" name='jendela' value="Belum">
                                                                    <input type="checkbox" name="jendela"
                                                                        class="custom-control-input" value="Sudah"
                                                                        id="customSwitch4">
                                                                    <label class="custom-control-label"
                                                                        for="customSwitch4">Sudah</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="padding-left:10%;" class="form-group row">
                                                            <div class="col-sm-6">Langit-langit/
                                                                Plafon</div>
                                                            <div class="col-sm-6">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="hidden" name='langit' value="Belum">
                                                                    <input type="checkbox" name="langit"
                                                                        class="custom-control-input" value="Sudah"
                                                                        id="customSwitch5">
                                                                    <label class="custom-control-label"
                                                                        for="customSwitch5">Sudah</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div style="padding-left:10%;" class="form-group row">
                                                            <div class="col-sm-6">Kontainer</div>
                                                            <div class="col-sm-6">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="hidden" name='kontainer' value="Belum">
                                                                    <input type="checkbox" name="kontainer"
                                                                        class="custom-control-input" value="Sudah"
                                                                        id="customSwitch6">
                                                                    <label class="custom-control-label"
                                                                        for="customSwitch6">Sudah</label>
                                                                </div>
                                                            </div>
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

                    <table class="table mt-5" style="text-align: center;" id="tabel2">
                        <thead>
                            <tr>
                                <th scope="col" rowspan="3">No</th>
                                <th scope="col" rowspan="3" >Nama Ruangan</th>
                                <th scope="col" colspan="8">Bagian yang dibersihkan</th>
                                <th scope="col" rowspan="3">Pelaksana</th>
                                <th scope="col" rowspan="3">Diperiksa oleh</th>
                                <th scope="col" rowspan="3">Keterangan</th>
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
{{-- 
                            @foreach ($data as $row)
                                <tr>
                                    <td > {{$loop->iteration}} </td>
                                    <td > nama ruanga </td>
                                    <td > nama ruanga </td>
                                </tr>
                            @endforeach --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
    </script>
@endsection
