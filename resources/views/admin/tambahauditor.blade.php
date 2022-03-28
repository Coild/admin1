@extends('layout.app')
@section('title')
<title>Tambah Auditor

</title>
@endsection

@section('content')
<main>
    <div class="container">
        <form action="/register_audit" method="post">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" name="namadepan" id="inputFirstName" type="text" placeholder="Enter your first name" />
                        <label for="inputFirstName">First name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control" name="namabelakang" id="inputLastName" type="text" placeholder="Enter your last name" />
                        <label for="inputLastName">Last name</label>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="username" id="inputEmail" type="text" placeholder="name@example.com" />
                <label for="inputEmail">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" name="pabrik" id="inputEmail" type="text" placeholder="name@example.com" />
                <label for="inputEmail">Pabrik</label>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Create a password" />
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                        <label for="inputPasswordConfirm">Confirm Password</label>
                    </div>
                </div>
            </div>
            <div class="mt-4 mb-0">
                <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" href="/">Tambah Akun</button></div>
            </div>
        </form>
    </div>
</main>
@endsection