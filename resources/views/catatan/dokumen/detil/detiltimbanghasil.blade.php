@extends('layout.app')
@section('title')
    <title>Detil Timbang Bahan</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Detil Timbang Hasil </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{session()->get('bahan')}}</li>
            </ol>
            <div class="row">

                <div class="card mb-4">
                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        @if (Auth::user()->level != 2)
                            <button class="btn btn-success btn-lg @if($status != 0) disabled @endif" data-toggle="modal" data-target="#modalForm">
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
                                            Entry Hasil Timbang
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form method="post" action="tambah_detiltimbanghasil"
                                            id='forminput1'>
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <i class="fas fa-table me-1"></i>
                                                    Hasil Timbang
                                                </div>
                                                <div class="card-header" id="headertgl">
                                                </div>
                                                @csrf
                                                <div class="card-body">

                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">Tanggal</label>
                                                        <div class="col-sm">
                                                            <input type="date" name="tanggal" class="form-control 1"
                                                                id="tanggal" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nomor
                                                            Loth</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="no_loth" class="form-control 1"
                                                                id="nama_bahan" placeholder="No Loth" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">Jumlah
                                                            Permintaan</label>
                                                        <div class="col-sm">
                    
                                                            <div class="row">
                                                                <div class="col-sm-8"
                                                                    data-tip="Hanya angka saja">
                                                                    <input type="number"
                                                                    name="jumlah_permintaan"  class="form-control 1"
                                                                    id="jumlah_permintaan"
                                                                    placeholder="Jumlah Permintaan" />
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select"
                                                                        name="satuan" id="satuan">
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
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">Hasil
                                                            Timbang</label>
                                                        <div class="col-sm">
                    
                                                            <div class="row">
                                                                <div class="col-sm-8"
                                                                    data-tip="Hanya angka saja">
                                                                    <input type="text" name="hasil_timbang" class="form-control 1"
                                                                id="hasil_timbang" placeholder="Hasil Timbang" />
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select"
                                                                        name="satuan" id="satuan">
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
                                                        <label for="inputEmail3"
                                                            class="col-sm-3 col-form-label">Sisa
                                                            Bahan</label>
                                                        <div class="col-sm">
                    
                                                            <div class="row">
                                                                <div class="col-sm-8"
                                                                    data-tip="Hanya angka saja">
                                                                    <input type="number" name="sisa_bahan" class="form-control 1"
                                                                id="sisa_bahan" placeholder="Sisa Bahan" />
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <select class="form-select"
                                                                        name="satuan" id="satuan">
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
                                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                                            Produk</label>
                                                        <div class="col-sm">
                                                            <input type="text" name="untuk_produk" class="form-control 1"
                                                                id="untuk_produk" placeholder="Untuk Produk" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <a class="btn btn-primary" onclick="salert1(1)" href="#"
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
                                <th scope="col">Nomor Loth</th>
                                <th scope="col">Jumlah Permintaan</th>
                                <th scope="col">Hasil Penimbangan</th>
                                <th scope="col">Sisa Bahan</th>
                                <th scope="col">Untuk Produk</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data as $row)
                            <?php $i++; ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $row['tanggal'] }}</td>
                                <td>{{ $row['no_loth'] }}</td>
                                <td>{{ $row['jumlah_permintaan'] }}</td>
                                <td>{{ $row['hasil_penimbangan'] }}</td>
                                <td>{{ $row['sisa_bahan'] }}</td>
                                <td>{{ $row['untuk_produk'] }}</td>
                                <td>
                                    @if (Auth::user()->level != 2)
                                    <button id="klikruang" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editRuang" data-tanggal="{{ $row['tanggal'] }}" data-nama="{{ $row['nama_bahan_baku'] }}" data-noloth="{{ $row['no_loth'] }}" data-jbahan="{{ $row['jumlah_bahan_baku'] }}" data-jminta="{{ $row['jumlah_permintaan'] }}" data-hasil="{{ $row['hasil_penimbangan'] }}" data-sisa="{{ $row['sisa_bahan'] }}" data-produk="{{ $row['untuk_produk'] }}" data-id="{{ $row['id_detiltimbanghasil']}}">edit</button>


                                    
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal Ruang-->
        <div class="modal fade" id="editRuang" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Hasil Timbang</h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header" id='headertgl3'></div>
                            <div class="card-header">Hasil Timbang</div>
                            <div class="card-body">
                                <p class="statusMsg"></p>
                                <form role="form" method="post" action="edit_detiltimbanghasil" id='forminput6'>
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="id" id="isi_ruangid">


                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">No Loth</label>
                                        <div class="col-sm">
                                            <input type="text" name="no_loth" class="form-control 6" id="isi_nolothruang"
                                                placeholder="No Loth" />
                                        </div>
                                    </div>


                                    {{-- <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Jumlah
                                            Permintaan</label>
                                        <div class="col-sm" data-tip="Hanya angka saja">
                                            <input type="number" name="jumlah_permintaan" class="form-control 6"
                                                id="isi_jminta" placeholder="Jumlah Permintaan" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Hasil
                                            Penimbangan</label>
                                        <div class="col-sm">
                                            <input type="text" name="hasil_penimbangan" class="form-control 6"
                                                id="isi_hasilruang" placeholder="Hasil Penimbangan" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Sisa Bahan</label>
                                        <div class="col-sm" data-tip="Hanya angka saja">
                                            <input type="number" name="sisa_bahan" class="form-control 6"
                                                id="isi_sisa" placeholder="Untuk Produk" />
                                        </div>
                                    </div> --}}
                                    
                                    <div class="form-group row">
                                        <label for="inputEmail3"
                                            class="col-sm-3 col-form-label">Jumlah
                                            Permintaan</label>
                                        <div class="col-sm">
    
                                            <div class="row">
                                                <div class="col-sm-8"
                                                    data-tip="Hanya angka saja">
                                                    <input type="number" name="jumlah_permintaan" class="form-control 6"
                                                    id="isi_jminta" placeholder="Jumlah Permintaan" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select"
                                                        name="satuan" id="satuan">
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
                                        <label for="inputEmail3"
                                            class="col-sm-3 col-form-label">Hasil
                                            Timbang</label>
                                        <div class="col-sm">
    
                                            <div class="row">
                                                <div class="col-sm-8"
                                                    data-tip="Hanya angka saja">
                                                    <input type="text" name="hasil_penimbangan" class="form-control 6"
                                                    id="isi_hasilruang" placeholder="Hasil Penimbangan" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select"
                                                        name="satuan" id="satuan">
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
                                        <label for="inputEmail3"
                                            class="col-sm-3 col-form-label">Sisa
                                            Bahan</label>
                                        <div class="col-sm">
    
                                            <div class="row">
                                                <div class="col-sm-8"
                                                    data-tip="Hanya angka saja">
                                                    <input type="number" name="sisa_bahan" class="form-control 6"
                                                id="isi_sisa" placeholder="Untuk Produk" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <select class="form-select"
                                                        name="satuan" id="satuan">
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
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Untuk
                                            Produk</label>
                                        <div class="col-sm">
                                            <input type="text" name="untuk_produk" class="form-control 6"
                                                id="isi_produkruang" placeholder="Untuk Produk" />
                                        </div>
                                    </div>

                                   

                                    <a class="btn btn-primary" onclick="salert1(6)" href="#"
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
            $(document).on('click', "#klikruang", function() {

                var nama = $(this).data('nama');
                // var tanggal = $(this).data('tanggal');
                var noloth = $(this).data('noloth');
                var jruang = $(this).data('jbahan');
                var jminta = $(this).data('jminta');
                var hasil = $(this).data('hasil');
                var produk = $(this).data('produk');
                var sisa = $(this).data('sisa');
                var id = $(this).data('id');

                $("#isi_namaruang").val(nama);
                // $("#isi_tanggal").val(tanggal);
                $("#isi_nolothruang").val(noloth);
                $("#isi_jruang").val(jruang);
                $("#isi_jminta").val(jminta);
                $("#isi_sisa").val(sisa);
                $("#isi_hasilruang").val(hasil);
                $("#isi_produkruang").val(produk);
                $("#isi_ruangid").val(id);
            })
        </script>
    </main>
@endsection
