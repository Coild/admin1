@extends('layout.app')
@section('title')
    <title>Periksa Ruang</title>
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
                        Pembersihan Alat pada Ruangan
                    </div>
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
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
                            <form action="tambah_periksaruang" method="post" id="forminput">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="card-header mb-4" id='headertglx'></div>
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="tanggal" id='ambil_tanggalx' class="form-control"
                                            placeholder="" />
                                        {{-- <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu Pembersihan</label>
                                        <div class="col-sm-3">
                                            <select style="height: 35px;" class="form-control" name="waktu"
                                                id="inlineFormCustomSelect">
                                                <option selected>Choose...</option>
                                                <option value="Pagi">Pagi</option>
                                                <option value="Sore">Sore</option>
                                            </select>
                                        </div> --}}
                                    </div>
                                    <table class="table">
                                        <thead>

                                            <tr>
                                                <th scope="col" style="width:5%" class="text-center">No</th>
                                                <th scope="col" >Nama Ruangan</th>
                                                <th scope="col" >No Prosedur</th>
                                                <th scope="col" style="width:47%;padding-left:5%;">Item yang
                                                    Dibersihkan
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td scope="col" class="text-center">1</td>
                                            <td scope="col" class="text-center">
                                                <div class="form-group row">
                                                    <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu</label> -->
                                                    <div class="col-sm">
                                                        <input class="form-control" type='text' placeholder="Ruangan"
                                                            style="height: 35px;" name="nama_ruangan"
                                                            id="inlineFormCustomSelect">
                                                    </div>
                                                </div>
                                            </td>
                                            <td scope="col" class="text-center">
                                                <div class="form-group row">
                                                    <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu</label> -->
                                                    <div class="col-sm">
                                                        <input class="form-control" type='text' placeholder="No. Prosedur"
                                                            style="height: 35px;" name="nomer_prosedur"
                                                            id="inlineFormCustomSelect">
                                                    </div>
                                                </div>
                                            </td>
                                            <td scope="col">

                                                <div style="padding-left:10%;" class="form-group row">
                                                    <div class="col-sm-6">Lantai/Dinding</div>
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
                                                {{-- <div style="padding-left:10%;" class="form-group row">
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
                                                </div> --}}
                                                <div style="padding-left:10%;" class="form-group row">
                                                    <div class="col-sm-6">Meja</div>
                                                    <div class="col-sm-5">
                                                        <div class="custom-control custom-switch">
                                                            <input type="hidden" name='meja' value="Belum">
                                                            <input type="checkbox" name="meja" class="custom-control-input"
                                                                value="Sudah" id="customSwitch3">
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
                                                    <div class="col-sm-6">Langit-langit</div>
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


                                            </td>
                                            <td scope="col" class="justify-content-center"></td>
                                        </tbody>
                                    </table>
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <a class="btn btn-primary" onclick="salert()" href="#"
                                            style="float:left;  margin-left:25px" role="button">Tambah Catatan Kebersihan Ruangan</a>
                            </form>
                        </div>
                    </div>
                    <table class="table" style="margin-top: 50px" id="tabel1">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No. Prosedur</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data as $row)
                                <?php $i++; ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row['nomer_prosedur'] }}</td>
                                    <td>{{ $row['tanggal_prosedur'] }}</td>
                                    <td>{{ $row['nama_ruangan'] }}</td>
                                    {{-- <td>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Lantai: {{ $row['lantai'] }}</li>
                                            <li class="list-group-item">Dinding: {{ $row['dinding'] }}</li>
                                            <li class="list-group-item">Meja: {{ $row['meja'] }}</li>
                                            <li class="list-group-item">Jendela: {{ $row['jendela'] }}</li>
                                            <li class="list-group-item">Plafon: {{ $row['langit'] }}</li>
                                            <li class="list-group-item">Kontainer: {{ $row['kontainer'] }}</li>
                                        </ul>
                                    </td> --}}
                                    <td>
                                        @if ($row['status'] == 0)
                                            Diajukan
                                        @else
                                            Diterima
                                        @endif
                                    </td>
                                    <td>
                                        
                                        
                                        @if (Auth::user()->level == 2)
                                            @if ($row['status'] == 0)
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"  value="{{ $row['id_periksaruang'] }}" />
                                                    <button type="submit" class="btn btn-primary"> Lihat</button>
                                                </form>
                                            @else
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"  value="{{ $row['id_periksaruang'] }}" />
                                                    <button type="submit" class="btn btn-danger disabled"> Terima</button>
                                                </form>
                                            @endif
                                        @else
                                            @if ($row['status'] == 0)
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"  value="{{ $row['id_periksaruang'] }}" />
                                                    <button type="submit" class="btn btn-success"> Lihat</button>
                                                </form>
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"  value="{{ $row['id_periksaruang'] }}" />
                                                    <button type="button" class="btn btn-primary" onclick="buttonModalTerima({{ $row['id_periksaruang'] }})"> Terima</button>
                                                </form>
                                            @else
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"  value="{{ $row['id_periksaruang'] }}" />
                                                    <button type="submit" class="btn btn-danger disabled"> Terima</button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <!-- Modal -->
<div class="modal fade" id="ModalTambahKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Terima Laporan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <div class="card-body">
                <form action="/terimaperiksaruang" method="post" id='formModalTambahKaryawan'>
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" id="id_periksaruangmodal" name="id_periksaruang">
                    
                    <div class="form-floating mb-3">
                        <input class="form-control" name="diperiksaoleh" id="username" type="text"
                            placeholder="Diperiksa oleh" required/>
                        <label for="inputEmail">Diperiksa oleh</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input class="form-control" name="keterangan" id="username" type="text"
                            placeholder="keterangan" required/>
                        <label for="inputEmail">Keterangan</label>
                    </div>
                
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Terima</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <script>
        function buttonModalTerima(p) {
            // alert('ini'+p);
            // console.log(p);

            $('#ModalTambahKaryawan').modal('show');
            $("#id_periksaruangmodal").val(p);
        }
  </script>
    </main>
@endsection
