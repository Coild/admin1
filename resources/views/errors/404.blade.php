<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/login.css" rel="stylesheet" />

    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-center">
    <div class="container-fluid">
        <div class="row d-flex align-self-center">
            <div class="col-lg-4 col-md-4 container">
                <div class="text-center">
                    <img src="assets/img/bpom1.jpg" style="width: 25%; margin-top:5%;" class="img-fluid"
                        alt="Responsive image" background-repeat:>
                </div>

                <h1 style="text-align: center">{{ '404 ' }}</h1>
                <h2 style="text-align: center">{{ 'Halaman Tidak Ditemukan ' }}</h2>
                <br><br><br>
                <div class="d-flex justify-content-center">

                    <button style="align-content: center" class="btn btn-lg btn-primary d-flex justify-content-center"
                        onclick="history.back()">Kembali</button>
                </div>
            </div>

        </div>
    </div>
    <script src="js/scripts.js"></script>
    <script src="js/recaptcha.js"></script>
</body>

</html>
