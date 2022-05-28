@extends('layout.app')
@section('title')
    <title>
        Detail Periksa Ruang</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Detail Pemeriksaan Ruang</h1>
            <ol class="breadcrumb mb-4">{{ $nama_ruangan }}</li>
            </ol>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg @if($status == 1) disabled @endif" data-toggle="modal" data-target="#modalForm"
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
                                            Tambah Detail Pemeriksaan Ruang
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_detilperiksaruang" id='forminput'>
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
                                                        {{-- <input type="hidden" name="tanggal" id='ambil_tanggal'
                                                            class="form-control" placeholder="" /> --}}
                                                        <input type="hidden" name="id_induk" value='{{ $id_ruangan }}'
                                                            class="form-control" value="" placeholder="" />
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Ruangan</label>
                                                            <div class="col-sm">
                                                                <input class="form-control" type='text' readonly
                                                                    placeholder="Ruangan" style="height: 35px;"
                                                                    value="{{ $nama_ruangan }}"
                                                                    id="inlineFormCustomSelect">
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
                                                        {{-- <div style="padding-left:10%;" class="form-group row">
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
                                                        </div> --}}


                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Diperiksa Oleh</label>
                                                            <div class="col-sm">
                                                                <input class="form-control" type='text'
                                                                    placeholder="diperiksa oleh" style="height: 35px;"
                                                                    id="inlineFormCustomSelect" name="diperiksa_oleh">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Keterangan</label>
                                                            <div class="col-sm">
                                                                <input class="form-control" type='text'
                                                                    placeholder="Ruangan" style="height: 35px;"
                                                                    name="keterangan" id="inlineFormCustomSelect">
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
                                {{-- <th scope="col" rowspan="3" >Nama Ruangan</th> --}}
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
                            @foreach ($data as $row)
                                <tr>
                                    <td> {{ $loop->iteration }} </td>
                                    <td>
                                        @if ($row['lantai'] != null)
                                            {{ \Carbon\Carbon::parse($row['lantai'])->format('j F, Y') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['lantai'] != null)
                                            {{ \Carbon\Carbon::parse($row['lantai'])->format('h:i:s A') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['meja'] != null)
                                            {{ \Carbon\Carbon::parse($row['meja'])->format('j F, Y') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['meja'] != null)
                                            {{ \Carbon\Carbon::parse($row['meja'])->format('h:i:s A') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['jendela'] != null)
                                            {{ \Carbon\Carbon::parse($row['jendela'])->format('j F, Y') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['jendela'] != null)
                                            {{ \Carbon\Carbon::parse($row['jendela'])->format('h:i:s A') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['langit'] != null)
                                            {{ \Carbon\Carbon::parse($row['langit'])->format('j F, Y') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['langit'] != null)
                                            {{ \Carbon\Carbon::parse($row['langit'])->format('h:i:s A') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td> {{ $pelaksana }} </td>
                                    <td> {{ $row['diperiksa_oleh'] }} </td>
                                    <td> {{ $row['keterangan'] }} </td>
                                    <td>
                                        @if (Auth::user()->level != 2)
                                            @if ($status == 0)
                                                <form method="post" action="detilruangan" class="float-left mr-2"
                                                    id="detilruangan{{ $row['id'] }}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $row['lantai'] }}" name="lantai">
                                                    <input type="hidden" value="{{ $row['meja'] }}" name="meja">
                                                    <input type="hidden" value="{{ $row['jendela'] }}" name="jendela">
                                                    <input type="hidden" value="{{ $row['langit'] }}" name="langit">
                                                    <input type="hidden" value="{{ $row['id'] }}" name="id_ruangan">
                                                    <input type="hidden" value="{{ $row['diperiksa_oleh'] }}"
                                                        name="diperiksa_oleh">
                                                    <input type="hidden" value="{{ $row['keterangan'] }}"
                                                        name="keterangan">

                                                    <button type="button"
                                                        onclick="buttonModalFormDetil({{ $row['id'] }})"
                                                        class="btn btn-primary"> Edit</button>
                                                </form>
                                            @else
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger disabled"> Edit</button>
                                                </form>
                                            @endif
                                        @else
                                            @if ($status == 0)
                                                <form method="post" action="detilruangan" class="float-left mr-2"
                                                    id="detilruangan{{ $row['id'] }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="0" />
                                                    <input type="hidden" value="{{ $row['lantai'] }}" name="lantai">
                                                    <input type="hidden" value="{{ $row['meja'] }}" name="meja">
                                                    <input type="hidden" value="{{ $row['jendela'] }}" name="jendela">
                                                    <input type="hidden" value="{{ $row['langit'] }}" name="langit">
                                                    <input type="hidden" value="{{ $row['id'] }}" name="id_ruangan">
                                                    <input type="hidden" value="{{ $row['diperiksa_oleh'] }}"
                                                        name="diperiksa_oleh">
                                                    <input type="hidden" value="{{ $row['keterangan'] }}"
                                                        name="keterangan">

                                                    <button type="button"
                                                        onclick="buttonModalFormDetil({{ $row['id'] }})"
                                                        class="btn btn-primary disabled"> Edit</button>
                                                </form>
                                            @else
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"
                                                        value="{{ $row['id_periksaruang'] }}" />
                                                    <button type="submit" class="btn btn-danger disabled"> Edit</button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    @if (Auth::user()->level == 2)
                    <div style="text-align: center;">
                        <button type="button" class="btn btn-primary btn-lg mt-5 @if ($status == 1) disabled @endif" onclick="buttonModalTerima({{ $id_ruangan }})">
                            Terima</button>
                    </div>
                        
                    @endif
                </div>
            </div>
        </div>


        <div class="modal fade" id="ModalTambahKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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

                                {{-- <div class="form-floating mb-3">
                                <input class="form-control" name="diperiksaoleh" id="username" type="text"
                                    placeholder="Diperiksa oleh" required/>
                                <label for="inputEmail">Diperiksa oleh</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input class="form-control" name="keterangan" id="username" type="text"
                                    placeholder="keterangan" required/>
                                <label for="inputEmail">Keterangan</label>
                            </div> --}}

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


        <!-- Modal -->
        <div class="modal fade" id="formeditdetil" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Edit Detail Pemeriksaan Ruang
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form method="post" action="edit_detilperiksaruang" id=''>
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
                                        <input type="hidden" name="id_ruangan" id="idRuanganEditModal"
                                            class="form-control" placeholder="" />
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                            <div class="col-sm">
                                                <input class="form-control" type='text' readonly placeholder="Ruangan"
                                                    style="height: 35px;" value="{{ $nama_ruangan }}"
                                                    id="inlineFormCustomSelect">
                                            </div>
                                        </div>

                                        <div style="padding-left:10%;" class="form-group row">
                                            <div class="col-sm-6">Lantai</div>
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name='lantai' value="Belum">
                                                    <input type="checkbox" name="lantai" class="custom-control-input"
                                                        value="Sudah" id="lantaiEditModal">
                                                    <label class="custom-control-label" for="lantaiEditModal">Sudah</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="padding-left:10%;" class="form-group row">
                                            <div class="col-sm-6">Meja</div>
                                            <div class="col-sm-5">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name='meja' value="Belum">
                                                    <input type="checkbox" name="meja" class="custom-control-input"
                                                        value="Sudah" id="mejaEditModal">
                                                    <label class="custom-control-label" for="mejaEditModal">Sudah</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="padding-left:10%;" class="form-group row">
                                            <div class="col-sm-6">Jendela</div>
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name='jendela' value="Belum">
                                                    <input type="checkbox" name="jendela" class="custom-control-input"
                                                        value="Sudah" id="jendelaEditModal">
                                                    <label class="custom-control-label"
                                                        for="jendelaEditModal">Sudah</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="padding-left:10%;" class="form-group row">
                                            <div class="col-sm-6">Langit-langit/
                                                Plafon</div>
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-switch">
                                                    <input type="hidden" name='langit' value="Belum">
                                                    <input type="checkbox" name="langit" class="custom-control-input"
                                                        value="Sudah" id="langitEditModal">
                                                    <label class="custom-control-label" for="langitEditModal">Sudah</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Diperiksa Oleh</label>
                                            <div class="col-sm">
                                                <input class="form-control" type='text' placeholder="diperiksa oleh"
                                                    style="height: 35px;" id="diperiksaEditModal" name="diperiksa_oleh">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan</label>
                                            <div class="col-sm">
                                                <input class="form-control" type='text' placeholder="Ruangan"
                                                    style="height: 35px;" name="keterangan" id="keteranganEditModal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit"
                                    style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->



        <script>
            function buttonModalTerima(p) {
                // alert('ini'+p);
                console.log(p);

                $('#ModalTambahKaryawan').modal('show');
                $("#id_periksaruangmodal").val(p);
            }
        </script>


        <script>
            function buttonModalFormDetil(p) {
                $('#formeditdetil').modal('show');
                // var lantai = $(this).data('lantai');
                $idform = 'detilruangan' + p;

                var id = $('#' + $idform + '').find('input[name="id_ruangan"]').val();
                var lantai = $('#' + $idform + '').find('input[name="lantai"]').val();
                var meja = $('#' + $idform + '').find('input[name="meja"]').val();
                var jendela = $('#' + $idform + '').find('input[name="jendela"]').val();
                var langit = $('#' + $idform + '').find('input[name="langit"]').val();
                var diperiksa_oleh = $('#' + $idform + '').find('input[name="diperiksa_oleh"]').val();
                var keterangan = $('#' + $idform + '').find('input[name="keterangan"]').val();

                $('#idRuanganEditModal').val(id);
                $('#diperiksaEditModal').val(diperiksa_oleh);
                $('#keteranganEditModal').val(keterangan);

                if (lantai != '') {
                    // console.log('isi');
                    $('#lantaiEditModal').prop('checked', true);
                } else {
                    $('#lantaiEditModal').prop('checked', false);
                }

                if (meja != '') {
                    $('#mejaEditModal').prop('checked', true);
                } else {
                    $('#mejaEditModal').prop('checked', false);
                }

                if (jendela != '') {
                    $('#jendelaEditModal').prop('checked', true);
                } else {
                    $('#jendelaEditModal').prop('checked', false);
                }

                if (langit != '') {
                    $('#langitEditModal').prop('checked', true);
                } else {
                    $('#langitEditModal').prop('checked', false);
                }
            }
        </script>
    </main>
@endsection
