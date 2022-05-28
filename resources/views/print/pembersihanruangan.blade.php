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
    <section class="sheet padding-10mm" style="height: auto;">
        <table width="100%" class="kop">
            <tr>
                <td style="border:none;" width="30%">
                    <img src={{ asset('asset/logo/logo.png') }} style="height:120px; width:auto;" alt="Your Picture">
                </td>
                <td width="70%" class="tengah" style="border:none;">
                    <center>
                        <h1 style="font-weight: bolder; margin-bottom: -15px">
                            {{ $alamat }}
                        </h1>
                        <p style="margin-bottom: -5px; font-size: 28px; ">
                            {{ $nama }}
                        </p>
                        <p style="margin-bottom: -5px; font-size: 16px;">
                            No Handphone : {{ $nohp }}
                        </p>
                    </center>
                </td>
            </tr>
        </table>
        <br>
        <!-- Isi Surat -->
        <!-- <h2 style="text-align: center;">Pengolahan Batch</h2> -->
        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <img src="logo.jpg" style="height: 250px;" alt="Your Picture">
                        </td>
                        <td style="text-align: center;">
                            CATATAN PEMBERSIHAN RUANGAN
                        </td>
                    </tr>
                    <tr>
                        <td style="border-right-color:white;">
                            Dilaksanakan Sesuai Prosedur Nomor
                        </td>
                        <td>
                            : {{ $data['nomer_prosedur'] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="border-right-color:white;">
                            Tanggal
                        </td>
                        <td>
                            : {{ $data['tanggal_prosedur']}}
                        </td>
                    </tr>
                    <tr>
                        <td style="border-right-color:white;">
                            Ruangan
                        </td>
                        <td>
                            : {{ $data['nama_ruangan']}}
                        </td>
                    </tr>
                    <tr>
                        <td style="border-right-color:white;">
                            Cara Pembersihan
                        </td>
                        <td>
                            : {{ $data['cara_pembersihan']}}
                        </td>
                    </tr>
                </table>

                <br>

                <table class="table isi table-bordered">
                    <tr>
                        <td rowspan="3">No</td>
                        <td colspan="8">Bagian yang Dibersihkan</td>
                        <td rowspan="3">Pelaksana</td>
                        <td rowspan="3">Diperiksa Oleh</td>
                        <td rowspan="3">Keterangan</td>
                    </tr>
                    <tr>
                        <td colspan="2">Lantai/Dinding</td>
                        <td colspan="2">Meja</td>
                        <td colspan="2">Jendela</td>
                        <td colspan="2">Langit-langit</td>
                    </tr>
                    <tr>
                        <td>Tgl</td>
                        <td>Jam</td>
                        <td>Tgl</td>
                        <td>Jam</td>
                        <td>Tgl</td>
                        <td>Jam</td>
                        <td>Tgl</td>
                        <td>Jam</td>
                    </tr>
                    
                        @foreach ($dataDetail as $row)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>
                                @if ($row['lantai'] != null)
                                    {{ \Carbon\Carbon::parse($row['lantai'])->format('j F, Y') }}
                                @else
                                    <div class="badge badge-danger"> belum</div>
                                @endif
                            </td>
                            <td>
                                @if ($row['lantai'] != null)
                                    {{ \Carbon\Carbon::parse($row['lantai'])->format('h:i:s A') }}
                                @else
                                    <div class="badge badge-danger"> belum</div>
                                @endif
                            </td>
                            <td>
                                @if ($row['meja'] != null)
                                    {{ \Carbon\Carbon::parse($row['meja'])->format('j F, Y') }}
                                @else
                                    <div class="badge badge-danger"> belum</div>
                                @endif
                            </td>
                            <td>
                                @if ($row['meja'] != null)
                                    {{ \Carbon\Carbon::parse($row['meja'])->format('h:i:s A') }}
                                @else
                                    <div class="badge badge-danger"> belum</div>
                                @endif
                            </td>
                            <td>
                                @if ($row['jendela'] != null)
                                    {{ \Carbon\Carbon::parse($row['jendela'])->format('j F, Y') }}
                                @else
                                    <div class="badge badge-danger"> belum</div>
                                @endif
                            </td>
                            <td>
                                @if ($row['jendela'] != null)
                                    {{ \Carbon\Carbon::parse($row['jendela'])->format('h:i:s A') }}
                                @else
                                    <div class="badge badge-danger"> belum</div>
                                @endif
                            </td>
                            <td>
                                @if ($row['langit'] != null)
                                    {{ \Carbon\Carbon::parse($row['langit'])->format('j F, Y') }}
                                @else
                                    <div class="badge badge-danger"> belum</div>
                                @endif
                            </td>
                            <td>
                                @if ($row['langit'] != null)
                                    {{ \Carbon\Carbon::parse($row['langit'])->format('h:i:s A') }}
                                @else
                                    <div class="badge badge-danger"> belum</div>
                                @endif
                            </td>
                            <td> {{ $row['pelaksana'] }}</td>
                            <td>{{ $row['diperiksa_oleh'] }}</td>
                            <td>{{ $row['keterangan'] }}</td>
                        </tr>
                        @endforeach
                    
                </table>
            </div>
        </div>
    </section>





</body>

</html>
