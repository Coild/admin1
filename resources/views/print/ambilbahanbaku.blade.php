<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <style>
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


<body class="A4">
    <center>
        <section class="sheet padding-10mm" style="height: auto;">
            <!-- Kop Surat -->

            <table width="100%" class="kop">
                <tr>
                    <td style="border:none;">
                        <img src="{{asset('asset/logo/logo.jpg')}}" style="height:120px; width:auto;" alt="Your Picture">
                    </td>
                    <td class="tengah" style="border:none;">
                        <h1 style="font-weight: bolder; margin-bottom: -15px">
                            UD. SEMELOTO
                        </h1>
                        <h3 style="margin-bottom: -0px">
                            JL. KEMERDEKAAN RT.019/RW.010 DUSUN PEMANGONG
                        </h3>
                        <h5>
                            DESA LENANGGUAR KABUPATEN SUMBAWA
                        </h5>
                    </td>
                </tr>
            </table>
            <center>
                <br>
               <h2>CATATAN PENGAMBILAN CONTOH BAHAN BAKU</h2>

                <br>
                <h4 style="text-align: left; margin-bottom: -17px; margin-top:-10px;">Nama Bahan Pengemas: </h4>
                <h4 style="text-align: left; margin-bottom: -17px;">No Batch: </h4>
                <h4 style="text-align: left; ">Tanggal Pengambilan Contoh: </h4>
                <table class="table isi table-bordered">
                    <tr>
                        <td>No</td>
                        <td>Daftar Periksa</td>
                        <td>Hasil Pemeriksaan</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Nama bahan baku</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Nomor Batch</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Kedaluwarsa</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Jumlah bahan baku dalam master Box</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Jumlah Produk Yang Diambil</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Jenis Dan warna kemasan</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Kesimpulan</td>
                        <td>DILULUSKAN/DITOLAK</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Diperiksa Oleh,<br> Analis QC</td>
                        <td>Disetujui Oleh,<br> Kepala Bagian Pengawasan Mutu</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>(TTD)</td>
                        <td>(TTD)</td>
                    </tr>
                </table>
                <!-- <p style="text-align: left; margin-top: 15px; ">1. BATCH</p> -->



            </center>
        </section>


</body>


</html>