@extends('layout.app')
@section('title')
    <title>Perizinan</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">PERIZINAN </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">PERIZINAN</li>
            </ol>
            <div class="row">

                <!--  -->
                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                            Tambah Perizinan
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Entry Perizinan
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form action="/input_perizinan" method="post" enctype="multipart/form-data"
                                            role="form">

                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="form-group">
                                                <label for="inputName">Nama Perizinan</label>
                                                <input type="text" class="form-control" id="inputName" name="nama" />
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Pilih File Perizinan</label>
                                                <input onchange="return filecheck()" type="file" name="upload" class="form-control-file"
                                                    id="exampleFormControlFile1">
                                                    <p style="font-size: 15px; color:red;">*Hanya menerima file PDF</p>
                                            </div>
                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary submitBtn" onclick="salert()">
                                                    Tambah
                                                </button>
                                            </div>


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->

                        <table class="table display nowrap hide" style="width:100%"id="tabel1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Perizinan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($list_perizinan as $row)
                                    <?php $i++;
                                    $nama = $row['perizinan_nama'];
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td class="p-2">{{ $row['perizinan_nama'] }}</td>
                                        <td>
                                            
                                            <a href="/asset/perizinan/{{ $row['perizinan_file'] }}" button type="button"
                                                class="btn btn-primary float-left mr-1">Buka</a>
                                                
                                                <form action="/hapus_perizinan" method="get"
                                                id="hapupjt{{ $row['perizinan_id'] }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row['perizinan_id'] }}">
                                                <button type="button" class="btn btn-danger" onclick="buttonHapuspjt({{ $row['perizinan_id'] }})"> Hapus</button>
                                            </form>
                                        </td>
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
