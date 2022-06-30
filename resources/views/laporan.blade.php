@extends('layout.app')
@section('title')
<title>Laporan</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">

        <h1 class="mt-4">Laporan <?php
                                    $tujuan = "";
                                    $tujuan .= "/laporandata";
                                    if (isset($_POST['tahun'])) {
                                        if ($_POST['tahun'] != 0) {
                                            $tujuan .= "?tahun=" . $_POST['tahun'];
                                        }
                                        if (isset($_POST['bulan'])) {
                                            if ($_POST['bulan'] != "0") {
                                                $tujuan .= "&";
                                                $tujuan .= "bulan=" . $_POST['bulan'];
                                            }
                                        }
                                    }; ?>  </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Laporan</li>
        </ol>

        <div class="row">


            {{-- <div class="card mb-4">

                <div class="card-body">

                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Pencarian Laporan
                    </div>
                    <form action="laporan" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col">
                                <select id="tahun" class="form-control" name="tahun" style="height: 35px;" id="inlineFormCustomSelect">
                                    <option value="0" selected>Tahun</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                </select>
                            </div>
                            <div class="col">
                                <select disabled id="bulan" name="bulan" class="form-control" style="height: 35px;" id="inlineFormCustomSelect">
                                    <option value="0" selected>Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>

                        </div>
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </form>

                </div>
            </div> --}}

            <table class="table" id="laporan">
                <thead>
                    <tr>
                        <th scope="col">Nama Laporan</th>
                        <th scope="col">Diajukan</th>
                        <th scope="col">Tanggal Diajukan</th>
                        <th scope="col">Diterima</th>
                        <th scope="col">Tanggal Diterima</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>



    <script>
        $("#tahun").change(function() {
            if (this.value == 0) {
                document.getElementById("bulan").disabled = true;
                document.getElementById("bulan").value = 0;
            } else {
                document.getElementById("bulan").disabled = false;
            }

        });
        $(document).ready(function() {
            var x = true;
            var r = <?php  echo "'".url($tujuan)."'"; ?>;
            console.log(r);
            $('#laporan').DataTable({
                processing: true,
                serverSide: true,
                ajax: r,
                columns: [{
                        data: 'laporan_nama',
                        name: 'laporan_nama'
                    },
                    {
                        data: 'laporan_diajukan',
                        name: 'laporan_diajukan'
                    },
                    {
                        data: 'tgl_diajukan',
                        name: 'tgl_diajukan'
                    },
                    {
                        data: 'laporan_diterima',
                        name: 'laporan_diterima'
                    },
                    {
                        data: 'tgl_diterima',
                        name: 'tgl_diterima'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        })
    </script>


</main>
@endsection