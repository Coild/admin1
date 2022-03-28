@extends('layout.app')
@section('title')
<title>Daftar Batch</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Batch</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Daftar Batch</li>
        </ol>
        <div class="row">

            <div class="card mb-4">

                <div class="card-body">
                    <table class="table mt-5">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nomor Batch</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($data as $row)
                            <tr><?php $no = 0;
                                $no++; ?>
                                <th scope="col">{{$no}}</th>
                                <th scope="col">{{$row['laporan_batch']}}</th>
                                <th scope="col">
                                    
                                    <a href="/audit_dokumen/{{$row['laporan_batch']}}" type="submit" class="btn btn-success">
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