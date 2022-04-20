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
            size: A4 landscape
        }
    </style>
</head>

<body class="A4 landscape">
<section class="sheet padding-10mm" style="height: auto;">
        <table width="100%" class="kop">
            <tr>
                <td style="border:none;">
                    <img src={{ asset("asset/logo/$logo") }} style="height:120px; width:auto;" alt="Your Picture">
                </td>
                <td class="tengah" style="border:none;">
                    <h1 style="font-weight: bolder; margin-bottom: -15px">
                        {{$nama}}
                    </h1>
                    <h3 style="margin-bottom: -0px">
                        {{$alamat}}
                    </h3>
                    <h5>
                        {{$alamat}}
                    </h5>
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
                    <td rowspan="2" colspan="2" style="text-align: center;">
                        CATATAN<br>PELATIHAN HIGIENE DAN SANITASI
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="3">
                        Nomor Kode
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="2">
                        BAGIAN

                    </td>


                </tr>
                <tr> </tr>
                <tr>
                    <td rowspan="3">
                        Disusun Oleh <br>
                        {{$row['laporan_diajukan']}} <br>
                        Tanggal <br>
                        {{$row['tgl_diajukan']}}
                    </td>
                    <td rowspan="3" colspan="4">
                        Disetujui Oleh <br>
                        {{$row['laporan_diterima']}} <br>
                        Tanggal <br>
                        {{$row['tgl_diajukan']}}
                    </td>
                    <td rowspan="3">
                        Unit
                    </td>
                </tr>
            </table>
            @endforeach
            <br><br>
            <table class="table isi table-bordered">
                        <tr>
                            <td colspan="6">MASUK</td>
                            <td colspan="6">KELUAR</td>
                        </tr>
                        <tr>
                            <td>Tgl</td>
                            <td>No. Lot</td>
                            <td>Pemasok</td>
                            <td>Jumlah</td>
                            <td>No.Control</td>
                            <td>Tgl. Kadaluarsa</td>
                            <td>Tgl</td>
                            <td>Untuk Produk</td>
                            <td>No. Batch</td>
                            <td>Jumlah</td>
                            <td>Sisa</td>
                            <td>Paraf</td>
                        </tr>
                        <?php $cek = 1; ?>
                            @foreach($masuk as $row)
                            
                            <tr>
                            <td>{{$row['tanggal']}}</td>
                            <td>{{$row['no_loth']}}</td>
                            <td>{{$row['pemasok']}}</td>
                            <td>{{$row['jumlah']}}</td>
                            <td>{{$row['no_kontrol']}}</td>
                            <td>{{$row['kedaluwarsa']}}</td>
                            @foreach($keluar as $row)
                            <?php $i=1?>
                            @if($cek==$i)
                            <td>{{$row['tanggal']}}</td>
                            <td>{{$row['untuk_produk']}}</td>
                            <td>{{$row['no_batch']}}</td>
                            <td>{{$row['jumlah']}}</td>
                            <td>{{$row['sisa']}}</td>
                            <td> </td>
                            @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                           @endif
                           <?php $i++;?>
                            @endforeach
                            </tr>
                            <?php $cek++;?>
                            @endforeach
                            
                        
                    </table>

        </center>
    </section>

</body>

</html>