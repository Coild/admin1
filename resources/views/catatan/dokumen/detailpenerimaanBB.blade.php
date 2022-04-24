
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

                    <!-- Modal barang masuk-->
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
                                                <input type="text" class="form-control 1" name="no_kontrol" placeholder="Nomor Kontrol" />
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
                    <table id="dataTable" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">No Loth</th>
                                <th scope="col">Pemasok</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">No. Control</th>
                                <th scope="col">Tgl. Kadaluarsa</th>
                                @if(Auth::user()->level!=2)
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data1 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_bahan'] }}</td>
                                <td>{{ $row['no_loth'] }}</td>
                                <td>{{ $row['pemasok'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['no_kontrol'] }}</td>
                                <td>{{ $row['kedaluwarsa'] }}</td>
                                @if(Auth::user()->level!=2)
                                <td>
                                        <button data-toggle="modal" data-target="#editbahanmasuk" class="btn btn-primary">Edit</button>
                                </td>
                                @endif
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

                    <!-- Modal bahan keluar -->
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
                    <table id="dataTable1" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Untuk Produk</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sisa</th>
                                @if(Auth::user()->level!=2)
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data2 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_bahan'] }}</td>
                                <td>{{ $row['untuk_produk'] }}</td>
                                <td>{{ $row['no_batch'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['sisa'] }}</td>
                                @if(Auth::user()->level!=2)
                                <td>
                                        <button type="button" data-toggle="modal" data-target="#editbahanmasuk" class="btn btn-primary">Edit</button>
                                </td>
                                @endif
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

                    <!-- Modal Produk masuk -->
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
                                                Dengan PROTAP
                                                No</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 3" placeholder="Nomor PROTAP" name='pob_no'>
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
                                                <input type="text" class="form-control 3" name="no_kontrol" placeholder="Nomor Kontrol" />
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
                    <table id="dataTable2" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk Jadi</th>
                                <th scope="col">No Loth</th>
                                <th scope="col">Pemasok</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">No. Control</th>
                                <th scope="col">Tgl. Kadaluarsa</th>
                                @if(Auth::user()->level!=2)
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data1 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_produkjadi'] }}</td>
                                <td>{{ $row['no_loth'] }}</td>
                                <td>{{ $row['pemasok'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['no_kontrol'] }}</td>
                                <td>{{ $row['kedaluwarsa'] }}</td>
                                @if(Auth::user()->level!=2)
                                <td>
                                        <button type="submit" data-toggle="modal" data-target="#editprodukmasuk" class="btn btn-primary">Edit</button>
                                </td>
                                @endif
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

                    <!-- Modal produk keluar-->
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
                    <table id="dataTable3" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Untuk Produk</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sisa</th>
                                @if(Auth::user()->level!=2)
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data2 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_produk'] }}</td>
                                <td>{{ $row['untuk_produk'] }}</td>
                                <td>{{ $row['no_batch'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['sisa'] }}</td>
                                @if(Auth::user()->level!=2)
                                <td>

                                        <button type="submit" data-toggle="modal" data-target="#editprodukkeluar" class="btn btn-primary">Edit</button>

                                </td>
                                @endif
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

                    <!-- Modal kemasan masuk -->
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
                                                Dengan PROTAP
                                                No</label>
                                            <div class="col-sm">
                                                <input type="text" class="form-control 5" placeholder="Nomor PROTAP" name='pob_no'>
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
                                                <input type="text" class="form-control 5" name="no_kontrol" placeholder="Nomor Kontrol" />
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
                    <table id="dataTable4" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk Jadi</th>
                                <th scope="col">No Loth</th>
                                <th scope="col">Pemasok</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">No. Control</th>
                                <th scope="col">Tgl. Kadaluarsa</th>
                                @if(Auth::user()->level!=2)
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data1 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_bahan'] }}</td>
                                <td>{{ $row['no_loth'] }}</td>
                                <td>{{ $row['pemasok'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['no_kontrol'] }}</td>
                                <td>{{ $row['kedaluwarsa'] }}</td>
                                @if(Auth::user()->level!=2)
                                <td>
                                        <button type="submit" data-toggle="modal" data-target="#editkemasanmasuk" class="btn btn-primary">Edit</button>

                                </td>
                                @endif
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

                    <!-- Modal Kemasan Keluar-->
                    <div class="modal fade" id="modalForm6" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Kemasan Keluar</h4>
                                </div>

                                <!-- Modal Body-->
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
                    <table id="dataTable5" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Untuk Produk</th>
                                <th scope="col">No Batch</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Sisa</th>
                                @if(Auth::user()->level!=2)
                                <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data2 as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['nama_kemasan'] }}</td>
                                <td>{{ $row['untuk_produk'] }}</td>
                                <td>{{ $row['no_batch'] }}</td>
                                <td>{{ $row['jumlah'] }}</td>
                                <td>{{ $row['sisa'] }}</td>
                                @if(Auth::user()->level!=2)
                                <td>
                                        <button type="submit" data-toggle="modal" data-target="#editkemasankeluar" class="btn btn-primary">Edit</button>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        @endif
    </div>
    {{-- Modal --}}
<!-- Modal barang masuk-->
<div class="modal fade" id="editbahanmasuk" role="dialog">
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
                            <input type="text" class="form-control 7" placeholder="Nama Bahan Baku" name="nama_bahanbaku">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                            Dengan PROTAP
                            No</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 7" placeholder="Nomor PROTAP" name='pob_no'>
                        </div>
                    </div>
                    <input type="hidden" name="tanggal" id='ambil_tanggal1' class="form-control 7" placeholder="" />
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Loth</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 7" name="no_loth" placeholder="Nomor Loth" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Pemasok</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 7" name="pemasok" placeholder="Pemasok" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm"><input type="text" class="form-control 7" name="jumlah" placeholder="Jumlah" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Kontrol</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 7" name="no_kontrol" placeholder="Nomor Kontrol" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputEmail3">Tanggal
                            Kadaluarsa</label>
                        <div class="col-sm">
                            <input type="date" name="kedaluwarsa" class="form-control 7" />
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(7)">Tambah</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal bahan keluar -->
<div class="modal fade" id="editbahankeluar" role="dialog">
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
                            <input type="text" class="form-control 8" placeholder="Nama Bahan Baku" name="nama_bahanbaku">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                            Produk</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 8" placeholder="Untuk Produk" name="untuk_produk">
                        </div>
                    </div>
                    <input type="hidden" name="tanggal" id='ambil_tanggal2' class="form-control 8" placeholder="" />
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Batch</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 8" name="no_batch" placeholder="Nomor Batch" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm"><input type="text" class="form-control 8" name="jumlah" placeholder="Jumlah" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Sisa</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 8" name="sisa" placeholder="Sisa" />
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(8)">Tambah</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Produk masuk -->
<div class="modal fade" id="editprodukmasuk" role="dialog">
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
                            <input type="text" class="form-control 9" placeholder="Nama Produk Jadi" name="nama_produkjadi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                            Dengan PROTAP
                            No</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 9" placeholder="Nomor PROTAP" name='pob_no'>
                        </div>
                    </div>
                    <input type="hidden" name="tanggal" id='ambil_tanggal3' class="form-control 9" placeholder="" />
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Loth</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 9" name="no_loth" placeholder="Nomor Loth" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Pemasok</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 9" name="pemasok" placeholder="Pemasok" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm"><input type="text" class="form-control 9" name="jumlah" placeholder="Jumlah" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Kontrol</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 9" name="no_kontrol" placeholder="Nomor Kontrol" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputEmail3">Tanggal
                            Kadaluarsa</label>
                        <div class="col-sm">
                            <input type="date" name="kedaluwarsa" class="form-control 9" />
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(9)">Tambah</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal produk keluar-->
<div class="modal fade" id="editprodukkeluar" role="dialog">
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
                            <input type="text" class="form-control 10" placeholder="Nama Produk Jadi" name="nama_produk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                            Produk</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 10" placeholder="Untuk Produk" name="untuk_produk">
                        </div>
                    </div>
                    <input type="hidden" name="tanggal" id='ambil_tanggal4' class="form-control 10" placeholder="" />
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Batch</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 10" name="no_batch" placeholder="Nomor Batch" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm"><input type="text" class="form-control 10" name="jumlah" placeholder="Jumlah" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Sisa</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 10" name="sisa" placeholder="Sisa" />
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(10)">Tambah</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal kemasan masuk -->
<div class="modal fade" id="editkemasanmasuk" role="dialog">
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
                            <input type="text" class="form-control 11" placeholder="Nama Produk Jadi" name="nama_kemasan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                            Dengan PROTAP
                            No</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 11" placeholder="Nomor PROTAP" name='pob_no'>
                        </div>
                    </div>
                    <input type="hidden" name="tanggal" id='ambil_tanggal5' class="form-control 11" placeholder="" />
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Loth</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 11" name="no_loth" placeholder="Nomor Loth" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Pemasok</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 11" name="pemasok" placeholder="Pemasok" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm"><input type="text" class="form-control 11" name="jumlah" placeholder="Jumlah" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Kontrol</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 11" name="no_kontrol" placeholder="Nomor Kontrol" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="inputEmail3">Tanggal
                            Kadaluarsa</label>
                        <div class="col-sm">
                            <input type="date" name="kedaluwarsa" class="form-control 11" />
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(11)">Tambah</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Kemasan Keluar-->
<div class="modal fade" id="editkemasankeuar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Kemasan Keluar</h4>
            </div>

            <!-- Modal Body-->
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
                            <input type="text" class="form-control 12" placeholder="Nama Kemasan" name="nama_kemasan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                            Produk</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 12" placeholder="Untuk Produk" name="untuk_produk">
                        </div>
                    </div>
                    <input type="hidden" name="tanggal" id='ambil_tanggal6' class="form-control 12" placeholder="" />
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Nomer
                            Batch</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 12" name="no_batch" placeholder="Nomor Batch" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm"><input type="text" class="form-control 12" name="jumlah" placeholder="Jumlah" /></div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Sisa</label>
                        <div class="col-sm">
                            <input type="text" class="form-control 12" name="sisa" placeholder="Sisa" />
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(12)">Tambah</button>
            </div>
        </div>
    </div>
</div>
{{-- end modal --}}
</main>


<script>
    $(document).ready(function() {
            $('#dataTable').DataTable()
            $('#dataTable1').DataTable()
            $('#dataTable2').DataTable()
            $('#dataTable3').DataTable()
            $('#dataTable4').DataTable()
            $('#dataTable5').DataTable()
        })
</script>
@endsection
