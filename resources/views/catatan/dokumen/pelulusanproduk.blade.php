@extends('layout.app')
@section('title')
<title>Pelulusan Produk Jadi</title>
@endsection
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1>Catatan Pelulusan Produk Jadi</h1>
        <ol class="breadcrumb mb-4">Pelulusan Produk Jadi</li>
        </ol>
        <div class="row">

            <div class="card mb-4">
                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if (Auth::user()->level != 2)
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm" onclick="setdatetoday()">
                        Tambah Pelulusan Produk Jadi
                    </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="modalForm" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Entry Pelulusan Produk Jadi
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form method="post" action="tambah_pelulusan" id='forminput7'>

                                        <div class="card-header">
                                            <i class="fas fa-table me-1"></i>
                                            Produk
                                        </div>
                                        <div class="card-header" id='headertgl'>
                                        </div>
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                                    Dengan PROTAP No</label>
                                                <div class="col-sm">
                                                    {{-- <input type="text" name="pob" class="form-control 7" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                                    <select name="protap" class="form-control 1">
                                                        @foreach ($protap as $isi)
                                                        <option value="{{$isi['protap_id']}}">{{$isi['protap_nama']}}</option>
                                                        @endforeach

                                                    </select>
                                                    <div id="error-box" style="color: red"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Produk</label>
                                                <div class="col-sm">
                                                    <input type="text" list="listbahanbaku" style="height: 35px;" id='nama_bahankau' class="form-control 7" name="nama_bahan" autocomplete="off">
                                                    </input>
                                                    <datalist id="listbahanbaku">
                                                        @foreach ($bahanbaku as $row)
                                                        <option value="{{ $row['bahanbaku_nama'] }}">
                                                            {{ $row['bahanbaku_nama'] }}
                                                        </option>
                                                        @endforeach
                                                    </datalist>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                                    Batch</label>
                                                <div class="col-sm">
                                                    <input type="text" name="nobatch" class="form-control 7" id="inputEmail3" placeholder="No Batch" maxlength="20"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Kedaluwarsa</label>
                                                <div class="col-sm">
                                                    <input type="date" name="kedaluwarsa" class="form-control 7" id="inputEmail3" placeholder="" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                    Pemasok</label>
                                                <div class="col-sm">
                                                    <input type="text" name="nama_pemasok" class="form-control 7" id="inputEmail3" placeholder="Nama Pemasok" />
                                                </div>
                                            </div>

                                            <input type="hidden" id='ambil_tanggal' class="form-control" name="tanggal" placeholder="" />

                                        </div>

                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-table me-1"></i>
                                                Pemeriksaan
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Warna</label>
                                                    <div class="col-sm">
                                                        <input type="text" name="warna" class="form-control 7" id="inputEmail3" placeholder="Warna" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Bau</label>
                                                    <div class="col-sm">
                                                        <input type="bau" name="bau" class="form-control 7" id="inputEmail3" placeholder="Bau" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">pH</label>
                                                    <div class="col-sm">
                                                        <input type="text" name="ph" class="form-control 7" id="inputEmail3" placeholder="pH" />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Berat
                                                        Jenis</label>
                                                    <div class="col-sm">
                                                        <input type="text" name="berat_jenis" class="form-control 7" id="inputEmail3" placeholder="Berat Jenis" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <a class="btn btn-primary" onclick="salert1(7)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
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
                            <th scope="col">No</th>
                            <th scope="col">Sesuai PROTAP</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">No Batch</th>
                            <th scope="col">Kedaluwarsa</th>
                            <th scope="col">Nama Pemasok</th>
                            <th scope="col">Warna</th>
                            <th scope="col">Bau</th>
                            <th scope="col">pH</th>
                            <th scope="col">Berat Jenis</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($data as $row)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row['protap_nama'] }}</td>
                            <td>{{ $row['tanggal'] }}</td>
                            <td>{{ $row['nama_bahan'] }}</td>
                            <td>{{ $row['no_batch'] }}</td>
                            <td>{{ $row['kedaluwarsa'] }}</td>
                            <td>{{ $row['nama_pemasok'] }}</td>
                            <td>{{ $row['warna'] }}</td>
                            <td>{{ $row['bau'] }}</td>
                            <td>{{ $row['ph'] }}</td>
                            <td>{{ $row['berat_jenis'] }}</td>
                            <td>
                                <?php if ($row['status'] == 0) { ?>
                                    Diajukan
                                <?php } elseif ($row['status'] == 1) { ?>
                                    Diterima
                                <?php } ?>
                            </td>
                            <td>
                                @if (Auth::user()->level == 2)
                                <?php if ($row['status'] == 0) { ?>
                                    <form method="post" action="terimapelulusanproduk" id="terimalaporan{{ $row['id_pelulusan'] }}">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{ $row['no_batch'] }}" />
                                        <input type="hidden" name="no" value="{{ $row['id_pelulusan'] }}" />
                                        <button type="button" onclick="TerimaLaporan({{ $row['id_pelulusan'] }})" class="btn btn-primary">terima</button>
                                    </form>
                                <?php } elseif ($row['status'] == 1) { ?>
                                    <form method="post" action="terimapelulusanproduk">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{ $row['no_batch'] }}" />
                                        <button type="submit" class="btn btn-danger disabled">terima</button>
                                    </form>
                                <?php } ?>

                                @else
                                <?php if ($row['status'] == 0) { ?>
                                    <button id="klik_lulus" class="btn btn-primary" data-toggle="modal" data-target="#editlulus" data-protap="{{ $row['protap'] }}" data-tanggal="{{ $row['tanggal'] }}"  data-protap="{{$row['protap_id']}}" data-nama="{{ $row['nama_bahan'] }}" data-nobatch="{{ $row['no_batch'] }}" data-kadaluarsa="{{ $newDate = date('Y-m-d', strtotime($row['kedaluwarsa'])); }}" data-pemasok="{{ $row['nama_pemasok'] }}" data-warna="{{ $row['warna'] }}" data-bau="{{ $row['bau'] }}" data-ph="{{ $row['ph'] }}" data-berat="{{ $row['berat_jenis'] }}" data-id="{{ $row['id_pelulusan'] }}">Edit</button>
                                <?php } elseif ($row['status'] == 1) { ?>
                                    <button id="klik_lulus" class="btn btn-danger disabled" data-toggle="modal" data-target="#editlulus" data-tanggal="{{ $row['tanggal'] }}" data-nama="{{ $row['nama_bahan'] }}" data-nobatch="{{ $row['no_batch'] }}" data-kadaluarsa="{{ $newDate = date('Y-m-d', strtotime($row['kedaluwarsa'])); }}" data-pemasok="{{ $row['nama_pemasok'] }}" data-warna="{{ $row['warna'] }}" data-bau="{{ $row['bau'] }}" data-ph="{{ $row['ph'] }}" data-berat="{{ $row['berat_jenis'] }}" data-id="{{ $row['id_pelulusan'] }}">Edit</button>
                                <?php } ?>

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
    <div class="modal fade" id="editlulus" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Entry Pelulusan Produk Jadi
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <form method="post" action="edit_pelulusan" id='forminput2'>
                        <input type="hidden" name="id" id="isi_id">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Produk
                            </div>
                            <div class="card-header" id='headertgl'>
                            </div>
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="card-body">
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Sesuai
                                                    Dengan PROTAP No</label>
                                                <div class="col-sm">
                                                    {{-- <input type="text" name="pob" class="form-control 2" id="inputEmail3" placeholder="Nomor PROTAP" required /> --}}
                                                    <select name="protap" class="form-control 1" id="isi_protap">
                                                        @foreach ($protap as $isi)
                                                        <option value="{{$isi['protap_id']}}">{{$isi['protap_nama']}}</option>
                                                        @endforeach

                                                    </select>
                                                    <div id="error-box" style="color: red"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Produk</label>
                                                <div class="col-sm">
                                                    <input id="isi_nama" type="text" list="listbahanbaku" style="height: 35px;" id='nama_bahankau' class="form-control 2" name="nama_bahan" autocomplete="off">
                                                    </input>
                                                    <datalist id="listbahanbaku">
                                                        @foreach ($bahanbaku as $row)
                                                        <option value="{{ $row['bahanbaku_nama'] }}">
                                                            {{ $row['bahanbaku_nama'] }}
                                                        </option>
                                                        @endforeach
                                                    </datalist>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">No
                                                    Batch</label>
                                                <div class="col-sm">
                                                    <input id="nobatch" type="text" name="nobatch" class="form-control 2" id="inputEmail3" placeholder="No Batch" maxlength="20"/>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Kedaluwarsa</label>
                                                <div class="col-sm">
                                                    <input type="date" id="kadaluarsa" name="kedaluwarsa" class="form-control 2" id="inputEmail3" placeholder="" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                    Pemasok</label>
                                                <div class="col-sm">
                                                    <input id="pemasok" type="text" name="nama_pemasok" class="form-control 2" id="inputEmail3" placeholder="Nama Pemasok" />
                                                </div>
                                            </div>

                                            <input type="hidden" id='ambil_tanggal' class="form-control" name="tanggal" placeholder="" />

                                        </div>


                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Pemeriksaan
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Warna</label>
                                        <div class="col-sm">
                                            <input type="text" name="warna" class="form-control 2" id="warna" placeholder="Warna" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Bau</label>
                                        <div class="col-sm">
                                            <input type="bau" name="bau" class="form-control 2" id="bau" placeholder="Bau" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">pH</label>
                                        <div class="col-sm">
                                            <input type="text" name="ph" class="form-control 2" id="ph" placeholder="pH" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Berat
                                            Jenis</label>
                                        <div class="col-sm">
                                            <input type="text" name="berat_jenis" class="form-control 2" id="berat" placeholder="Berat Jenis" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <a class="btn btn-primary" onclick="salert1(2)" href="#" style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
</main>
<script>
    $(document).on('click', "#klik_lulus", function() {
        var nama = $(this).data('nama');
        var protap = $(this).data('protap');
        var kadaluarsa = $(this).data('kadaluarsa');
        var nobatch = $(this).data('nobatch');
        var pemasok = $(this).data('pemasok');
        var warna = $(this).data('warna');
        var bau = $(this).data('bau');
        var ph = $(this).data('ph');
        var berat = $(this).data('berat');
        var id = $(this).data('id');
console.log(protap);;
        $("#isi_nama").val(nama);
        $("#isi_protap").val(protap);
        $("#nobatch").val(nobatch);
        $("#kadaluarsa").val(kadaluarsa);
        $("#pemasok").val(pemasok);
        $("#warna").val(warna);
        $("#bau").val(bau);
        $("#ph").val(ph);
        $("#berat").val(berat);
        $("#isi_id").val(id);
        // document.getElementById('cpbahan').value = cpid;
    })
</script>
@endsection