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
                        @if (Auth::user()->level != 2)
                            <div class="card">
                                <div class="table-responsive-lg">
                                    <form action="tambah_periksaruang" method="post" id="forminput">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="card-header mb-4" id='headertglx'></div>
                                                @csrf
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            </div>
                                            <table class="table">
                                                <thead>

                                                    <tr>
                                                        <th scope="col" style="width:5%" class="text-center">No</th>
                                                        <th scope="col">Nama Ruangan</th>
                                                        <th scope="col">No Prosedur</th>
                                                        <th scope="col">Tanggal</th>
                                                        <th scope="col">Cara Pembersihan</th>
                                                        {{-- <th scope="col" style="width:47%;padding-left:5%;">Item yang
                                                    Dibersihkan
                                                </th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td scope="col" class="text-center">1</td>
                                                    <td scope="col" class="text-center">
                                                        <div class="form-group row">
                                                            <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu</label> -->
                                                            <div class="col-sm">
                                                                <input class="form-control" type='text'
                                                                    placeholder="Ruangan" style="height: 35px;"
                                                                    name="nama_ruangan" id="inlineFormCustomSelect">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td scope="col" class="text-center">
                                                        <div class="form-group row">
                                                            <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu</label> -->
                                                            <div class="col-sm">
                                                                <input class="form-control" type='text'
                                                                    placeholder="No. Prosedur" style="height: 35px;"
                                                                    name="nomer_prosedur" id="inlineFormCustomSelect">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="tanggal" class="form-control ">
                                                    </td>
                                                    <td scope="col" class="text-center">
                                                        <div class="form-group row">
                                                            <!-- <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu</label> -->
                                                            <div class="col-sm">
                                                                <input class="form-control" type='text'
                                                                    placeholder="Cara pembersihan" 
                                                                    name="cara_pembersihan" id="inlineFormCustomSelect">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td scope="col" class="justify-content-center"></td>
                                                </tbody>
                                            </table>
                                            <div class="col-lg-12 d-flex justify-content-center">
                                                <a class="btn btn-primary" onclick="salert()" href="#"
                                                    style="float:left;  margin-left:25px" role="button">Tambah Catatan
                                                    Kebersihan Ruangan</a>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                    <table class="table" style="margin-top: 50px" id="tabel1">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No. Prosedur</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Ruangan</th>
                                <th scope="col">Cara pembersihan</th>
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
                                    <td>{{ \Carbon\Carbon::parse($row['tanggal_prosedur'])->format('j F, Y') }}</td>
                                    <td>{{ $row['nama_ruangan'] }}</td>
                                    <td>{{ $row['cara_pembersihan'] }}</td>
                                    <td>
                                        @if ($row['status'] == 0)
                                            Diajukan
                                        @else
                                            Diterima
                                        @endif
                                    </td>
                                    <td>


                                        @if (Auth::user()->level != 2)
                                            @if ($row['status'] == 0)
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"
                                                        value="{{ $row['id_periksaruang'] }}" />
                                                    <input type="hidden" name="nama_ruangan"
                                                        value="{{ $row['nama_ruangan'] }}" />
                                                    <input type="hidden" name="pelaksana" value="{{ $row->user_id }}" />
                                                    <input type="hidden" name="status" value="0" />
                                                    <button type="submit" class="btn btn-primary"> Lihat</button>
                                                </form>
                                                <form method="post" action="detilruangan" class="float-left mr-2" id="detilruangan{{ $row['id_periksaruang'] }}">
                                                    @csrf
                                                    <input type="hidden" value="{{ $row['nomer_prosedur'] }}" name="nomer_prosedur">
                                                    <input type="hidden" value="{{ $row['tanggal_prosedur'] }}" name="tanggal_prosedur">
                                                    <input type="hidden" value="{{ $row['nama_ruangan'] }}" name="nama_ruangan">
                                                    <input type="hidden" value="{{ $row['cara_pembersihan'] }}" name="cara_pembersihan">
                                                    <button type="button" class="btn btn-success"
                                                        onclick="buttonModalEdit({{ $row['id_periksaruang'] }})">
                                                        Edit</button>
                                                </form>
                                            @else
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"
                                                        value="{{ $row['id_periksaruang'] }}" />
                                                    <input type="hidden" name="nama_ruangan"
                                                        value="{{ $row['nama_ruangan'] }}" />
                                                    <input type="hidden" name="pelaksana" value="{{ $row->user_id }}" />
                                                    <input type="hidden" name="status" value="1" />
                                                    <button type="submit" class="btn btn-primary"> Lihat</button>
                                                </form>
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"
                                                        value="{{ $row['id_periksaruang'] }}" />

                                                    <button type="submit" class="btn btn-danger disabled"> Edit</button>
                                                </form>
                                            @endif
                                        @else
                                            @if ($row['status'] == 0)
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"
                                                        value="{{ $row['id_periksaruang'] }}" />
                                                    <input type="hidden" name="nama_ruangan"
                                                        value="{{ $row['nama_ruangan'] }}" />
                                                    <input type="hidden" name="pelaksana" value="{{ $row->user_id }}" />
                                                    <input type="hidden" name="status" value="0" />
                                                    <button type="submit" class="btn btn-success"> Lihat</button>
                                                </form>
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"
                                                        value="{{ $row['id_periksaruang'] }}" />
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="buttonModalTerima({{ $row['id_periksaruang'] }})">
                                                        Terima</button>
                                                </form>
                                            @else
                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"
                                                        value="{{ $row['id_periksaruang'] }}" />
                                                    <input type="hidden" name="nama_ruangan"
                                                        value="{{ $row['nama_ruangan'] }}" />
                                                    <input type="hidden" name="pelaksana" value="{{ $row->user_id }}" />
                                                    <input type="hidden" name="status" value="1" />
                                                    <button type="submit" class="btn btn-success"> Lihat</button>
                                                </form>

                                                <form method="post" action="detilruangan" class="float-left mr-2">
                                                    @csrf
                                                    <input type="hidden" name="id_ruangan"
                                                        value="{{ $row['id_periksaruang'] }}" />
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
                            Edit Pemeriksaan Ruang
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form method="post" action="edit_periksaruang" id=''>
                            <div class="card mb-4">
                                <div class="card-header" id='headertgl'></div>
                                @csrf
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Pemeriksaan Ruang
                                    </div>
                                    <div class="card-body">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="id_ruangan" id="modalid_ruangan"
                                            class="form-control" placeholder="" />
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Ruangan</label>
                                            <div class="col-sm">
                                                <input class="form-control" type='text' placeholder="Ruangan" name="nama_ruangan" id="modalnama_ruangan">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">No. Prosedur</label>
                                            <div class="col-sm">
                                                <input class="form-control" type='text' placeholder="no. prosedur" name="nomer_prosedur" id="modalnomer_prosedur">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal</label>
                                            <div class="col-sm">
                                                <input class="form-control" type='date' name="tanggal_prosedur" id="modaltanggal_prosedur">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Cara Pembersihan</label>
                                            <div class="col-sm">
                                                <input class="form-control" type='text' name="cara_pembersihan" id="modalcara_pembersihan">
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
                // console.log(p);

                $('#ModalTambahKaryawan').modal('show');
                $("#id_periksaruangmodal").val(p);
            }


            function buttonModalEdit(p) {
                $('#formeditdetil').modal('show');
                // var lantai = $(this).data('lantai');
                $idform = 'detilruangan' + p;

            
                var nama_ruangan = $('#' + $idform + '').find('input[name="nama_ruangan"]').val();
                var nomer_prosedur = $('#' + $idform + '').find('input[name="nomer_prosedur"]').val();
                var tanggal_prosedur = $('#' + $idform + '').find('input[name="tanggal_prosedur"]').val();
                var cara_pembersihan = $('#' + $idform + '').find('input[name="cara_pembersihan"]').val();
                
                // console.log(nama_ruangan);
                // console.log(nomer_prosedur);
                // console.log(tanggal_prosedur);
                // console.log(cara_pembersihan);
                var date = new Date(tanggal_prosedur);
                const formatYmd = new Date(tanggal_prosedur).toISOString().slice(0, 10);
                $('#modalid_ruangan').val(p);
                $('#modalnama_ruangan').val(nama_ruangan);
                $('#modalnomer_prosedur').val(nomer_prosedur);
                $('#modaltanggal_prosedur').val(formatYmd);
                $('#modalcara_pembersihan').val(cara_pembersihan);
            }
        </script>
    </main>
@endsection
