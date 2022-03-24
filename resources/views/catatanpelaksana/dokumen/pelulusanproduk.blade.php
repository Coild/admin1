@extends('layout.app')
@section('title')
<title>Aplikan</title>
@endsection

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Karyawan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pt abcde</li>
        </ol>
        <div class="row">


            <div class="card ">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Karyawan
                </div>
                <div class="card-body">
                    <!-- pop up -->
                    <!-- Button to trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="modalForm1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">
                                        Edit Posisi
                                    </h4>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <p class="statusMsg"></p>
                                    <form action="/input_peralatan" method="post" role="form">
                                        @csrf
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <label for="inputName">Nama</label>
                                        <input name="nama" type="text" class="form-control" id="inputName" placeholder="Nama Alat" />
                                        <div class="form-group">
                                            <label for="inputEmail">Posisi</label>
                                            <input name="kode" type="text" class="form-control" id="inputName" placeholder="Kode Alat" />
                                        </div>
                                </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary submitBtn" onclick="submitContactForm()">
                                        Simpan
                                    </button>
                                </div>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- pop up end -->

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <?php $i = 0;
                        $i++;  ?>
                        <tr>
                            <td scope="col">{{$i}}</td>
                            <td scope="col">{{$row['nama']}}</td>
                            <td scope="col">
                                <form action="terima" method="post" style="float: left; margin-right:15px;">
                                @csrf    
                                <input type="hidden" name="id" value="{{$row['id']}}">
                                    <button type="submit" class="btn btn-success btn-m">
                                        Terima
                                    </button>
                                </form>
                                <form action="tolak" method="post">
                                @csrf  
                                <input type="hidden" name="id" value="{{$row['id']}}">
                                    <button type="submit" class="btn btn-danger btn-m">
                                        Tolak
                                    </button>
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
</main>
@endsection