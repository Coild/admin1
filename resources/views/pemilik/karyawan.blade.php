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
                                        <form action="/update_posisi" method="post" role="form" id='forminput'>
                                            @csrf

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <input type="hidden" name="id" id="isi_id" />
                                            <label for="inputName">Nama</label>
                                            <input name="nama" type="text" class="form-control" id="inputName"
                                                placeholder="Nama Alat" />
                                            <div class="form-group">
                                                <label for="inputEmail">Posisi</label>
                                                <select style="height: 35px;" class="form-control" name="posisi"
                                                    id="inlineFormCustomSelect">
                                                    <option value="">Pilih posisi</option>
                                                    <option value="2">Penanggung Jawab</option>
                                                    <option value="3">Pelaksana</option>
                                                </select>
                                            </div>
                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            Close
                                        </button>
                                        <a type="submit" href="#" style="text-decoration: none;" class="btn btn-primary"
                                            onclick="salert()">
                                            Simpan
                                        </a>
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
                                        <button style="float:left;" class="btn btn-warning btn-md me-3" id="detil"
                                            data-toggle="modal" data-target="#modalForm1" data-id="<?= $row->id ?>"
                                            data-nama="<?= $row->nama ?>" data-posisi="<?= $row->level ?>">
                                            <i class="fa fa-edit "></i> Edit
                                        </button>
                                        <form action="/hapus_karyawan" method="post" id="forminput1" onSubmit="return confirm('Apakah anda ingin menghapus?') ">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $row['id'] }}">
                                            <button class="btn btn-danger btn-md me-3" type="submit" ><i class="fa fa-trash"></i> Hapus</button>
                                            
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


    <!-- tos 1 OH -->

    <script type="text/javascript">
        // $(document).ready(function() {
        $(document).on('click', "#detil", function() {
            var nama = $(this).data('nama');
            var id = $(this).data('id');
            var posisi = $(this).data('posisi');


            // console.log("ini " + nama + " posisi "+posisi);
            $("#inputName").val(nama);
            // $("#isi_p").val(p);
            $("#isi_id").val(id);
        })
        // });
    </script>
@endsection
