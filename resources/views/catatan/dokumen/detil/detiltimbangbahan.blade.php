@extends('layout.app')
@section('title')
    <title>Detil Timbang Bahan</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detil Timbang Bahan </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Nama Bahan</li>
            </ol>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg @if ($status != 0) disabled @endif"
                                data-toggle="modal" data-target="#modalForm">
                                Tambah Data
                            </button>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Data Penimbangan Bahan
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_detiltimbangbahan" id='forminput2'>
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <i class="fas fa-table me-1"></i>
                                                    Timbang Bahan
                                                </div>
                                                <div class="card-header" id="headertgl2">
                                                </div>
                                                @csrf
                                                <div class="card-body">

                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">Tanggal</label>
                                                        <div class="col-sm">
                                                            <input type="date" name="tanggal" class="form-control 2"
                                                                id="tanggal" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan
                                                            Baku</label>
                                                        <div class="col-sm">
                                                            <input class="form-control 2" list="listnamabahanbaku"
                                                                type="text" name='nama_bahan' id="isi_bahan"
                                                                autocomplete="off">
                                                            <datalist id='listnamabahanbaku'>
                                                                @foreach ($bahanbaku as $row)
                                                                    <option value="{{ $row['bahanbaku_nama'] }}">
                                                                        {{ $row['bahanbaku_nama'] }}
                                                                    </option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                                            Suplier</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="nama_suplier" class="form-control 2"
                                                                id="inputEmail3" placeholder="Nama Suplier" />
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                                            Bahan Baku</label>
                                                        <div class="col-sm">

                                                            <div class="row">
                                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                                    <input type="number" name="jumlah_bahan"
                                                                        class="form-control 2" id="jumlah_bahanbaku"
                                                                        placeholder="Jumlah Bahan Baku" />
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" name="satuanj"
                                                                        id="satuan">
                                                                        <option value="gr"> gr</option>
                                                                        <option value="kg"> kg</option>
                                                                        <option value="ml"> ml</option>
                                                                        <option value="L"> L</option>
                                                                        <option value="Pcs"> Pcs</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                                            Penimbangan</label>
                                                        <div class="col-sm">

                                                            <div class="row">
                                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                                    <input type="number" name="hasil_penimbangan"
                                                                        class="form-control 2" id="jumlah_bahanbaku"
                                                                        placeholder="Hasil Penimbangan" />
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select" name="satuanh"
                                                                        id="satuan">
                                                                        <option value="gr"> gr</option>
                                                                        <option value="kg"> kg</option>
                                                                        <option value="ml"> ml</option>
                                                                        <option value="L"> L</option>
                                                                        <option value="Pcs"> Pcs</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="btn btn-primary" onclick="salert1(2)" href="#"
                                                    style="float:left; width: 100px;  margin-left:25px"
                                                    role="button">Simpan</a>
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
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Bahan</th>
                                <th scope="col">Nama Suplier</th>
                                <th scope="col">Jumlah Bahan</th>
                                <th scope="col">Hasil Penimbangan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>

                            @foreach ($data as $row)
                                <tr>
                                    <td scope="col">{{ $i }}</td>
                                    <td scope="col">{{ $row['tanggal'] }}</td>
                                    <td scope="col">{{ $row['nama_bahan'] }}</td>
                                    <td scope="col">{{ $row['nama_suplier'] }}</td>
                                    <td scope="col">{{ $row['jumlah_bahan'] }}</td>
                                    <td scope="col">{{ $row['hasil_penimbangan'] }}</td>
                                    <td scope="col">
                                        @if (Auth::user()->level != 2)
                                            @if ($status == 0)
                                                <button id="klik_bahan" type="submit" class="btn btn-primary"
                                                    data-toggle="modal" data-target="#editBahan"
                                                    data-tanggal="{{ $row['tanggal'] }}"
                                                    data-nama="{{ $row['nama_bahan'] }}"
                                                    data-noloth="{{ $row['no_loth'] }}"
                                                    data-suplai="{{ $row['nama_suplier'] }}"
                                                    data-jbahan="{{ preg_replace('/[^0-9]/', '', $row['jumlah_bahan']) }}"
                                                    data-satuanj="{{ preg_replace('/[^a-zA-Z]+/', '', $row['jumlah_bahan']) }}"
                                                    data-hasil="{{ preg_replace('/[^0-9]/', '', $row['hasil_penimbangan']) }}"
                                                    data-satuanh="{{ preg_replace('/[^a-zA-Z]+/', '', $row['hasil_penimbangan']) }}"
                                                    data-id="{{ $row['id_detiltimbangbahan'] }}">edit</button>
                                            @else
                                                <button class="btn btn-danger disabled"> edit </button>
                                            @endif
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
        <!-- Modal -->
        <div class="modal fade" id="modalForm4" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Penimbangan Bahan Baku
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl1'></div>
                            <div class="card-header">Bahan Baku</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="tambah_penimbanganbahan" id='forminput1'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan
                                            Baku</label>
                                        <div class="col-sm">
                                            <input class="form-control 1" list="listnamabahanbaku" type="text"
                                                name='nama_bahan' id="isi_bahan" autocomplete="off">
                                            </input>
                                            <datalist id='listnamabahanbaku'>
                                                @foreach ($bahanbaku as $row)
                                                    <option value="{{ $row['bahanbaku_nama'] }}">
                                                        {{ $row['bahanbaku_nama'] }}
                                                    </option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">No Loth</label>
                                        <div class="col-sm">
                                            <input type="text" name="no_loth" class="form-control 1" id="inputEmail3"
                                                placeholder="No Loth" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                            Suplier</label>
                                        <div class="col-sm">
                                            <input type="text" name="nama_suplier" class="form-control 1"
                                                id="inputEmail3" placeholder="Nama Suplier" />
                                        </div>
                                    </div>

                                    <input type="hidden" name="tanggal" id='ambil_tanggal1' class="form-control 1"
                                        placeholder="" />

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah Bahan
                                            Baku</label>
                                        <div class="col-sm">
                                            <input type="text" name="jumlah_bahan" class="form-control 1"
                                                id="inputEmail3" placeholder="Jumlah Bahan Baku" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                            Penimbangan</label>
                                        <div class="col-sm">
                                            <input type="text" name="hasil_penimbangan" class="form-control 1"
                                                id="inputEmail3" placeholder="Hasil Penimbangan" />
                                        </div>
                                    </div>

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
        <!-- Modal Bahan -->
        <div class="modal fade" id="editBahan" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Penimbangan Bahan Baku
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl1'></div>
                            <div class="card-header">Bahan Baku</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="edit_detiltimbangbahan" id='forminput4'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" id="isi_bahanid">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Bahan
                                            Baku</label>
                                        <div class="col-sm">
                                            <input class="form-control 4" list="listnamabahanbaku" type="text"
                                                name='nama_bahan' id="bahanbahan" autocomplete="off">

                                            <datalist id='listnamabahanbaku'>
                                                @foreach ($bahanbaku as $row)
                                                    <option value="{{ $row['bahanbaku_nama'] }}">
                                                        {{ $row['bahanbaku_nama'] }}
                                                    </option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                            Suplier</label>
                                        <div class="col-sm">
                                            <input type="text" name="nama_suplier" class="form-control 4"
                                                placeholder="Nama Suplier" id="isi_suplaibahan" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                            Bahan Baku</label>
                                        <div class="col-sm">

                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah_bahan" class="form-control 4"
                                                        id="isi_jbahan" placeholder="Jumlah Bahan Baku" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuanj" id="satuanj">
                                                        <option value="gr"> gr</option>
                                                        <option value="kg"> kg</option>
                                                        <option value="ml"> ml</option>
                                                        <option value="L"> L</option>
                                                        <option value="Pcs"> Pcs</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil Penimbangan</label>
                                        <div class="col-sm">

                                            <div class="row">
                                                <div class="col-sm-8" data-tip="Hanya angka saja">
                                                    <input type="number" name="hasil_penimbangan" class="form-control 4"
                                                        id="isi_hasilbahan" placeholder="Hasil Penimbangan" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select" name="satuanh" id="satuanh">
                                                        <option value="gr"> gr</option>
                                                        <option value="kg"> kg</option>
                                                        <option value="ml"> ml</option>
                                                        <option value="L"> L</option>
                                                        <option value="Pcs"> Pcs</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <a class="btn btn-primary" onclick="salert1(4)" href="#"
                                        style="float:left; width: 100px;  margin-left:25px" role="button">Simpan</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pop up end -->
        <!-- pop up end -->
        <script>
            $(document).on('click', "#klik_bahan", function() {
                var nama = $(this).data('nama');
                var tanggal = $(this).data('tanggal');
                var noloth = $(this).data('noloth');
                var suplai = $(this).data('suplai');
                var jbahan = $(this).data('jbahan');
                var satuanj = $(this).data('satuanj');
                var hasil = $(this).data('hasil');
                var satuanh = $(this).data('satuanh');
                var id = $(this).data('id');
                $("#bahanbahan").val(nama);
                // $("#isi_tanggal").val(tanggal);
                $("#isi_nolothbahan").val(noloth);
                $("#isi_suplaibahan").val(suplai);
                $("#isi_jbahan").val(jbahan);
                $("#isi_hasilbahan").val(hasil);
                $("#satuanj").val(satuanj);
                $("#satuanh").val(satuanh);
                $("#isi_bahanid").val(id);
                // document.getElementById('cpbahan').value = cpid;
            })
        </script>
    </main>
@endsection
