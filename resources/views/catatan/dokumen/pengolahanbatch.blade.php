@extends('layout.app')
@section('title')
<title>Pengolahan Batches</title>
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
                    <!-- pop up -->
                    <!-- Button to trigger modal -->
                    @if(Auth::user()->level!=2)
                    <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                        Tambah Pengolahan Batch
                    </button>
                    @endif


                </div>

                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Nomor Batch</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($data as $row)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row['kode_produk'] }}</td>
                            <td>{{ $row['nama_produk'] }}</td>
                            <td>{{ $row['nomor_batch'] }}</td>
                            <td>
                                @if ($row['status'] == 0)
                                {{ 'Diajukan' }}
                                @else
                                {{ 'Diterima' }}
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary" href="detil_batch/{{ $row['nomor_batch'] }}">Buka</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</main>
@endsection