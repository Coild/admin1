@extends('layout.app')
@section('title')
    <title>Detail Pengoprasian Alat Utama</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>Catatan Pengoprasian Alat Utama</h1>
            <ol class="breadcrumb mb-4">Detail Pengoprasian Alat Utama</li>
            </ol>
            <div class="row">

                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            @if ($status == 0)
                                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm"
                                    onclick="setdatetoday()">
                                    Tambah Pengoprasian Alat Utama
                                </button>
                            @else
                                <button class="btn btn-success btn-lg disabled" data-toggle="modal" data-target="#modalForm"
                                    onclick="setdatetoday()">
                                    Tambah Pengoprasian Alat Utama
                                </button>
                            @endif
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Tambah Detail Pengoprasian Alat Utama
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_detilalat" id='forminput1'>
                                            <div class="card mb-4">
                                                <div class="card-header" id='headertgl'></div>
                                                @csrf
                                                <input type="hidden" name="id_alat" value="{{ $id_alat }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                <div class="card">
                                                    <div class="card-header">
                                                        <i class="fas fa-table me-1"></i>
                                                        Pemakaian
                                                    </div>
                                                    <div class="card-body">

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Mulai</label>
                                                            <div class="col-sm">
                                                                <input type="datetime-local" name="mulai_pemakaian"
                                                                    class="form-control 1" id="inputEmail3" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Selesai</label>
                                                            <div class="col-sm">
                                                                <input type="datetime-local" name="selesai_pemakaian"
                                                                    class="form-control 1" id="inputEmail3" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Produksi</label>
                                                            <div class="col-sm">
                                                                <input type="text" name="produksi" class="form-control 1"
                                                                    id="inputEmail3" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-3 col-form-label">No.
                                                                Batch</label>
                                                            <div class="col-sm">
                                                                <input type="text" name="no_batch" class="form-control 1"
                                                                    id="inputEmail3" placeholder="no batch..." />
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="card mb-4">
                                                    <div class="card-header">
                                                        <i class="fas fa-table me-1"></i>
                                                        Pembersihan
                                                    </div>
                                                    <div class="card-body">

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Mulai</label>
                                                            <div class="col-sm">
                                                                <input type="datetime-local" name="mulai_pembersihan"
                                                                    class="form-control 1" id="inputEmail3" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">selesai</label>
                                                            <div class="col-sm">
                                                                <input type="datetime-local" name="selesai_pembersihan"
                                                                    class="form-control 1" id="inputEmail3" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-3 col-form-label">Oleh</label>
                                                            <div class="col-sm">
                                                                <input type="text" name="diperiksa_oleh"
                                                                    class="form-control 1" id="inputEmail3"
                                                                    placeholder="Oleh..." />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3"
                                                        class="col-sm-3 col-form-label">Keterangan</label>
                                                    <div class="col-sm">
                                                        <input type="text" name="keterangan" class="form-control 1"
                                                            id="inputEmail3" placeholder="Keterangan" />
                                                    </div>
                                                </div>
                                                <a class="btn btn-primary" onclick="salert1(1)" href="#"
                                                    style="float:left; width: 100px;  margin-left:25px"
                                                    role="button">Simpan</a>
                                            </div>
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
                                <th scope="col" rowspan="3">No</th>
                                <th scope="col" colspan="6">Pemakaian</th>
                                <th scope="col" colspan="5">Pembersihan</th>
                                <th scope="col" rowspan="3">Keterangan</th>
                                <th scope="col" rowspan="3">Action</th>
                            </tr>
                            <tr>
                                <th scope="col" colspan="2">Mulai</th>
                                <th scope="col" rowspan="2">Produksi</th>
                                <th scope="col" rowspan="2">No. Batch</th>
                                <th scope="col" colspan="2">Selesai</th>
                                <th scope="col" rowspan="2">Oleh</th>
                                <th scope="col" colspan="2">Mulai</th>
                                <th scope="col" colspan="2">Selesai</th>
                            </tr>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <?php $i = 0;
                                $i++; ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($row['mulai_pemakaian'] != null)
                                            {{ \Carbon\Carbon::parse($row['mulai_pemakaian'])->format('j F, Y') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['mulai_pemakaian'] != null)
                                            {{ \Carbon\Carbon::parse($row['mulai_pemakaian'])->format('h:i:s A') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>{{ $row['produksi'] }}</td>
                                    <td>{{ $row['no_batch'] }}</td>
                                    <td>
                                        @if ($row['selesai_pemakaian'] != null)
                                            {{ \Carbon\Carbon::parse($row['selesai_pemakaian'])->format('j F, Y') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['selesai_pemakaian'] != null)
                                            {{ \Carbon\Carbon::parse($row['selesai_pemakaian'])->format('h:i:s A') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>{{ $row['diperiksa_oleh'] }}</td>
                                    <td>
                                        @if ($row['mulai_pembersihan'] != null)
                                            {{ \Carbon\Carbon::parse($row['mulai_pembersihan'])->format('j F, Y') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['mulai_pembersihan'] != null)
                                            {{ \Carbon\Carbon::parse($row['mulai_pembersihan'])->format('h:i:s A') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['selesai_pembersihan'] != null)
                                            {{ \Carbon\Carbon::parse($row['selesai_pembersihan'])->format('j F, Y') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row['selesai_pembersihan'] != null)
                                            {{ \Carbon\Carbon::parse($row['selesai_pembersihan'])->format('h:i:s A') }}
                                        @else
                                            <div class="badge badge-danger"> belum</div>
                                        @endif
                                    </td>
                                    <td>{{ $row['keterangan'] }}</td>
                                    <td>
                                        @if (Auth::user()->level != 2)
                                            @if ($status == 0)
                                            <form method="post" class="float-left mr-2"
                                                id="detilalat{{ $row['id_detilalat'] }}">
                                                @csrf
                                                <input type="hidden" value="{{ $row['mulai_pemakaian'] }}" name="mulai_pemakaian">
                                                <input type="hidden" value="{{ $row['selesai_pemakaian'] }}" name="selesai_pemakaian">
                                                <input type="hidden" value="{{ $row['produksi'] }}" name="produksi">
                                                <input type="hidden" value="{{ $row['no_batch'] }}" name="no_batch">
                                                <input type="hidden" value="{{ $row['diperiksa_oleh'] }}" name="diperiksa_oleh">
                                                <input type="hidden" value="{{ $row['mulai_pembersihan'] }}" name="mulai_pembersihan">
                                                <input type="hidden" value="{{ $row['selesai_pembersihan'] }}" name="selesai_pembersihan">
                                                <input type="hidden" value="{{ $row['keterangan'] }}" name="keterangan">
                                                <button type="button"
                                                    onclick="buttonModalFormDetil({{ $row['id_detilalat'] }})"
                                                    class="btn btn-primary"> Edit</button>
                                            </form>
                                            @else
                                                <button id="editdata" class="btn btn-danger disabled">Edit</button>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (Auth::user()->level == 2)
                    <div style="text-align: center;" >
                        <form method="post" action="terima_periksaalat" id="formTerimaLaporan{{ $id_alat }}">
                            @csrf
                            <input type="hidden" name="id_periksaalat"
                                value="{{ $id_alat }}" />
                            <button type="button" onclick="buttonTerimaLaporan({{ $id_alat }})" class="btn btn-primary btn-lg mt-5 @if ($status == 1) disabled @endif" >Terima</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="editalat" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Edit Pengoprasian Alat Utama
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form method="post" action="edit_detilalat" id='forminput2'>
                            <div class="card mb-4">
                                <div class="card-header" id='headertgl'></div>
                                @csrf
                                <input type="hidden" name="Modalid_detilalat" id="Modalid_detilalat" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Pemakaian
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Mulai</label>
                                            <div class="col-sm">
                                                <input type="datetime-local" name="mulai_pemakaian" class="form-control 2"
                                                    id="Modalmulai_pemakaian" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Selesai</label>
                                            <div class="col-sm">
                                                <input type="datetime-local" name="selesai_pemakaian" class="form-control 2"
                                                    id="Modalselesai_pemakaian" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Produksi</label>
                                            <div class="col-sm">
                                                <input type="text" name="produksi" class="form-control 2"
                                                    id="Modalproduksi" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">No.
                                                Batch</label>
                                            <div class="col-sm">
                                                <input type="text" name="no_batch" class="form-control 2" id="Modalno_batch"
                                                    placeholder="no batch..." />
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Pembersihan
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Mulai</label>
                                            <div class="col-sm">
                                                <input type="datetime-local" name="mulai_pembersihan"
                                                    class="form-control 2" id="Modalmulai_pembersihan" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">selesai</label>
                                            <div class="col-sm">
                                                <input type="datetime-local" name="selesai_pembersihan"
                                                    class="form-control 2" id="Modalselesai_pembersihan" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Oleh</label>
                                            <div class="col-sm">
                                                <input type="text" name="diperiksa_oleh" class="form-control 2"
                                                    id="Modaldiperiksa_oleh" placeholder="Oleh..." />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm">
                                        <input type="text" name="keterangan" class="form-control 2" id="Modalketerangan"
                                            placeholder="Keterangan" />
                                    </div>
                                </div>
                                <a class="btn btn-primary" onclick="salert1(2)" href="#"
                                    style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
    </main>


    <script>

            function buttonModalTerima(p) {
                $('#ModalTambahKaryawan').modal('show');
                $("#id_periksaalat").val(p);
            }

        function buttonModalFormDetil(p) {
                $('#editalat').modal('show');
                // var lantai = $(this).data('lantai');
                $idform = 'detilalat' + p;
                

                var mulai_pemakaian = $('#' + $idform + '').find('input[name="mulai_pemakaian"]').val();
                var selesai_pemakaian = $('#' + $idform + '').find('input[name="selesai_pemakaian"]').val();
                var produksi = $('#' + $idform + '').find('input[name="produksi"]').val();
                var no_batch = $('#' + $idform + '').find('input[name="no_batch"]').val();
                var diperiksa_oleh = $('#' + $idform + '').find('input[name="diperiksa_oleh"]').val();
                var mulai_pembersihan = $('#' + $idform + '').find('input[name="mulai_pembersihan"]').val();
                var selesai_pembersihan = $('#' + $idform + '').find('input[name="selesai_pembersihan"]').val();
                var keterangan = $('#' + $idform + '').find('input[name="keterangan"]').val();
                
                
                $('#Modalid_detilalat').val(p);
                $('#Modalmulai_pemakaian').val(new Date(mulai_pemakaian).toJSON().slice(0,19));
                $('#Modalselesai_pemakaian').val(new Date(selesai_pemakaian).toJSON().slice(0,19));
                $('#Modalproduksi').val(produksi);
                $('#Modalno_batch').val(no_batch);
                $('#Modaldiperiksa_oleh').val(diperiksa_oleh);
                $('#Modalmulai_pembersihan').val(new Date(mulai_pembersihan).toJSON().slice(0,19));
                $('#Modalselesai_pembersihan').val(new Date(selesai_pembersihan).toJSON().slice(0,19));
                $('#Modalketerangan').val(keterangan);
                
            }
    </script>
@endsection
