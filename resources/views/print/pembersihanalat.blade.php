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
                            {{ 'Jalan' }}
                        </h1>
                        <p style="margin-bottom: -5px; font-size: 28px; ">
                            {{ 'Nomo' }}
                        </p>
                        <p style="margin-bottom: -5px; font-size: 16px;">
                            No Handphone : {{ '123' }}
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
                                  <td>RUANGAN</td>
                                  <td>Nomor: <br> Tanggal Berlaku</td>
                              </tr>
                              <tr>
                                  <td>
                                      Disusun Oleh <br>
                                      Tanggal <br>
                                      09 Oktober 2019
                                  </td>
                                  <td>
                                      Disetujui Oleh <br>
                                      Tanggal <br>
                                      09 Oktober 2019
                                  </td>
                                  <td>
                                      Mengganti Nomor <br>
                                      Tanggal <br>
                                      09 Oktober 2019
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
                                  <td style="text-align: left;" colspan="7">Dilaksanakan sesuai POB Nomor:<br>
                                      Tanggal:
                                  </td>
                              </tr>
                              <tr>
                                  <td colspan="7">
                                      NAMA ALAT: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      TIPE/MEREK: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      RUANG: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                              <tr>
                                  <td>isi 1</td>
                                  <td>isi 2</td>
                                  <td>isi 3</td>
                                  <td>isi 4</td>
                                  <td>isi 5</td>
                                  <td>isi 6</td>
                                  <td>isi 7</td>
                              </tr>
                          </table>
                      </div>
                  </div>
    </section>



</body>

</html>
