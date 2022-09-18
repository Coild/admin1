@extends('layout.app')
@section('title')
    <title>COA</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">COA </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">COA</li>
            </ol>
            <div class="row">

                <!--  -->
                <div class="card mb-4">

                    <div class="card-body">
                        <!-- pop up -->
                        <!-- Button to trigger modal -->
                        <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalForm">
                            Tambah COA
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalForm" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Entry COA
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <form action="/input_coa" method="post" enctype="multipart/form-data"
                                            id="forminput1" role="form">

                                            @csrf
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <div class="form-group">
                                                <label for="inputName">Nama COA</label>
                                                <input type="text" class="form-control 1" id="inputName"
                                                    name="nama" />
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Pilih File COA</label>
                                                <input onchange="return filecheck()" type="file" name="upload"
                                                    class="form-control 1" id="fileform">
                                                <p style="font-size: 15px; color:red;">*Hanya menerima file PDF</p>
                                            </div>
                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary submitBtn"
                                                    onclick="salert1(1)">
                                                    Tambah
                                                </button>
                                            </div>


                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!--  -->

                        <table class="table" id="tabel1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama COA</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($list_coa as $row)
                                    <?php $i++;
                                    $nama = $row['coa_nama'];
                                    ?>
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $row['coa_nama'] }}</td>
                                        <td>

                                            <form action="/lihatpdf" method="post">
                                                @csrf
                                                <input type="hidden" name="path"
                                                    value="/asset/coa/{{ $row['coa_file'] }}">
                                                <button type="submit" class="btn btn-success" onclick=""> Buka</button>
                                            </form>


                                            <form action="/hapus_coa" method="get" target="_blank">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row['coa_id'] }}">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="buttonHapuspjt({{ $row['coa_id'] }})"> Hapus</button>
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
            </div>
        </div>
    </main>
@endsection
