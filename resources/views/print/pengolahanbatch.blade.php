<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <style>
        .tabelttd {
            /* border-style: dotted; */
            /* box-shadow: none;  */
            /* border: 0;
            border-width: 0; */
            /* border: none;
            border-style: none; */
            /* -webkit-backface-visibility: hidden; */
        }
        P {
            margin-bottom: 3px;
        }

        table {
            width: 100%;
            margin-top: -15;
            border-collapse: collapse;

        }

        td {
            border: 1px solid black;
            padding: 5px 3px;
        }

        tr {
            text-align: center;
        }

        h3 {
            float: left;
            font-size: 12;
            font-weight: lighter;
            /* margin-bottom: auto; */
        }

        @page {
            size: auto;
            margin: 5mm;
        }

        /* Kop Surat */
        .kop {
            border-bottom: 5px solid black;
        }

        .rangkasurat {
            width: 980px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
        }

        .tengah {
            text-align: center;
        }

        /* isi */
        .isi {
            text-align: center;
        }
    </style>

    <title>print</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->

    <section class="sheet padding-10mm" style="height: auto;">
        <!-- Kop Surat -->

        <table width="100%" class="kop">
            <tr>
                <td style="border:none;"  width="30%">
                    <img src={{ asset("asset/logo/$logo") }} style="height:120px; width:auto;" alt="Your Picture">
                </td>
                <td width="70%" class="tengah" style="border:none;">
                <center>
                    <h1 style="font-weight: bolder; margin-bottom: -15px">
                        {{ $nama }}
                    </h1>
                    <p style="margin-bottom: -5px; font-size: 28px; ">
                        {{ $alamat }}
                    </p>
                    <p style="margin-bottom: -5px; font-size: 16px;">
                        No Handphone : {{ $nohp }}
                    </p>
                    </center>
                </td>
            </tr>
        </table>
        <center>
            <br>
            @foreach($kop as $row)
            <table class="table table-bordered">
                <tr>
                    <td rowspan="4">
                        <img src={{ asset("asset/logo/$logo") }} style="height:120px; width:auto;" alt="Your Picture">

                    </td>
                    <td rowspan="2" style="text-align: center;">
                        CATATAN<br>PENGOLAHAN BATCH
                    </td>
                    <td colspan="3">Halaman:</td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="3">
                        Nomor: <br>
                        Tanggal Berlaku: <br>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">
                        BAGIAN

                    </td>
                    <!-- <td rowspan="3">
                            Nomor: <br>
                            Tanggal Berlaku: <br>
                        </td> -->

                </tr>
                <tr></tr>
                <tr>
                    <td rowspan="3">
                        Disusun Oleh <br>
                        {{$row['laporan_diajukan']}} <br>
                        Tanggal <br>
                        {{$row['tgl_diajukan']}}
                    </td>
                    <td rowspan="3">
                        Disetujui Oleh <br>
                        {{$row['laporan_diterima']}} <br>
                        Tanggal <br>
                        {{$row['tgl_diajukan']}}
                    </td>
                    <td rowspan="3" colspan="3">
                        Mengganti Nomor <br>
                        Tanggal <br>
                        09 Oktober 2019
                    </td>
                </tr>
            </table>
            @endforeach


            <p style="text-align: left; margin-top: 15px; ">1. BATCH</p>
            <table>

                <tr>
                    <td>Kode</td>
                    <td>Nama</td>
                    <td>Nomor Batch</td>
                    <td>Besar Batch</td>
                    <td>Bentuk Sediaan</td>
                    <td>Kemasan</td>
                    <td>Tanggal Pengolahan</td>
                </tr>
                @foreach ($data as $row)
                <tr>
                    <td>{{$row['kode_produk']}}</td>
                    <td>{{$row['nama_produk']}}</td>
                    <td>{{$row['nomor_batch']}}</td>
                    <td>{{$row['besar_batch']}}</td>
                    <td>{{$row['bentuk_sedia']}}</td>
                    <td>{{$row['kemasan']}}</td>
                    <td>{{$row['tanggal_pengolahan']}}</td>
                </tr>
                @endforeach
            </table>
            <p style="text-align: left; margin-top: 15px;">2. KOMPOSISI</p>
            <table>

                <tr>
                    <td scope="col">No</td>
                    <td scope="col">Nama BB</td>
                    <td scope="col">Kode BB</td>
                    <td scope="col">Persentase (%)</td>
                </tr>


                <?php $i = 0 ?>
                @foreach($list_kom as $row)
                <?php $i++;
                ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{"*****"}}</td>
                    <td>{{"*****"}}</td>
                    <td>{{"*****"}}</td>
                </tr>
                @endforeach

            </table>

            <p style="text-align: left; margin-top: 15px;">3. PERALATAN</p>
            <table class="table">

                <tr>
                    <td scope="col">No</td>
                    <td scope="col">Nama Alat</td>
                    <td scope="col">Kode Alat</td>
                </tr>


                <?php $i = 0 ?>
                @foreach($list_alat as $row)
                <?php $i++;
                ?>
                <tr>
                    <td scope="row">{{$i}}</td>
                    <td>{{$row['peralatan_nama']}}</td>
                    <td>{{$row['peralatan_id']}}</td>
                </tr>
                @endforeach

            </table>
            <p style="text-align: left; margin-top: 15px;">4. BAHAN</p>
            <table class="table">

                <tr>
                    <td scope="col">No</td>
                    <td scope="col">Kode Bahan</td>
                    <td scope="col">Nama Bahan</td>
                    <td scope="col">Nomor Lotd</td>
                    <td scope="col">Jml Dibutuhkan</td>
                    <td scope="col">Jml Ditimbang</td>
                    <td scope="col">Ditimbang Oleh</td>
                    <td scope="col">Diperiksa Oleh</td>
                </tr>

                <?php $i = 0 ?>
                @foreach($list_nimbang as $row)
                <?php $i++;
                ?>
                <tr>
                    <td scope="row">{{$i}}</td>
                    <td>{{$row['penimbangan_kodebahan']}}</td>
                    <td>{{$row['penimbangan_namabahan']}}</td>
                    <td>{{$row['penimbangan_loth']}}</td>
                    <td>{{$row['penimbangan_jumlahbutuh']}}</td>
                    <td>{{$row['penimbangan_jumlahtimbang']}}</td>
                    <td>{{$row['penimbangan_timbangoleh']}}</td>
                    <td>{{$row['penimbangan_periksaoleh']}}</td>

                </tr>
                @endforeach

            </table>

            <p style="text-align: left; margin-top: 15px;">5. REKONSILISASI</p>
            <table class="table isi table-bordered">
                <tr>
                    <td>Rekonsiliasi Hasil</td>
                    <td>Diperiksa Oleh</td>
                    <td>Disetujui Oleh</td>
                </tr>
                <tr>
                    <td>isi 1</td>
                    <td>isi 2</td>
                    <td>isi 3</td>
                </tr>
            </table>

            
            <table class="tabelttd" style="margin-top:10px;">
                <tr>
                    <td style="border-right: 0px solid">
                        Pemeriksa <br>
                        Proses pengolahan
                        <br><br><br><br>
                    </td>
                    <td style="border-left: 0px solid; border-right: 0px solid"></td>
                    <td style="border-left: 0px solid">
                        peninjau <br>
                        catatan pengolahan batch
                        <br><br><br><br>
                    </td>
                </tr>
                <tr>
                    <td >
                        Pemeriksaan pengelohan
                        <br>
                        Tanggal<br><br><br>
                    </td>
                    <td>
                        Kepala Bagian Produksi
                        <br>
                        Tanggal<br><br><br>
                    </td>
                    <td>
                        Kepala Bagian Pengawasan Mutu
                        <br>
                        Tanggal<br><br><br>
                    </td>
                </tr>
            </table>


        </center>
    </section>

</body>

</html>