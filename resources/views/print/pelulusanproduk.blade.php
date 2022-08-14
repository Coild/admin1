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
                    <td style="border:none;" width="30%">
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
                <h2>CATATAN PELULUSAN PRODUK</h2>

                <br>
                <h4 style="text-align: left; margin-bottom: -17px; margin-top:-10px;">Nama Produk: {{$data['nama_bahan']}}</h4>
                <h4 style="text-align: left; margin-bottom: -17px;">No Batch: {{$data['no_batch']}}</h4>
                <h4 style="text-align: left; ">Tanggal Pelulusan: {{$data['tanggal']}}</h4>
                <table class="table isi table-bordered">
                    <tr>
                        <td>No</td>
                        <td>Daftar Periksa</td>
                        <td>Hasil Pemeriksaan</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Nama produk</td>
                        <td>{{$data['nama_bahan']}}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Nomor Batch</td>
                        <td>{{$data['no_batch']}}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Kedaluwarsa</td>
                        <td>{{$data['kedaluwarsa']}}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Nama Distributor</td>
                        <td>{{$data['nama_pemasok']}}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Tanggal</td>
                        <td>{{$data['tanggal']}}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Warna</td>
                        <td>{{$data['warna']}}</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Bau</td>
                        <td>{{$data['bau']}}</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Ph</td>
                        <td>{{$data['ph']}}</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Berat Jenis</td>
                        <td>{{$data['berat_jenis']}}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Kesimpulan</td>
                        <td>DILULUSKAN</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Diperiksa Oleh,<br> Analis QC <br><br><br><br><br></td>
                        <td>Disetujui Oleh,<br> Kepala Bagian Pengawasan Mutu <br><br><br><br><br></td>
                    </tr>
                    <!-- <tr>
                        <td></td>
                        <td style="height: 100px; text-align: bottom">(TTD)</td>
                        <td style="height: 100px;">(TTD)</td>
                    </tr> -->

                </table>
            </center>
        </section>
</body>


</html>
