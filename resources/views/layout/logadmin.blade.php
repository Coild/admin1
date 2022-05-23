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

                    <table class="table-striped col-lg-12" id="tabel1">
                        <thead>
                            <tr>
                                <th >No</th>
                                <th >Waktu</th>
                                <th >Pabrik</th>
                                <th >Aktifitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataLog as $row)
                            <tr>
                                <td class="p-2" > {{ $loop->iteration}}</td>
                                <td > {{ $row->log_waktu}}</td>
                                <td > {{ $row->log_pabrik}}</td>
                                <td >{!! $row->log_isi !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- <a class="btn btn-primary" href="#">Edit</a>
                    <a class="btn btn-primary" href="#">Cetak</a> -->

</main>
@endsection
