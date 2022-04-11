@extends('layout.app')
@section('title')
<title>Pengolahan Batches</title>
@endsection

@section('content')
<?php $isi = $jenis; ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Catatan Penerimaan Penyerahan dan Penyimpanan </h1>
        @if($isi == 1)
        <div class="row">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bahan Baku Masuk
                </div>
                <div class="card-body">

                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if(Auth::user()->level!=2)
                    <button class="btn btn-success btn-lg" onclick="setdatetoday1(1)" data-toggle="modal" data-target="#modalForm1">
                        Tambah Barang Masuk
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">

                                    <h4 class="modal-title" id="myModalLabel">Bahan Baku Masuk</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="card-header" id='headertgl1'>
                                    </div>
                                    <p class="statusMsg"></p>
                                    <form role="form" id="forminput1" action="{{url('tambah_penerimaanbbmasuk')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="induk" value="{{$induk}}">
                                        <input type="hidden" name="jenis" value="{{$jenis}}">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                Bahan Baku</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 1" placeholder="Nama Bahan Baku" name="nama_bahanbaku">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                                Dengan PROTAP
                                                No</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 1" placeholder="Nomor PROTAP" name='pob_no'>
                                            </div>
                                        </div>
                                        <input type="hidden" name="tanggal" id='ambil_tanggal1' class="form-control 1" placeholder="" />
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Loth</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 1" name="no_loth" placeholder="Nomor Loth" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Pemasok</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 1" name="pemasok" placeholder="Pemasok" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                                            <div class="col-sm"><input type="text" class="form-control 1" name="jumlah" placeholder="Jumlah" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Kontrol</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 1" name="no_kontrol" placeholder="Sisa" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="inputEmail3">Tanggal
                                                Kadaluarsa</label>
                                            <div class="col-sm">
                                                <input type="date" name="kedaluwarsa" class="form-control 1" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary submitBtn" onclick="salert1(1)">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">No Loth</th>
                                <th scope="col">Pemasok</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">No. Control</th>
                                <th scope="col">Tgl. Kadaluarsa</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data1 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_bahan'] }}</td>
                                <td>{{ $row['no_loth'] }}</td>
                                <td>{{ $row['pemasok'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['no_kontrol'] }}</td>
                                <td>{{ $row['kedaluwarsa'] }}</td>
                                <td>
                                    @if(Auth::user()->level!=2)
                                    <form method="post" action="">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{$row['no_loth']}}" />
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bahan Baku Keluar
                </div>
                <div class="card-body">

                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if(Auth::user()->level!=2)
                    <button class="btn btn-success btn-lg" onclick="setdatetoday1(2)" data-toggle="modal" data-target="#modalForm2">
                        Tambah Barang Keluar
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm2" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Bahan Baku Keluar</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="card-header" id='headertgl2'>
                                    </div>
                                    <p class="statusMsg"></p>
                                    <form role="form" id="forminput2" action="{{url('tambah_penerimaanbbkeluar')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="induk" value="{{$induk}}">
                                        <input type="hidden" name="jenis" value="{{$jenis}}">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                Bahan Baku</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 2" placeholder="Nama Bahan Baku" name="nama_bahanbaku">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                                Produk</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 2" placeholder="Untuk Produk" name="untuk_produk">
                                            </div>
                                        </div>
                                        <input type="hidden" name="tanggal" id='ambil_tanggal2' class="form-control 2" placeholder="" />
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Batch</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 2" name="no_batch" placeholder="Nomor Batch" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                                            <div class="col-sm"><input type="text" class="form-control 2" name="jumlah" placeholder="Jumlah" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Sisa</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 2" name="sisa" placeholder="Sisa" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary submitBtn" onclick="salert1(2)">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Untuk Produk</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sisa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data2 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_produk'] }}</td>
                                <td>{{ $row['untuk_produk'] }}</td>
                                <td>{{ $row['no_batch'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['sisa'] }}</td>
                                <td><?php if ($row['status'] == 0) {
                                        echo 'Diajukan';
                                    } ?></td>
                                <td>
                                    @if(Auth::user()->level!=2)
                                    <form method="post" action="#">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{$row['no_batch']}}" />
                                        <button type="button" class="btn btn-primary">Edit</button>
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
        @elseif ($isi == 2)
        <div class="row">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Produk Jadi Masuk
                </div>
                <div class="card-body">

                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if(Auth::user()->level!=2)
                    <button class="btn btn-success btn-lg" onclick="setdatetoday1(3)" data-toggle="modal" data-target="#modalForm3">
                        Produk Jadi Masuk
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm3" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">

                                    <h4 class="modal-title" id="myModalLabel">Produk Jadi Masuk</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="card-header" id='headertgl3'>
                                    </div>
                                    <p class="statusMsg"></p>
                                    <form role="form" id="forminput3" action="{{url('tambah_penerimaanprdukmasuk')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="induk" value="{{$induk}}">
                                        <input type="hidden" name="jenis" value="{{$jenis}}">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                Produk Jadi</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 3" placeholder="Nama Produk Jadi" name="nama_produkjadi">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                                Dengan POB
                                                No</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 3" placeholder="Nomor POB" name='pob_no'>
                                            </div>
                                        </div>
                                        <input type="hidden" name="tanggal" id='ambil_tanggal3' class="form-control 3" placeholder="" />
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Loth</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 3" name="no_loth" placeholder="Nomor Loth" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Pemasok</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 3" name="pemasok" placeholder="Pemasok" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                                            <div class="col-sm"><input type="text" class="form-control 3" name="jumlah" placeholder="Jumlah" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Kontrol</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 3" name="no_kontrol" placeholder="Sisa" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="inputEmail3">Tanggal
                                                Kadaluarsa</label>
                                            <div class="col-sm">
                                                <input type="date" name="kedaluwarsa" class="form-control 3" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary submitBtn" onclick="salert1(3)">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk Jadi</th>
                                <th scope="col">No Loth</th>
                                <th scope="col">Pemasok</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">No. Control</th>
                                <th scope="col">Tgl. Kadaluarsa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data1 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_bahan'] }}</td>
                                <td>{{ $row['no_loth'] }}</td>
                                <td>{{ $row['pemasok'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['no_kontrol'] }}</td>
                                <td>{{ $row['kedaluwarsa'] }}</td>
                                <td>
                                    @if(Auth::user()->level!=2)
                                    <form method="post" action="">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{$row['no_loth']}}" />
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Produk Jadi Keluar
                </div>
                <div class="card-body">

                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if(Auth::user()->level!=2)
                    <button class="btn btn-success btn-lg" onclick="setdatetoday1(4)" data-toggle="modal" data-target="#modalForm4">
                        Tambah Produk Keluar
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm4" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Produk Jadi Keluar</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="card-header" id='headertgl4'>
                                    </div>
                                    <p class="statusMsg"></p>
                                    <form role="form" id="forminput4" action="{{url('tambah_penerimaanprodukkeluar')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="induk" value="{{$induk}}">
                                        <input type="hidden" name="jenis" value="{{$jenis}}">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                Produk Jadi</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 4" placeholder="Nama Produk Jadi" name="nama_produk">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                                Produk</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 4" placeholder="Untuk Produk" name="untuk_produk">
                                            </div>
                                        </div>
                                        <input type="hidden" name="tanggal" id='ambil_tanggal4' class="form-control 4" placeholder="" />
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Batch</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 4" name="no_batch" placeholder="Nomor Batch" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                                            <div class="col-sm"><input type="text" class="form-control 4" name="jumlah" placeholder="Jumlah" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Sisa</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 4" name="sisa" placeholder="Sisa" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary submitBtn" onclick="salert1(4)">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Untuk Produk</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sisa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data2 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_produk'] }}</td>
                                <td>{{ $row['untuk_produk'] }}</td>
                                <td>{{ $row['no_batch'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['sisa'] }}</td>
                                <td><?php if ($row['status'] == 0) {
                                        echo 'Diajukan';
                                    } ?></td>
                                <td>
                                    @if(Auth::user()->level!=2)
                                    <form method="post" action="">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{$row['no_batch']}}" />
                                        <button type="submit" class="btn btn-primary">Edit</button>
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
        @else
        <div class="row">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Kemasan Masuk
                </div>
                <div class="card-body">

                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if(Auth::user()->level!=2)
                    <button class="btn btn-success btn-lg" onclick="setdatetoday1(5)" data-toggle="modal" data-target="#modalForm5">
                        Tambah Kemasan Masuk
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm5" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">

                                    <h4 class="modal-title" id="myModalLabel">Kemasan Masuk</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="card-header" id='headertgl5'>
                                    </div>
                                    <p class="statusMsg"></p>
                                    <form role="form" id="forminput5" action="{{url('tambah_penerimaakemasanmasuk')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="induk" value="{{$induk}}">
                                        <input type="hidden" name="jenis" value="{{$jenis}}">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                Kemasan</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 5" placeholder="Nama Produk Jadi" name="nama_kemasan">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                                Dengan POB
                                                No</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 5" placeholder="Nomor POB" name='pob_no'>
                                            </div>
                                        </div>
                                        <input type="hidden" name="tanggal" id='ambil_tanggal5' class="form-control 5" placeholder="" />
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Loth</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 5" name="no_loth" placeholder="Nomor Loth" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Pemasok</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 5" name="pemasok" placeholder="Pemasok" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                                            <div class="col-sm"><input type="text" class="form-control 5" name="jumlah" placeholder="Jumlah" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Kontrol</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 5" name="no_kontrol" placeholder="Sisa" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="inputEmail3">Tanggal
                                                Kadaluarsa</label>
                                            <div class="col-sm">
                                                <input type="date" name="kedaluwarsa" class="form-control 5" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary submitBtn" onclick="salert1(5)">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk Jadi</th>
                                <th scope="col">No Loth</th>
                                <th scope="col">Pemasok</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">No. Control</th>
                                <th scope="col">Tgl. Kadaluarsa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data1 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_bahan'] }}</td>
                                <td>{{ $row['no_loth'] }}</td>
                                <td>{{ $row['pemasok'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['no_kontrol'] }}</td>
                                <td>{{ $row['kedaluwarsa'] }}</td>
                                <td>
                                    @if(Auth::user()->level!=2)
                                    <form method="post" action="">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{$row['no_loth']}}" />
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Kemasan Keluar
                </div>
                <div class="card-body">

                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if(Auth::user()->level!=2)
                    <button class="btn btn-success btn-lg" onclick="setdatetoday1(6)" data-toggle="modal" data-target="#modalForm6">
                        Kemasan Keluar
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm6" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Kemasan Keluar</h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <div class="card-header" id='headertgl6'>
                                    </div>
                                    <p class="statusMsg"></p>
                                    <form role="form" id="forminput6" action="{{url('tambah_penerimaankemasankeluar')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <input type="hidden" name="induk" value="{{$induk}}">
                                        <input type="hidden" name="jenis" value="{{$jenis}}">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                Kemasan</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 6" placeholder="Nama Kemasan" name="nama_kemasan">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                                Produk</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 6" placeholder="Untuk Produk" name="untuk_produk">
                                            </div>
                                        </div>
                                        <input type="hidden" name="tanggal" id='ambil_tanggal6' class="form-control 6" placeholder="" />
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                                                Batch</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 6" name="no_batch" placeholder="Nomor Batch" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                                            <div class="col-sm"><input type="text" class="form-control 6" name="jumlah" placeholder="Jumlah" /></div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Sisa</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 6" name="sisa" placeholder="Sisa" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary submitBtn" onclick="salert1(6)">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- pop up end -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Untuk Produk</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sisa</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data2 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_kemasan'] }}</td>
                                <td>{{ $row['untuk_produk'] }}</td>
                                <td>{{ $row['no_batch'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['sisa'] }}</td>
                                <td><?php if ($row['status'] == 0) {
                                        echo 'Diajukan';
                                    } ?></td>
                                <td>
                                    @if(Auth::user()->level!=2)
                                    <form method="post" action="">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{$row['no_batch']}}" />
                                        <button type="submit" class="btn btn-primary">Edit</button>
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
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalForm" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Entry Batch
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form method="post" action="{{''}}" id='forminput'>
                        <div>

                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bagian Produksi
                            </div>

                            <div class="card-body">

                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="induk" value="{{$induk}}">
                                <input type="hidden" name="jenis" value="{{$jenis}}">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                        Dengan POB No</label>
                                    <div class="col-sm">
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
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kode
                                        Produk</label>
                                    <div class="col-sm">
                                        <select style="height: 35px;" class="form-control" name="kode_produk" id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>


                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                        Produk</label>
                                    <div class="col-sm">
                                        <select style="height: 35px;" class="form-control" name="nama_produk" id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nomor
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="no_batch" class="form-control" id="inputEmail3" placeholder="Nomor Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Besar
                                        Batch</label>
                                    <div class="col-sm">
                                        <input type="text" name="besar_batch" class="form-control" id="inputEmail3" placeholder="Besar Batch" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Bentuk
                                        Sediaan</label>
                                    <div class="col-sm">
                                        <input placeholder="Bentuk Sediaan" class="form-control" name="bentuk sediaan" type="text" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kategori</label>
                                    <div class="col-sm">
                                        <input placeholder="Kategori" class="form-control" name="kategori" type="text" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kemasan</label>
                                    <div class="col-sm">
                                        <select style="height: 35px;" name="kemasan" class="form-control" id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>
                                            <option value="1">Pot</option>
                                            <option value="2">Pouch</option>
                                            <option value="2">Sachet</option>
                                        </select>
                                    </div>
                                </div>



                            </div>
                            <a class="btn btn-primary" onclick="salert()" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
</main>
@endsection
