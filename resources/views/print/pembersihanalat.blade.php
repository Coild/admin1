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
                    <img src={{ asset('asset/logo/').$logo }} style="height:120px; width:auto;" alt="Your Picture">
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
                  <h4 style="text-align: center;">CATATAN PEMBERSIHAN ALAT</h4>
                  <div class="form-group">
                      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                          <table class="table table-bordered" style="text-align: center;">
                              <tr>
                                  <td rowspan="2">
                                      <img src="logo.jpg" style="height: 250px;" alt="Your Picture">
                                  </td>
                                  <td>
                                      CATATAN PEMBERSIHAN ALAT
                                  </td>
                                  <td>
                                      Halaman
                                  </td>
                              </tr>
                              <tr>
                                  <td>{{ $dataProtap['protap_ruangan'] }}</td>
                                  <td>Nomor: <br> Tanggal Berlaku : </td>
                              </tr>
                              <tr>
                                  <td>
                                      Disusun Oleh : {{ $dataProtap['protap_diajukan'] }} <br>
                                      Tanggal <br>
                                      {{ $dataProtap['protap_tgl_diajukan'] }}
                                  </td>
                                  <td>
                                      Disetujui Oleh : {{ $dataProtap['protap_diterima'] }} <br>
                                      Tanggal <br>
                                      {{ $dataProtap['protap_tgl_diterima'] }}
                                  </td>
                                  <td>
                                      Mengganti Nomor <br>
                                      Tanggal <br>
                                  </td>
                              </tr>
                          </table>
                          <br>
                          <table class="table isi table-bordered">
                              <tr>
                                  <td colspan="3">
                                      <img src="logo.jpg" style="height: 60px;" alt="Your Picture">
                                  </td>
                                  <td colspan="4">
                                      CATATAN PEMBERSIHAN ALAT
                                  </td>
                              </tr>
                              <tr>
                                  <td style="text-align: left;" colspan="7">Dilaksanakan sesuai POB Nomor: {{ $data['pob_nomor'] }} <br>
                                      Tanggal: {{ $data['tanggal'] }}
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan="7">
                                      NAMA ALAT: {{ $data['nama_alat'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      TIPE/MEREK: {{ $data['type_merk'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      RUANG: {{ $data['nama_ruangan'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  </td>
                              </tr>
                              <tr>
                                  <td rowspan="3">No</td>
                                  <td colspan="6">PEMBERSIHAN</td>
                              </tr>
                              <tr>
                                  <td colspan="2">Mulai</td>
                                  <td colspan="2">Seleseai</td>
                                  <td rowspan="2">Oleh</td>
                                  <td rowspan="2">Ket</td>
                              </tr>
                              <tr>
                                  <td>Tgl</td>
                                  <td>Jam</td>
                                  <td>Tgl</td>
                                  <td>Jam</td>
                              </tr>
                              @foreach ($dataDetil as $row)
                              <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($row['mulai_pembersihan'] != null)
                                        {{ \Carbon\Carbon::parse($row['mulai_pembersihan'])->format('j F, Y') }}
                                    @else
                                        <div class="badge badge-danger"> belum</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($row['mulai_pembersihan'] != null)
                                        {{ \Carbon\Carbon::parse($row['mulai_pembersihan'])->format('h:i:s A') }}
                                    @else
                                        <div class="badge badge-danger"> belum</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($row['selesai_pembersihan'] != null)
                                        {{ \Carbon\Carbon::parse($row['selesai_pembersihan'])->format('j F, Y') }}
                                    @else
                                        <div class="badge badge-danger"> belum</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($row['selesai_pembersihan'] != null)
                                        {{ \Carbon\Carbon::parse($row['selesai_pembersihan'])->format('h:i:s A') }}
                                    @else
                                        <div class="badge badge-danger"> belum</div>
                                    @endif
                                </td>
                                <td>{{$row['diperiksa_oleh']}}</td>
                                <td>{{$row['keterangan']}}</td>
                            </tr>    
                              @endforeach
                              
                          </table>
                      </div>
                  </div>
    </section>



</body>

</html>
