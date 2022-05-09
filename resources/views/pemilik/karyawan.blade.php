@extends('layout.app')
@section('title')
    <title>Karyawan</title>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Daftar Karyawan</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{ session('pabrik') }} </li>
            </ol>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Karyawan
                    </div>
                    <div class="card-body">
                        <!-- Modal Reset-->
                        <div class="modal fade" id="resetpas" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">
                                            Reset Password
                                        </h4>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <p class="statusMsg"></p>
                                        <div class="container">
                                            <form action="/reset_passwordu" method="post" id='forminput'>
                                                @csrf
                                                <input type="hidden" name="id" id="isi_id">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" name="baru" id="user" type="text"
                                                        placeholder="masukan password" autocomplete="off" />
                                                    <label for="inputEmail">Password Baru</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->

                    </div>

                    <!-- pop up end -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data as $row)
                                <?php $i++;
                                $nama = $row['nama']; ?>
                                <tr>
                                    <td scope="col">{{ $i }}</td>
                                    <td id="namap" scope="col">{{ $row['nama'] }}</td>
                                    <td id="posisi" scope="col">
                                        @if ($row->level === 2)
                                            {{ 'Penanggung Jawab Teknis' }}
                                        @else
                                            {{ 'Pelaksana' }}
                                        @endif
                                    </td>
                                    <td scope="col">
                                        <div class="col btn-group">
                                            <button style="float:left; max-width:100px;" class="btn btn-success btn-md me-3"
                                                id="detil" data-toggle="modal" data-target="#modalForm1"
                                                data-id="<?= $row->id ?>" data-nama="<?= $row->nama ?>"
                                                data-posisi="<?= $row->level ?>">
                                                <i class="fa fa-edit "></i> Edit
                                            </button>
                                            <form action="/hapus_karyawan" method="post" id="forminput1"
                                                onSubmit="return confirm('Apakah anda ingin menghapus?') ">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row['id'] }}">
                                                <button class="btn btn-danger btn-md me-3" type="submit"><i
                                                        class="fa fa-trash"></i> Hapus</button>

                                            </form>
                                            <button style="float:left; max-width:100px;" class="btn btn-warning btn-md me-3"
                                                id="reset" data-toggle="modal" data-target="#resetpas"
                                                data-id="<?= $row->id ?>">
                                                <i class="fa fa-copy "></i> Reset
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <script type="text/javascript">
            $(document).on('click', "#reset", function() {
                var id = $(this).data('id');
                console.log("hai " + id);
                $("#isi_id").val(id);
            })
            $(document).ready(function() {
                $(document).on('click', "#detil", function() {
                    var nama = $(this).data('nama');
                    var id = $(this).data('id');
                    var posisi = $(this).data('posisi');


                    // console.log("ini " + nama + " posisi "+posisi);
                    $("#inputName").val(nama);
                    // $("#isi_p").val(p);
                    $("#isi_id").val(id);
                })
            });
        </script>
    </main>
@endsection
