@extends('layout.app')
@section('title')
    <title>Penerimaan Penyerahan dan Penyimpanan</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Catatan Penerimaan Penyerahan dan Penyimpanan</h1>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Bahan Baku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Produk Jadi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Kemasan</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">

                        <div class="card mb-4">

                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                    <button onclick="setdatetoday1(3)" class="btn btn-success btn-lg" data-toggle="modal"
                                        data-target="#modalBahan">
                                        Tambah Bahan Baku
                                    </button>
                                @endif
                            </div>

                            <table class="table mt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Bahan Baku</th>
                                        <th scope="col">Nama Bahan Baku</th>
                                        <th scope="col">Untuk Produk</th>
                                        <th scope="col">Ruangan</th>
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
                                            <td>{{ $row['kode'] }}</td>
                                            <td>{{ $row['nama'] }}</td>
                                            <td>{{ $row['produk'] }}</td>
                                            <td>{{ $row['ruang'] }}</td>
                                            <td>
                                                @if ($row['ruang'] == 0)
                                                    {{ 'Diajukan' }}
                                                @else
                                                    {{ 'Diterima' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->level == 2)
                                                    <form method="post" action="detilterimabb">
                                                        @csrf
                                                        <input type="hidden" name="jenis" value=1 />
                                                        <input type="hidden" name="induk"
                                                            value="{{ $row['cp_bahan_id'] }}" />
                                                        <button type="submit" class="btn btn-primary">terima</button>
                                                    </form>
                                                @else
                                                    <form method="post" action="detilterimabb">
                                                        @csrf
                                                        <input type="hidden" name="jenis" value=1 />
                                                        <input type="hidden" name="induk"
                                                            value="{{ $row['cp_bahan_id'] }}" />
                                                        <button type="submit" class="btn btn-primary">edit</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="card mb-4">

                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                    <button onclick="setdatetoday1(2)" class="btn btn-success btn-lg" data-toggle="modal"
                                        data-target="#modalProduk">
                                        Tambah Produk Jadi
                                    </button>
                                @endif


                            </div>

                            <table class="table mt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Produk Jadi</th>
                                        <th scope="col">Nama Produk Jadi</th>
                                        <th scope="col">Untuk Produk</th>
                                        <th scope="col">Ruangan</th>
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
                                            <td>{{ $row['kode'] }}</td>
                                            <td>{{ $row['nama'] }}</td>
                                            <td>{{ $row['produk'] }}</td>
                                            <td>{{ $row['ruang'] }}</td>
                                            <td>
                                                @if ($row['ruang'] == 0)
                                                    {{ 'Diajukan' }}
                                                @else
                                                    {{ 'Diterima' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->level == 2)
                                                    <form method="post" action="detilterimabb">
                                                        @csrf
                                                        <input type="hidden" name="jenis" value=2 />
                                                        <input type="hidden" name="induk"
                                                            value="{{ $row['cp_produk_id'] }}" />
                                                        <button type="submit" class="btn btn-primary">terima</button>
                                                    </form>
                                                @else
                                                    <form method="post" action="detilterimabb">
                                                        @csrf
                                                        <input type="hidden" name="jenis" value=2 />
                                                        <input type="hidden" name="induk"
                                                            value="{{ $row['cp_produk_id'] }}" />
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="row">

                        <div class="card mb-4">

                            <div class="card-body">
                                <!-- pop up -->
                                <!-- Button to trigger modal -->
                                @if (Auth::user()->level != 2)
                                    <button onclick="setdatetoday1(1)" class="btn btn-success btn-lg" data-toggle="modal"
                                        data-target="#modalKemasan">
                                        Tambah Kemasan
                                    </button>
                                @endif


                            </div>

                            <table class="table mt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Kemasan</th>
                                        <th scope="col">Nama Kemasan</th>
                                        <th scope="col">Untuk Produk</th>
                                        <th scope="col">Ruangan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($data3 as $row)
                                        <?php $i++; ?>

                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $row['kode'] }}</td>
                                            <td>{{ $row['nama'] }}</td>
                                            <td>{{ $row['produk'] }}</td>
                                            <td>{{ $row['ruang'] }}</td>
                                            <td>
                                                @if ($row['ruang'] == 0)
                                                    {{ 'Diajukan' }}
                                                @else
                                                    {{ 'Diterima' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->level == 2)
                                                    <form method="post" action="detilterimabb">
                                                        @csrf
                                                        <input type="hidden" name="jenis" value=3 />
                                                        <input type="hidden" name="induk"
                                                            value="{{ $row['cp_kemasan_id'] }}" />
                                                        <button type="submit" class="btn btn-primary">terima</button>
                                                    </form>
                                                @else
                                                    <form method="post" action="detilterimabb">
                                                        @csrf
                                                        <input type="hidden" name="jenis" value=3 />
                                                        <input type="hidden" name="induk"
                                                            value="{{ $row['cp_kemasan_id'] }}" />
                                                        <button type="submit" class="btn btn-primary">Edit</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Modal Bahan -->
        <div class="modal fade" id="modalBahan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Bahan Baku</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl3'></div>
                            <div class="card-header">Bahan Baku</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="tambah_terimabahan" id='forminput3'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode bahan</label>
                                        <div class="col-sm">
                                            <select style="height: 35px;" id='kode_bahan' class="form-control 3"
                                                name="kode">
                                                <option selected>Choose...</option>
                                                @foreach ($bahanbaku as $row)
                                                    <option value="{{ $row['bahanbaku_kode'] }}"
                                                        data-nama="{{ $row['bahanbaku_nama'] }}">
                                                        {{ $row['bahanbaku_kode'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                            Bahan</label>
                                        <div class="col-sm">
                                            <input type="text" name="nama" readonly class="form-control 3" id="nama_bahan"
                                                placeholder="Nama Bahan" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk Produk</label>
                                        <div class="col-sm">
                                            <input type="text" name="produk" class="form-control 3" id="inputEmail3"
                                                placeholder="Untuk Produk" />
                                        </div>
                                    </div>
                                    <input type="hidden" id='ambil_tanggal3' class="form-control 3" name="tanggal"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                        <div class="col-sm">
                                            <input type="text" name="ruang" class="form-control 3" id="inputEmail3"
                                                placeholder="Ruangan" />
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" onclick="salert1(3)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->

        <!-- Modal Produk -->
        <div class="modal fade" id="modalProduk" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Produk</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl2'></div>
                            <div class="card-header">Produk</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="tambah_terimaproduk" id='forminput2'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode Produk</label>
                                        <div class="col-sm">
                                            <select style="height: 35px;" id='kodeproduk' class="form-control 2"
                                                name="kode">
                                                <option selected>Choose...</option>
                                                @foreach ($produk as $row)
                                                    <option value="{{ $row['produk_kode'] }}"
                                                        data-nama="{{ $row['produk_nama'] }}">
                                                        {{ $row['produk_kode'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                            Produk</label>
                                        <div class="col-sm">
                                            <input type="text" name="nama" readonly class="form-control 2" id="namaproduk"
                                                placeholder="Nama Produk" />
                                        </div>
                                    </div>
                                    <input type="hidden" id='ambil_tanggal2' class="form-control 2" name="tanggal"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jenis Kemasan</label>
                                        <div class="col-sm">
                                            <input type="text" name="produk" class="form-control 2" id="inputEmail3"
                                                placeholder="Jenis Kemasan" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                        <div class="col-sm">
                                            <input type="text" name="ruang" class="form-control 2" id="inputEmail3"
                                                placeholder="Ruangan" />
                                        </div>
                                    </div>
                                    <a class="btn btn-primary" onclick="salert1(2)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->

        <!-- Modal Kemasan -->
        <div class="modal fade" id="modalKemasan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Tambah Kemasan</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl1'></div>
                            <div class="card-header">Kemasan</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="tambah_terimakemasan" id='forminput1'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Kemasan</label>
                                        <div class="col-sm">
                                            <input type="text" name="nama" class="form-control 1" id="inputEmail3"
                                                placeholder="Nama Kemasan" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk Produk</label>
                                        <div class="col-sm">
                                            <input type="text" name="produk" class="form-control 1" id="inputEmail3"
                                                placeholder="Untuk Produk" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Kode Kemasan</label>
                                        <div class="col-sm">
                                            <input type="text" name="kode" class="form-control 1" id="inputEmail3"
                                                placeholder="Kode Kemasan" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Ruangan</label>
                                        <div class="col-sm">
                                            <input type="text" name="ruang" class="form-control 1" id="inputEmail3"
                                                placeholder="Ruangan" />
                                        </div>
                                    </div>
                                    <input type="hidden" id='ambil_tanggal1' class="form-control 1" name="tanggal"
                                        placeholder="" />
                                    <a class="btn btn-primary" onclick="salert1(1)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->
        <script>
            $("#kode_bahan").change(function() {
                const $this = $(this); // Cache $(this)
                const dataVal = $this.find(":selected").data("nama"); // Get data value
                document.getElementById('nama_bahan').value = dataVal;
            });
            $("#kodeproduk").change(function() {
                const $this = $(this); // Cache $(this)
                const dataVal = $this.find(":selected").data("nama"); // Get data value
                document.getElementById('namaproduk').value = dataVal;
            });
        </script>
    </main>
@endsection
