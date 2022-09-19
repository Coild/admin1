@extends('layout.app')
@section('title')
    <title>Tambah Auditor</title>
@endsection

@section('content')
    <style>
        #message {
            display: none;
            background: #f1f1f1;
            color: #000;
            position: relative;
            padding: 10px;
            margin-top: 10px;
        }

        #message p {
            padding: 15px 35px;
            font-size: 15px;
            margin: -5px;
        }

        #lulus {
            display: none;
            background: #f1f1f1;
            color: #000;
            position: relative;
            padding: 20px;
            margin-top: 10px;
        }

        #lulus p {
            padding: 15px 35px;
            font-size: 15px;
            margin: -5px;
        }

        #message1 {
            display: none;
            background: #f1f1f1;
            color: #000;
            position: relative;
            padding: 10px;
            margin-top: 10px;
        }

        #message1 p {
            padding: 15px 35px;
            font-size: 15px;
            margin: -5px;
        }

        #lulus1 {
            display: none;
            background: #f1f1f1;
            color: #000;
            position: relative;
            padding: 20px;
            margin-top: 10px;
        }

        #lulus1 p {
            padding: 15px 35px;
            font-size: 15px;
            margin: -5px;
        }

        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
        }
    </style>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Auditor </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Admin</li>
            </ol>
            <div class="row">
                @if (Session::has('message'))
                    <p class="alert alert-danger">{{ Session::get('message') }}</p>
                @endif
                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                            Tambah Auditor
                        </button>



                        <table class="table" id="tabel1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Auditor</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>
                                            {{ $i }}
                                        </td>
                                        <td>
                                            {{ $row['namadepan'] . ' ' . $row['namabelakang'] }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" id="detil" data-toggle="modal"
                                                data-target="#lihat" data-nama="{{ $row['nama'] }}"
                                                data-alamat="{{ $row['alamat'] }}"
                                                data-nohp="{{ $row['no_hp'] }}">Lihat</button>

                                            <button id="klik" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#resetpass" data-id="{{ $row['id'] }}">Reset</button>

                                            <form action="/hapus_auditor" method="post"
                                                id="formHapusAuditor{{ $row['id'] }}" class="float-left pr-2">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row['id'] }}">
                                                <input type="hidden" name="namadepan" value="{{ $row['namadepan'] }}">
                                                <input type="hidden" name="namabelakang"
                                                    value="{{ $row['namabelakang'] }}">
                                                <input type="hidden" name="level" value="{{ $row['level'] }}">

                                                <button class="btn btn-danger btn-sm"
                                                    onclick="buttonHapusAuditor({{ $row['id'] }})" type="button">
                                                    Hapus</button>

                                            </form>
                                        </td>
                                    </tr>

                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- <a class="btn btn-primary" href="#">Edit</a>
                                                                                                                                                                                                                                                                                    <a class="btn btn-primary" href="#">Cetak</a> -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalForm" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Tambah Auditor
                        </h4>
                    </div>
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="container">
                            <form action="/register_audit" method="post" id='forminput1'>
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3 mb-md-0">
                                            <input class="form-control 1" name="namadepan" id="inputFirstName"
                                                type="text" placeholder="Enter your first name" />
                                            <label for="inputFirstName">First name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input class="form-control 1" name="namabelakang" id="inputLastName"
                                                type="text" placeholder="Enter your last name" />
                                            <label for="inputLastName">Last name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control 1" name="username" id="inputEmail" type="text"
                                        placeholder="name@example.com" />
                                    <label for="inputEmail">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control 1" name="password" id="psw" type="password"
                                        placeholder="*********" />
                                    <label for="inputEmail">Password</label>
                                    <div id="message">
                                        <h5>Password harus mengandung:</h5>
                                        <p id="letter" class="invalid">Minimal 1 buah <b>huruf kecil</b></p>
                                        <p id="capital" class="invalid">Minimal 1 buah <b>huruf kapital </b>
                                        </p>
                                        <p id="number" class="invalid">Minimal 1 buah <b>angka</b></p>
                                        <p id="special" class="invalid">Minimal 1 buah <b>spesial karakter (@,#,_)
                                                &nbsp;</b></p>
                                        <p id="length" class="invalid">Minimal <b>8 characters</b></p>
                                    </div>
                                    <div id="lulus">
                                        <p class="valid"> password kuat </p>
                                    </div>
                                </div>


                                <div class="mt-4 mb-0">
                                    <div class="d-grid justify-content-center">
                                        <button type="button" onclick="salert1(1)" id="lolos" style="width: 200px"
                                            disabled class="btn btn-primary btn-block">Tambah
                                            Akun</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--  -->
    </main>
    <!-- Modal -->
    <div class="modal fade" id="lihat" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Detil Pabrik
                    </h4>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <div class="container">

                        <div class="form-floating mb-3">
                            <input class="form-control" name="username" id="isi_nama" type="text"
                                placeholder="name@example.com" readonly />
                            <label for="inputEmail">Username</label>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Modal Reset-->
    <div class="modal fade" id="resetpass" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">
                        Reset Password
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <div class="container">
                        <form action="/reset_passworda" method="post" id="forminput3">
                            @csrf
                            <input type="hidden" name="id" id="isi_idpass">
                            <div class="form-floating mb-3">
                                <input class="form-control 3" name="baru" id="psw1" type="text"
                                    placeholder="masukan password" autocomplete="off"
                                    onkeypress="return event.keyCode !=13;" />
                                <label for="inputEmail">Password Baru</label>
                                <div id="message1">
                                    <h5>Password harus mengandung:</h5>
                                    <p id="letter1" class="invalid">Minimal 1 buah <b>huruf kecil</b></p>
                                    <p id="capital1" class="invalid">Minimal 1 buah <b>huruf kapital </b>
                                    </p>
                                    <p id="number1" class="invalid">Minimal 1 buah <b>angka</b></p>
                                    <p id="special1" class="invalid">Minimal 1 buah <b>spesial karakter (@,#,_)
                                            &nbsp;</b></p>
                                    <p id="length1" class="invalid">Minimal <b>8 characters</b></p>
                                </div>
                                <div id="lulus1">
                                    <p class="valid"> password kuat </p>
                                </div>
                            </div>
                            <button type="button" id="lolos1" class="btn btn-primary" onclick="salert1(3)"
                                disabled>Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <!-- Modal -->
    <script>
        var valdi = false;
        var valdi1 = false;
        $(document).on('click', "#klik", function() {
            var id = $(this).data('id');
            console.log("hai " + id);
            $("#isi_idpass").val(id);
        })

        $(document).on('click', "#detil", function() {
            var nama = $(this).data('nama');
            var alamat = $(this).data('alamat');
            var nohp = $(this).data('nohp');

            console.log("hai " + nama);
            $("#isi_nama").val(nama);
            // $("#isi_alamat").val(alamat);
            // $("#isi_nohp").val(nohp);
        })
    </script>
    {{-- script strong --}}
    <script>
        var banned = [
            "<",
            ">",
            "%",
            "\"",
            "\'",
            "&",
            "|",
            "!"
        ];
        var myInput = document.getElementById("psw");
        myInput.addEventListener("keydown", function(e) {
            console.log(banned);
            if (banned.includes(e.key)) {
                e.preventDefault();
            }
        });
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var special = document.getElementById("special");
        var length = document.getElementById("length");
        var lolos = document.getElementById("lolos");

        // When the user clicks on the password field, show the message box
        myInput.onfocus = function() {
            if (!valdi) document.getElementById("message").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
            document.getElementById("message").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {

            // Validate lowercase letters
            var specialChar = /[\_\@\#]/g;
            if (myInput.value.match(specialChar)) {
                special.classList.remove("invalid");
                special.classList.add("valid");
            } else {
                special.classList.remove("valid");
                special.classList.add("invalid");
            }

            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
                letter.classList.remove("invalid");
                letter.classList.add("valid");
            } else {
                letter.classList.remove("valid");
                letter.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput.value.match(upperCaseLetters)) {
                capital.classList.remove("invalid");
                capital.classList.add("valid");
            } else {
                capital.classList.remove("valid");
                capital.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput.value.match(numbers)) {
                number.classList.remove("invalid");
                number.classList.add("valid");
            } else {
                number.classList.remove("valid");
                number.classList.add("invalid");
            }

            // Validate length
            if (myInput.value.length >= 8) {
                length.classList.remove("invalid");
                length.classList.add("valid");
            } else {
                length.classList.remove("valid");
                length.classList.add("invalid");
            }

            //lolos password 




            if (myInput.value.length >= 8 && myInput.value.match(numbers) && myInput.value.match(upperCaseLetters) &&
                myInput.value.match(lowerCaseLetters) && myInput.value.match(specialChar)) {
                lolos.disabled = false;
                document.getElementById("message").style.display = "none";
                document.getElementById("lulus").style.display = "block";
                valdi = true;
            } else {
                document.getElementById("message").style.display = "block";
                document.getElementById("lulus").style.display = "none";
                lolos.disabled = true;
                valdi = false;
            }

        }
    </script>

    {{-- script strong --}}
    <script>
        var banned = [
            "<",
            ">",
            "%",
            "\"",
            "\'",
            "&",
            "|",
            "!"
        ];
        var myInput1 = document.getElementById("psw1");
        myInput1.addEventListener("keydown", function(e) {
            console.log("psw1");
            if (banned.includes(e.key)) {
                e.preventDefault();
            }
        });
        var letter1 = document.getElementById("letter1");
        var capital1 = document.getElementById("capital1");
        var number1 = document.getElementById("number1");
        var special1 = document.getElementById("special1");
        var length1 = document.getElementById("length1");
        var lolos1 = document.getElementById("lolos1");

        // When the user clicks on the password field, show the message box
        myInput1.onfocus = function() {
            if (!valdi1) document.getElementById("message1").style.display = "block";
        }

        // When the user clicks outside of the password field, hide the message box
        myInput1.onblur = function() {
            document.getElementById("message1").style.display = "none";
        }

        // When the user starts to type something inside the password field
        myInput1.onkeyup = function() {

            // Validate lowercase letters
            var specialChar = /[\_\@\#]/g;
            if (myInput1.value.match(specialChar)) {
                special1.classList.remove("invalid");
                special1.classList.add("valid");
            } else {
                special1.classList.remove("valid");
                special1.classList.add("invalid");
            }

            // Validate lowercase letters
            var lowerCaseLetters = /[a-z]/g;
            if (myInput1.value.match(lowerCaseLetters)) {
                letter1.classList.remove("invalid");
                letter1.classList.add("valid");
            } else {
                letter1.classList.remove("valid");
                letter1.classList.add("invalid");
            }

            // Validate capital letters
            var upperCaseLetters = /[A-Z]/g;
            if (myInput1.value.match(upperCaseLetters)) {
                capital1.classList.remove("invalid");
                capital1.classList.add("valid");
            } else {
                capital1.classList.remove("valid");
                capital1.classList.add("invalid");
            }

            // Validate numbers
            var numbers = /[0-9]/g;
            if (myInput1.value.match(numbers)) {
                number1.classList.remove("invalid");
                number1.classList.add("valid");
            } else {
                number1.classList.remove("valid");
                number1.classList.add("invalid");
            }

            // Validate length
            if (myInput1.value.length >= 8) {
                length1.classList.remove("invalid");
                length1.classList.add("valid");
            } else {
                length1.classList.remove("valid");
                length1.classList.add("invalid");
            }

            //lolos password 




            if (myInput1.value.length >= 8 && myInput1.value.match(numbers) && myInput1.value.match(upperCaseLetters) &&
                myInput1.value.match(lowerCaseLetters) && myInput1.value.match(specialChar)) {
                lolos1.disabled = false;
                document.getElementById("message1").style.display = "none";
                document.getElementById("lulus1").style.display = "block";
                valdi1 = true;
            } else {
                document.getElementById("message1").style.display = "block";
                document.getElementById("lulus1").style.display = "none";
                lolos1.disabled = true;
                valdi1 = false;
            }

        }
    </script>
@endsection
