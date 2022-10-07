@extends('layout.app')
@section('title')
    <title>Update PROTAP</title>
@endsection
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1>PROTAP</h1>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Aturan BPOM</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Aturan Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Aturan Pabrik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-detail-tab" data-toggle="pill" href="#pills-detail" role="tab"
                        aria-controls="pills-detail" aria-selected="false">Aturan Iklan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-detail1-tab" data-toggle="pill" href="#pills-detail1" role="tab"
                        aria-controls="pills-detail1" aria-selected="false">Aturan Format Baku</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Aturan Baru BPOM
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    @if (Auth::user()->level == 0)
                                        <button class="btn btn-success btn-md" data-toggle="modal" data-target="#modalForm1"
                                            style="max-width: 300px">Tambah Aturan</button>
                                    @endif

                                    <table class="table mt-2" id="tabel1">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($Baru as $row)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $row['tgl_upload'] }}
                                                    </td>
                                                    <td>
                                                            <a href="asset/aturan/{{ $row['nama'] }}" button type="button"
                                                                class="btn btn-primary float-left">Buka</a>
                                                            
                                                            <form action="/hapus_aturan" method="post"
                                                                id="formHapusAturan{{ $row['aturan_id'] }}" class="float-left pr-2">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $row['aturan_id'] }}">

                                                                <button class="btn btn-danger ml-2"
                                                                    onclick="buttonHapusAturan({{ $row['aturan_id'] }})" type="button">
                                                                    Hapus</button>
                
                                                            </form>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        </thead>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Aturan Produk BPOM
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    @if (Auth::user()->level == 0)
                                        <button class="btn btn-success btn-md" data-toggle="modal"
                                            data-target="#modalForm2">Tambah Aturan Produk</button>
                                    @endif

                                    <table class="table mt-2" id="tabelbeda1">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($Produk as $row)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $row['tgl_upload'] }}
                                                    </td>
                                                    <td>
                                                        
                                                            <a href="asset/aturan/{{ $row['nama'] }}" button type="button"
                                                                class="btn btn-primary">Buka</a>
                                                                <form action="/hapus_aturan" method="post"
                                                                id="formHapusAturan{{ $row['aturan_id'] }}" class="float-left pr-2">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $row['aturan_id'] }}">

                                                                <button class="btn btn-danger ml-2"
                                                                    onclick="buttonHapusAturan({{ $row['aturan_id'] }})" type="button">
                                                                    Hapus</button>
                
                                                            </form>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="container-fluid px-4">
                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Aturan Pabrik BPOM
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    @if (Auth::user()->level == 0)
                                        <button class="btn btn-success btn-md" data-toggle="modal"
                                            data-target="#modalForm3">Tambah Aturan Pabrik</button>
                                    @endif

                                    <table class="table mt-2" id="tabelbeda2">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($Pabrik as $row)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $row['tgl_upload'] }}
                                                    </td>
                                                    <td>
                                                        
                                                            <a href="asset/aturan/{{ $row['nama'] }}" button type="button"
                                                                class="btn btn-primary">Buka</a>
                                                                <form action="/hapus_aturan" method="post"
                                                                id="formHapusAturan{{ $row['aturan_id'] }}" class="float-left pr-2">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $row['aturan_id'] }}">

                                                                <button class="btn btn-danger ml-2"
                                                                    onclick="buttonHapusAturan({{ $row['aturan_id'] }})" type="button">
                                                                    Hapus</button>
                
                                                            </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
                    <div class="container-fluid px-4">

                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Aturan Iklan BPOM
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    @if (Auth::user()->level == 0)
                                        <button class="btn btn-success btn-md" data-toggle="modal"
                                            data-target="#modalForm4">Tambah Aturan Iklan</button>
                                    @endif

                                    <table class="table mt-2" id="tabelbeda3">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($Iklan as $row)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $row['tgl_upload'] }}
                                                    </td>
                                                    <td>
                                                            <a href="asset/aturan/{{ $row['nama'] }}" button
                                                                type="button" class="btn btn-primary">Buka</a>
                                                                <form action="/hapus_aturan" method="post"
                                                                id="formHapusAturan{{ $row['aturan_id'] }}" class="float-left pr-2">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $row['aturan_id'] }}">

                                                                <button class="btn btn-danger ml-2"
                                                                    onclick="buttonHapusAturan({{ $row['aturan_id'] }})" type="button">
                                                                    Hapus</button>
                
                                                            </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-detail1" role="tabpanel" aria-labelledby="pills-detail1-tab">
                    <div class="container-fluid px-4">

                        <div class="row">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Aturan Format Baku
                                </div>
                                <div class="card-body">
                                    <!-- pop up -->
                                    @if (Auth::user()->level == 0)
                                        <button class="btn btn-success btn-md" data-toggle="modal"
                                            data-target="#modalForm4">Tambah Aturan Format Baku</button>
                                    @endif

                                    <table class="table mt-2" id="tabelbeda3">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            @foreach ($Iklan as $row)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $row['tgl_upload'] }}
                                                    </td>
                                                    <td>
                                                            <a href="asset/aturan/{{ $row['nama'] }}" button
                                                                type="button" class="btn btn-primary">Buka</a>
                                                                <form action="/hapus_aturan" method="post"
                                                                id="formHapusAturan{{ $row['aturan_id'] }}" class="float-left pr-2">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $row['aturan_id'] }}">

                                                                <button class="btn btn-danger ml-2"
                                                                    onclick="buttonHapusAturan({{ $row['aturan_id'] }})" type="button">
                                                                    Hapus</button>
                
                                                            </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal 1 -->
        <div class="modal fade" id="modalForm1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Aturan Baru BPOM
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form action="/input_aturan" method="post" enctype="multipart/form-data" id="forminput1">

                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="kategori" value="Aturan Baru" />
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Tanggal</label>
                                <input type="date" name="tgl" class="form-control 1" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Pilih File</label>
                                <input onchange="return filecheck1(1)"  type="file" name="upload" class="form-control 1" id="fileform1">
                                            <p style="font-size: 15px; color:red;">*Hanya menerima file PDF</p>


                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(1)">
                                    Tambah
                                </button>
                            </div>


                        </form>
                    </div>


                </div>
            </div>
        </div>
        <!--  -->

        <!-- Modal 2 -->
        <div class="modal fade" id="modalForm2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Aturan Produk
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form action="/input_aturan" method="post" enctype="multipart/form-data" id="forminput2">

                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="kategori" value="Aturan Produk" />
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Tanggal</label>
                                <input type="date" name="tgl" class="form-control 2" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Pilih File</label>
                                <input onchange="return filecheck1(2)"  type="file" name="upload" class="form-control 2" id="fileform2">
                                            <p style="font-size: 15px; color:red;">*Hanya menerima file PDF</p>

                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(2)">
                                    Tambah
                                </button>
                            </div>


                        </form>
                    </div>


                </div>
            </div>
        </div>
        <!--  -->

        <!-- Modal 3 -->
        <div class="modal fade" id="modalForm3" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Aturan Pabrik
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form action="/input_aturan" method="post" enctype="multipart/form-data" id="forminput3">

                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="kategori" value="Aturan Pabrik" />
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Tanggal</label>
                                <input type="date" name="tgl" class="form-control 3" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Pilih File</label>
                                <input onchange="return filecheck1(3)"  type="file" name="upload" class="form-control 3" id="fileform3">
                                            <p style="font-size: 15px; color:red;">*Hanya menerima file PDF</p>

                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(3)">
                                    Tambah
                                </button>
                            </div>


                        </form>
                    </div>


                </div>
            </div>
        </div>
        <!--  -->

        <!-- Modal 4 -->
        <div class="modal fade" id="modalForm4" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">
                            Aturan Iklan
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form action="/input_aturan" method="post" enctype="multipart/form-data" id="forminput4">

                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="kategori" value="Aturan Iklan" />
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Tanggal</label>
                                <input type="date" name="tgl" class="form-control 4" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Pilih File</label>
                                

                                <input onchange="return filecheck1(4)"  type="file" name="upload" class="form-control 4" id="fileform4">
                                            <p style="font-size: 15px; color:red;">*Hanya menerima file PDF</p>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="button" class="btn btn-primary submitBtn" onclick="salert1(4)">
                                    Tambah
                                </button>
                            </div>


                        </form>
                    </div>


                </div>
            </div>
        </div>
        <!--  -->
    </main>

@endsection
