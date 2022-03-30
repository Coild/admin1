<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        @page {
            size: auto;
            margin: 5mm;
        }
        /* Kop Surat */
.kop{
  border-bottom: 5px solid black;
}

.rangkasurat{
  width: 980px;
  margin: 0 auto;
  background-color:white;
  padding: 20px;
}

.tengah{
  text-align: center;
}    

/* isi */
.isi{
    text-align: center;
}
    </style>
    <script>
        $(document).ready(function() {
            $('#btnPrint').click(function() {
                $('#btnPrint').hide();
                var css = '@page { size: a4; }',
                    head = document.head || document.getElementsByTagName('head')[0],
                    style = document.createElement('style');
                style.type = 'text/css';
                style.media = 'print';
                if (style.styleSheet) {
                    style.styleSheet.cssText = css;
                } else {
                    style.appendChild(document.createTextNode(css));
                }
                head.appendChild(style);
                window.print();
            });
        })
    </script>

</head>

<body>
<center>
    <div class="container">
        <!-- Kop Surat -->
        <div class="rangkasurat">
            <table width="100%" class="kop">
                <tr>
                    <td>
                        <img src="logo.jpg" style= "height: 150px;" alt="Your Picture">
                    </td>
                    <td class="tengah">
                        <h1 style="font-weight: bolder;">
                            UD. SEMELOTO
                        </h1>
                        <h3>
                            JL. KEMERDEKAAN RT.019/RW.010 DUSUN PEMANGONG
                        </h3>
                        <h3>
                            DESA LENANGGUAR KABUPATEN SUMBAWA
                        </h3>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Isi Surat -->
        <!-- <h4 style="text-align: center;">CATATAN PENGGUNAAN ALAT</h4> -->
        <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <table class="table table-bordered">
                    <tr>
                        <td rowspan="2">
                            <img src="logo.jpg" style= "height: 250px;" alt="Your Picture">
                        </td>
                        <td style="text-align: center;">
                            CATATAN PENERIMAAN DAN<br>PENGELUARAN BAHAN AWAL
                        </td>
                        <td>Halaman: </td>
                    </tr>
                    <tr>
                        <td>
                            RUANG<br>GUDANG BAHAN BAKU DAN<br>KEMASAN
                        </td>
                        <td>
                            NOMOR KODE 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            NAMA BAHAN PENGEMAS <br>
                            Standing pouch
                        </td>
                        <td>
                            UNTUK PRODUK <br>
                            Lotomotong, kunyit mentimun, beras sangrai, seme mamaQ, saffron dan green leaf
                        </td>
                        <td>
                            UNIT
                        </td>
                    </tr>
                </table>

                <br>

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
                    <tr>
                        <td>isi 1</td>
                        <td>isi 2</td>
                        <td>isi 3</td>
                        <td>isi 4</td>
                        <td>isi 5</td>
                        <td>isi 6</td>
                        <td>isi 7</td>
                        <td>isi 8</td>
                        <td>isi 9</td>
                        <td>isi 10</td>
                        <td>isi 11</td>
                        <td>isi 12</td>
                    </tr>
                </table>
            </div>
        </div>
    </center>

    </div>


    <section>
        <button type="button" id="btnPrint" class="btn btn-primary pull-right">Print</button>
    </section>

</body>

</html>