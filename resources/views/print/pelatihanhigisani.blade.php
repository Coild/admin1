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
            <table class="table table-bordered">
                <tr>
                    <td rowspan="4">
                        <img src={{ asset("asset/logo/$logo") }} style="height: 100px; width:auto;" ;alt="Your Picture">
                    </td>
                    <td rowspan="2" style="text-align: center;">
                        CATATAN<br>PENGMBILAN BAHAN KEMASAN
                    </td>
                    <td colspan="3">Halaman:</td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="3">
                        Nomor: {{$protap['protap_nomor']}}<br>
                        Tanggal Berlaku: {{$protap['protap_tgl_diterima']}}<br>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">
                        BAGIAN <br>
                        {{$protap['protap_ruangan']}}

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
                        {{$protap['protap_diajukan']}} <br>
                        Tanggal <br>
                        {{$protap['protap_tgl_diajukan']}}
                    </td>
                    <td rowspan="3">
                        Disetujui Oleh <br>
                        {{$protap['protap_diterima']}} <br>
                        Tanggal <br>
                        {{$protap['protap_tgl_diterima']}}
                    </td>
                    <td rowspan="3" colspan="3">
                        Mengganti Nomor <br>
                        - <br>
                        Tanggal <br>
                        -
                    </td>
                </tr>
            </table>
            <br><br>
            <table>

                <tr>
                    <td scope="col">MATERI</td>
                    <td scope="col">PESERTA</td>
                    <td scope="col">PELATIH</td>
                    <td scope="col">METODE PELATIHAN<br>ATAU ALAT BANTU</td>
                    <td scope="col">JADWAL</td>
                    <td scope="col">METODE PENILAIAN</td>
                </tr>
                <tr>
                    <td scope="col">{{$data['materi_pelatihan']}}</td>
                    <td scope="col">{{$data['peserta_pelatihan']}}</td>
                    <td scope="col">{{$data['pelatih']}}</td>
                    <td scope="col">{{$data['metode_pelatihan']}}</td>
                    <td scope="col">{{$data['jadwal_mulai_pelatihan']}} -
                        {{$data['jadwal_berakhir_pelatihan']}}
                    </td>
                    <td scope="col">{{$data['metode_penilaian']}}</td>
                </tr>


            </table>

        </center>
    </section>

</body>

</html>