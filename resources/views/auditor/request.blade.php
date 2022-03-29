@extends('layout.app')
@section('title')
<title>Pengolahan   Batch</title>
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
                            <th scope="col">Nomor Batch</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($data as $row)
                       <?php $i=0; $i++; ?>
                        <tr>
                        <th scope="col">{{$i}}</th>
                            <th scope="col">{{$row['nobatch']}}</th>
                            <th scope="col">{{$row['audit_laporan']}}</th>
                            <th scope="col">
                                @if($row['audit_status']==0)
                                {{'Diajukan'}}
                                @else
                                {{'Diterima'}}
                                @endif
                            </th>
                            <th scope="col">
                            @if($row['audit_status']==0)
                            
                            <button class="btn btn-success" disabled> Lihat </button>
                                <!-- {{'Diajukan'}} -->
                                @else
                                <!-- {{'Diajukan'}} -->
                                <button class="btn btn-success"> Lihat </button>
                                @endif
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