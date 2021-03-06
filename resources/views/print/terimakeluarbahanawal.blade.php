<!DOCTYPE html>
<html lang="en">


<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
    <style>
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
</head>

<body class="A4 landscape">
    <section class="sheet padding-10mm" style="height: auto;">
        <table width="100%" class="kop">
            <tr>
                <td style="border:none;" width="30%">
                    <img src={{ asset("asset/logo/$logo") }} style="height:120px; width:auto;" alt="Your Picture">
                </td>
                <td width="70%" class="tengah" style="border:none;">
                    <center>
                        <h1 style="font-weight: bolder; margin-bottom: 0px; ">
                            {{ $nama }}
                        </h1>
                        <p style="margin-bottom: -5px; font-size: 28px; margin-bottom: 10px;">
                            {{ $alamat }}
                        </p>
                        <p style="margin-bottom: -5px; font-size: 16px; margin-bottom: 50px;">
                            No Handphone : {{ $nohp }}
                        </p>
                    </center>
                </td>
            </tr>
        </table>
        <center>
            <br>
            
            <table class="table table-bordered">
                <tr>
                    <td rowspan="4" style="text-align: center;">
                        <img src={{ asset("asset/logo/$logo") }} style="height:120px; width:auto;" alt="Your Picture">

                    </td>
                    <td rowspan="2" colspan="2" style="text-align: center;">
                        CATATAN<br>PENERIMAAN BAHAN
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="3" style="text-align: center;">
                        Nomor Kode <br> {{$data['kode']}}  
                    </td>
                </tr>
                <tr>
                    <td rowspan="2" colspan="2" style="text-align: center;">
                        BAGIAN
                        {{$protap['protap_ruangan']}}
                    </td>


                </tr>
                <tr> </tr>
                <tr>
                    <td rowspan="3"  style="text-align: center;">
                        Nama Bahan <br>
                        {{$data['nama']}}
                    </td>
                    <td rowspan="3" colspan="4" style="text-align: center;">
                        Untuk Produk <br>
                        {{$data['nama']}}
                    </td>
                    <td rowspan="3" style="text-align: center;">
                        Unit <br>
                        {{$data['jumlah']}}
                    </td>
                </tr>
            </table>
            
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
                @foreach ($masuk as $row)
                <tr>
                    <td>{{ $row['tanggal'] }}</td>
                    <td>{{ $row['no_loth'] }}</td>
                    <td>{{ $row['pemasok'] }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['no_kontrol'] }}</td>
                    <td>{{ $row['kedaluwarsa'] }}</td>
                    <?php $i = 1; ?>
                    @foreach ($keluar as $row)

                    @if ($cek == $i)
                    <td>{{ $row['tanggal'] }}</td>
                    <td>{{ $row['untuk_produk'] }}</td>
                    <td>{{ $row['no_batch'] }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['sisa'] }}</td>
                    <td> </td>
                    @elseif($i >= $cek && $cek >= count($masuk))
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $row['tanggal'] }}</td>
                    <td>{{ $row['untuk_produk'] }}</td>
                    <td>{{ $row['no_batch'] }}</td>
                    <td>{{ $row['jumlah'] }}</td>
                    <td>{{ $row['sisa'] }}</td>
                    <td> </td>
                    @elseif(count($keluar) <= $cek) <td>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                </tr>
                @endif
                <?php $i++; ?>
                @endforeach
                </tr>
                <?php $cek++; ?>
                @endforeach


            </table>

        </center>
    </section>

</body>

</html>