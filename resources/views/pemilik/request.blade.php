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
                    <table class="table mt-5" id="tabel1">
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
                            <?php $i = 0;
                            $i++; ?>
                            <tr>
                                <th scope="col">{{$loop->iteration}}</th>
                                <th scope="col">{{$row['nobatch']}}</th>
                                <th scope="col">{{$row['audit_laporan']}}</th>
                                <th scope="col">
                                    @if($row['audit_status']==0)
                                    {{'Diajukan'}}
                                    @else
                                    {{'Diterima'}}
                                    @endif
                                </th>

                                @if($row['audit_status']==0)
                                
                                <th scope="col">

                                    <form action="/terima_request" method="post" id="terimalaporan{{ $row['audit_id'] }}">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{$row['nobatch']}}">
                                        <input type="hidden" name="no" value="{{$row['audit_id']}}">
                                        <input type="hidden" name="laporan" value="{{$row['audit_laporan']}}">
                                        <input type="hidden" name="pabrik" value="{{$row['audit_pabrik']}}">
                                        <button type="button" onclick="TerimaLaporan({{ $row['audit_id'] }})" class="btn btn-success">
                                            Terima
                                        </button>
                                    </form>
                                </th>
                                @else
                                <th scope="col">
                                    <form action="hapus_request" method="post" id="hapusRequest{{$row['audit_id']}}">
                                        @csrf
                                        <input type="hidden" name="nobatch" value="{{$row['nobatch']}}">
                                        <input type="hidden" name="auditId" value="{{$row['audit_id']}}">
                                        <input type="hidden" name="laporan" value="{{$row['audit_laporan']}}">
                                        <input type="hidden" name="pabrik" value="{{$row['audit_pabrik']}}">
                                        <button type="button" onclick="buttonHapusRequest({{ $row['audit_id'] }})" class="btn btn-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </th>
                                @endif


                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
</main>
@endsection