@extends('layout.app')
@section('title')
    <title>Tambah Pabrik</title>
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

    <style>
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

        .valid1 {
            color: green;
        }

        .valid1:before {
            position: relative;
            left: -35px;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid1 {
            color: red;
        }

        .invalid1:before {
            position: relative;
            left: -35px;
            content: "✖";
        }
    </style>

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Daftar Pabrik </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Admin</li>
            </ol>
            <div class="row">
                <!--  -->
                @if (Session::has('message'))
                    <p class="alert alert-danger">{{ Session::get('message') }}</p>
                @endif
                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                            Tambah Pabrik
                        </button>
                        <table class="table" id="tabel1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pabrik</th>
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
                                            {{ $row['nama'] }}
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" id="detil" data-toggle="modal"
                                                data-target="#lihat" data-nama="{{ $row['nama'] }}"
                                                data-alamat="{{ $row['alamat'] }}"
                                                data-nohp="{{ $row['no_hp'] }}">Lihat</button>
                                            <button id="klik" class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#resetpass" data-id="{{ $row['pabrik_id'] }}">Reset</button>
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
                            Tambah Pabrik
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <div class="container">
                            <form action="/register_pabrik" method="post" id='forminput1'>
                                @csrf

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
                                    <input class="form-control 1" name="username" id="inputUsername" type="text"
                                        placeholder="name@example.com" />
                                    <label for="inputEmail">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control 1" name="pabrik" id="inputEmail" type="text"
                                        placeholder="name@example.com" />
                                    <label for="inputEmail">Pabrik</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control 1" name="password" id="psw1" type="text"
                                        placeholder="Create a password" />
                                    <label for="psw1">Password</label>

                                    <div id="message1" class="mb-2">
                                        <h5>Password harus mengandung:</h5>
                                        <p id="letter1" class="invalid1">Minimal 1 buah <b>huruf kecil</b></p>
                                        <p id="capital1" class="invalid1">Minimal 1 buah <b>huruf kapital </b>
                                        </p>
                                        <p id="number1" class="invalid1">Minimal 1 buah <b>angka</b></p>
                                        <p id="special1" class="invalid1">Minimal 1 buah <b>spesial karakter (@,#,_)
                                                &nbsp;</b></p>
                                        <p id="length1" class="invalid1">Minimmal <b>8 karakter</b></p>
                                    </div>
                                    <div id="lulus1" class="mb-2">
                                        <p class="valid1"> password kuat </p>
                                    </div>

                                </div>
                                <div class="mt-4 mb-0">
                                    <div class="d-grid justify-content-center">
                                        {{-- <a href="#" onclick="validatePassword(1)" style="width: 200px" class="btn btn-primary btn-block">Tambah
                                        Akun </a> --}}
                                        <button disabled id="lolos1" type="button" class="btn btn-primary"
                                            onclick="salert1(1)">Simpan</button>
                                    </div>
                                </div>
                            </form>
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
                            <form action="/reset_passwordu" method="post" class="form-input" id='forminput7'>
                                @csrf
                                <input type="hidden" name="id" id="isi_idpass">
                                <div class="form-floating mb-3">
                                    <input class="form-control 7" name="baru" id="psw" type="text"
                                        placeholder="masukan password" autocomplete="off"
                                        onkeypress="return event.keyCode !=13;" />
                                    <label for="psw">Password Baru</label>

                                </div>
                                <div id="message" class="mb-2">
                                    <h5>Password harus mengandung:</h5>
                                    <p id="letter" class="invalid">Minimal 1 buah <b>huruf kecil</b></p>
                                    <p id="capital" class="invalid">Minimal 1 buah <b>huruf kapital </b>
                                    </p>
                                    <p id="number" class="invalid">Minimal 1 buah <b>angka</b></p>
                                    <p id="special" class="invalid">Minimal 1 buah <b>spesial karakter (@,#,_)
                                            &nbsp;</b></p>
                                    <p id="length" class="invalid">Minimal <b>8 karakter</b></p>
                                </div>
                                <div id="lulus" class="mb-2">
                                    <p class="valid"> password kuat </p>
                                </div>
                                <button disabled id="lolos" type="button" class="btn btn-primary"
                                    onclick="salert1(7)">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
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

                            <div class="form-floating mb-3">
                                <input class="form-control" name="username" id="isi_alamat" type="text"
                                    placeholder="name@example.com" readonly />
                                <label for="isi_alamat">Alamat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="username" id="isi_nohp" type="text"
                                    placeholder="name@example.com" readonly />
                                <label for="isi_nohp">No HP</label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->
    </main>
    <script>
        $(document).on('click', "#klik", function() {
            var id = $(this).data('id');
            console.log("hai " + id);
            $("#isi_idpass").val(id);
            console.log("in " + $("#isi_idpass").val());
        })

        $(document).on('click', "#detil", function() {
            var nama = $(this).data('nama');
            var alamat = $(this).data('alamat');
            var nohp = $(this).data('nohp');

            console.log("hai " + nama);
            $("#isi_nama").val(nama);
            $("#isi_alamat").val(alamat);
            $("#isi_nohp").val(nohp);
        })

        // $("#inputPasswordConfirm").keyup(function() {
        //     if ($("#inputPassword").val() === $(this).val()) {
        //         document.getElementById("message").innerText = "";
        //         document.getElementById("message1").innerText = "";
        //     } else {
        //         document.getElementById("message").innerText = "Tidak Cocok";
        //         document.getElementById("message1").innerText = "Tidak Cocok";
        //     }
        // })
    </script>


    {{-- script strong --}}
    <script>
        var valdi = false;
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
        var valdi1 = false;
        var banned1 = [
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
            console.log(banned1);
            if (banned1.includes(e.key)) {
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
            var specialChar1 = /[\_\@\#]/g;
            if (myInput1.value.match(specialChar1)) {
                special1.classList.remove("invalid1");
                special1.classList.add("valid1");
            } else {
                special1.classList.remove("valid1");
                special1.classList.add("invalid1");
            }

            // Validate lowercase letters
            var lowerCaseLetters1 = /[a-z]/g;
            if (myInput1.value.match(lowerCaseLetters1)) {
                letter1.classList.remove("invalid1");
                letter1.classList.add("valid1");
            } else {
                letter1.classList.remove("valid1");
                letter1.classList.add("invalid1");
            }

            // Validate capital letters
            var upperCaseLetters1 = /[A-Z]/g;
            if (myInput1.value.match(upperCaseLetters1)) {
                capital1.classList.remove("invalid1");
                capital1.classList.add("valid1");
            } else {
                capital1.classList.remove("valid1");
                capital1.classList.add("invalid1");
            }

            // Validate numbers
            var numbers1 = /[0-9]/g;
            if (myInput1.value.match(numbers1)) {
                number1.classList.remove("invalid1");
                number1.classList.add("valid1");
            } else {
                number1.classList.remove("valid1");
                number1.classList.add("invalid1");
            }

            // Validate length
            if (myInput1.value.length >= 8) {
                length1.classList.remove("invalid1");
                length1.classList.add("valid1");
            } else {
                length1.classList.remove("valid1");
                length1.classList.add("invalid1");
            }

            //lolos password 

            if (myInput1.value.length >= 8 && myInput1.value.match(numbers1) && myInput1.value.match(
                    upperCaseLetters1) && myInput1.value.match(lowerCaseLetters1) && myInput1.value.match(
                    specialChar1)) {
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
