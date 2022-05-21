@extends('layout.app')
@section('title')
<title>Log Aktifitas</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Log Aktifitas </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Log Aktifitas</li>
        </ol>
        <div class="row">

            <!--  -->
            <div class="card mb-4">

                <div class="card-body">

                    <table class="table" id="tabel1">
                        <thead>
                            <tr>

                                <th scope="col">Waktu</th>
                                <th scope="col">User</th>
                                <th scope="col">Aktifitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td scope="col"> 27-05-2021, 07:29:21</td>
                                <td scope="col">Pegawai</td>
                                <td scope="col">Menambah Barang</td>
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- <a class="btn btn-primary" href="#">Edit</a>
                    <a class="btn btn-primary" href="#">Cetak</a> -->

</main>
@endsection
