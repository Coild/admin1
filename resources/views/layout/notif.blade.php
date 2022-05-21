@extends('layout.app')
@section('title')
<title>Notifikasi</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Notifikasi </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Notifikasi</li>
        </ol>
        <div class="row">

            <!--  -->
            <div class="card mb-4">

                <div class="card-body">

                    <table class="table" id="tabel1">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Notifikasi</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <td scope="col">1</td>
                                <td scope="col">Tim A Menambah Barang</td>
                                <td scope="col"> 27-05-2021, 07:29:21</td>
                                <td scope="col"><Button type="button" class="btn btn-primary">Lihat</Button></td>
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- <a class="btn btn-primary" href="#">Edit</a>
                    <a class="btn btn-primary" href="#">Cetak</a> -->

</main>
@endsection
