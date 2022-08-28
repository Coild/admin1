<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Ganti Password</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="js/recaptcha.js"></script>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
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
</head>

<body class="bg-primary1">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="text-center">
                    <img src="assets/img/bpom1.jpg" class="img-fluid" alt="Responsive image" background-repeat:>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Gantipassword</h3>
                                </div>
                                <div class="card-body">
                                    <form action="/gantipassword" method="post" id='forminput1' class="forminput1">
                                        @if (Session::has('message'))
                                            <p class="alert alert-info">{{ Session::get('message') }}</p>
                                        @endif
                                        @if (session('status'))
                                            <div class="alert alert-warning">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <div class="form-floating mb-3">
                                            <input name="lama" class="form-control 1 pass1" id="inputEmail" type="password"
                                                placeholder="password lama" required/>
                                            <label for="inputEmail">Password Lama</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input name="baru" class="form-control 1 pass2" id="psw" type="password"
                                                placeholder="Password Baru" required/>
                                            <label for="inputPassword">Password Baru</label>
                                            <div id="message">
                                                <h5>Password must contain the following:</h5>
                                                <p id="letter" class="invalid">Minimal 1 buah <b>huruf kecil</b></p>
                                                <p id="capital" class="invalid">Minimal 1 buah <b>huruf kapital </b>
                                                </p>
                                                <p id="number" class="invalid">Minimal 1 buah <b>angka</b></p>
                                                <p id="special" class="invalid">Minimal 1 buah <b>spesial karakter (@,#,_)</b></p>
                                                <p id="length" class="invalid">Minial <b>8 characters</b></p>
                                            </div>
                                            <div id="lulus">
                                                <p class="valid"> password kuat </p>
                                            </div>
                                        </div> 
                                        <div class="g-recaptcha" data-callback="recaptcha_callback"
                                            data-sitekey="{!! env('RECAPTCHA_SITE_KEY') !!}"></div>
                                        <p id="art" class="text-danger"></p>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <button onclick="salert1(1)" id="lolos" type="button"
                                                class="btn btn-primary">Ganti</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; BPOM</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    {{-- <script src="js/error.js"></script> --}}
    <script src="{{ asset('js/alert.js') }}"></script>
     {{-- script strong --}}
     <script> var valdi =false;
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
</body>

</html>
