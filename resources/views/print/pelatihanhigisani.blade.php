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
                            PROGRAM PELATIHAN<br> HEIGIENE DAN SANITASI <br> SERTA DOKUMENTASI
                        </td>
                        <td>Halaman: </td>
                    </tr>
                    <tr>
                        <td>
                            -
                        </td>
                        <td>
                            Sesuai dengan POB<br>
                            Nomor: <br>
                        </td>
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
                        <td>MATERI</td>
                        <td>PESERTA</td>
                        <td>PELATIH</td>
                        <td>METODE PELATIHAN<br>ATAU ALAT BANTU</td>
                        <td>JADWAL</td>
                        <td>METODE PENILAIAN</td>
                    </tr>
                    <tr style="text-align: left;">
                        <td>1.pengenalan hasil Cpkb</td>
                        <td>isi 1</td>
                        <td>isi 2</td>
                        <td>isi 3</td>
                        <td>isi 4</td>
                        <td>isi 5</td>
                    </tr>
                    <tr>
                        <td>MATERI</td>
                        <td>PESERTA</td>
                        <td>PELATIH</td>
                        <td>METODE PELATIHAN<br>ATAU ALAT BANTU</td>
                        <td>JADWAL</td>
                        <td>METODE PENILAIAN</td>
                    </tr>
                    <tr style="text-align: left;">
                        <td>2. Hegiene dan sanitasi
                            <br>
                            1.1.1. Perlunya<br>
                            pemakaian pakaian kerja dan perlengka pan kerja seperti :
                            masker, sarung tangan,
                            alas kaki.
                            <br>
                            2.1.2.	perlunya mencuci tangan sebelum bekerja.<br>
                            2.1.3.	penjelasan tentang kekhusunan bekerja dibagian
                            tertentu, misal:<br>
                            Pelarangan personil
                            memakai perhiasan,
                            jam tangan, bulu mata palsu dan make up berlebihan diruangan produksi.<br>
                            2.1.4.	personil yang sakit danmempunyai luka terbuka tidak diperkenanka n bekerja dalam pengolahan kosmetik. <br>
                            2.2.	pengetahuan tentang mikroba terutama tentang bakteri dan bagaimana cara mencegah agar bakteri tidak berkembang biak.<br>
                            2.3.	perlunya kebiasaan bekerja dalam ruangan dengan pakaian dan peralatan/mesi n yang bersih. <br>
                            2.4.	sanitasi<br>
                            2.4.1.	penjelasan mengenai sanitasi bangunan dan fasilitas. <br>
                            2.4.2.	penjelasan dan latihan mengenai sanitasi peralatan dan perlengkapan. <br>
                            2.4.3. penjelasan dan latihan mengenai penanganan bahan awal dan produk. <br>
                            2.4.4 latihan mengenai tata cara memasuki ruang produksi.
                            </td>
                        <td>isi 1</td>
                        <td>isi 2</td>
                        <td>isi 3</td>
                        <td>isi 4</td>
                        <td>isi 5</td>
                    </tr>
                    <tr>
                        <td>MATERI</td>
                        <td>PESERTA</td>
                        <td>PELATIH</td>
                        <td>METODE PELATIHAN<br>ATAU ALAT BANTU</td>
                        <td>JADWAL</td>
                        <td>METODE PENILAIAN</td>
                    </tr>
                    <tr style="text-align: left;">
                        <td>3.	Pelatihan Tambahan<br>
                            3.1	Penjelasan jika ada perubahan peraturan baik mengenai CPKB, POB, spesifikasi baru, alat baru dan produksi baru.<br>
                            3.2	Mengefaluasi kesalahan yang pernah terjadi dan cara
                            mengatasinya.<br>
                            </td>
                        <td>isi 1</td>
                        <td>isi 2</td>
                        <td>isi 3</td>
                        <td>isi 4</td>
                        <td>isi 5</td>
                    </tr>
                    <tr>
                        <td>MATERI</td>
                        <td>PESERTA</td>
                        <td>PELATIH</td>
                        <td>METODE PELATIHAN<br>ATAU ALAT BANTU</td>
                        <td>JADWAL</td>
                        <td>METODE PENILAIAN</td>
                    </tr>
                    <tr style="text-align: left;">
                        <td>4. Keselamatan dan kesehatan kerja.<br>
                            4.1	Pelatihan<br>
                            pertolongan pertama pada kecelakaan.<br>
                            4.2	Penanganan<br>
                            bahan kimia yang beresiko
                            terhadap keselamatan kerja misal korosif/asam kuat/basa kuat<br>
                            4.3	Penanggulangan bahaya kebakaran<br>
                            4.4	Keselamatan kerja.<br>
                            <br>
                            </td>
                        <td>isi 1</td>
                        <td>isi 2</td>
                        <td>isi 3</td>
                        <td>isi 4</td>
                        <td>isi 5</td>
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