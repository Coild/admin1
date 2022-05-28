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

                    <table class="table" id="datatabel">
                        <thead>
                            <tr>
                                <th scope="col">Notifikasi</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td scope="col">{{$row['notif_isi'].' '.$row['notif_laporan']}}</td>
                                <td scope="col">{{$row['notif_waktu']}}</td>
                                <td scope="col"><Button type="button" class="btn btn-primary">
                                        <a href="{{$row['notif_link']}}" class="btn btn-primary btn-sm"> Lihat </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>

                </div>
            </div>

            <!-- <a class="btn btn-primary" href="#">Edit</a>
                    <a class="btn btn-primary" href="#">Cetak</a> -->

</main>
<script>
    $(document).ready(function() {
    $('#datatabel').DataTable({
        scrollX: true,
        responsive: true,
        "bAutoWidth": false
    });})
</script>
@endsection