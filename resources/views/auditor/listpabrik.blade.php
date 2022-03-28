@extends('layout.app')
@section('title')
<title>Pengolahan Batch</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pengolahan Batch</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengolahan Batch</li>
        </ol>
        <div class="row">

            <div class="card mb-4">

                <div class="card-body">
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Pabrik</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr><?php $no = 0;
                                $no++; ?>
                                <th scope="col">{{$no}}</th>
                                <th scope="col">{{$row['nama']}}</th>
                                <th scope="col">

                                    <a href="/audit_batch/{{$row['pabrik__id']}}" type="submit" class="btn btn-success">
                                        Lihat
                                    </a>
                                </th>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
</main>
@endsection