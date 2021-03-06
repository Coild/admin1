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
                                            <form action="/reset_password" method="post" id='forminput1'>
                                                @csrf
                                                <input type="hidden" name="id" id="isi_idpass">
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
                    <button style="float:left; max-width:250px;" onclick="TambahKaryawanModal()" class="btn btn-primary btn-md mb-3">
                        <i class="fa fa-plus "></i> Tambah Karyawan
                    </button>
                    <table class="table" id="tabel1">
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
                                            <form action="/hapus_karyawan" method="post" id="formHapusKaryawan{{ $row['id'] }}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $row['id'] }}">
                                                <input type="hidden" name="namadepan" id="" value="{{ $row['namadepan'] }}">
                                                <input type="hidden" name="namabelakang" id="" value="{{ $row['namabelakang'] }}">
                                                <input type="hidden" name="level" id="" value="{{ $row['level'] }}">
                                                
                                                <button class="btn btn-danger btn-md me-3" onclick="buttonHapusKaryawan({{ $row['id'] }})" type="button"><i
                                                    class="fa fa-trash" ></i> Hapus</button>

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


<!-- Modal -->
<div class="modal fade" id="ModalTambahKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
            <div class="card-body">
                <form action="/register" method="post" id='formModalTambahKaryawan'>
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" name="namadepan" id="inputFirstName"
                                    type="text" placeholder="Enter your first name" required />
                                <label for="inputFirstName">First name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control" name="namabelakang" id="inputLastName"
                                    type="text" placeholder="Enter your last name" required />
                                <label for="inputLastName">Last name</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" name="username" id="username" type="text"
                            placeholder="name@example.com" required/>
                        <label for="inputEmail">Username</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input class="form-control" name="search" id="inputPabrik" type="hidden"
                            placeholder="" readonly value="{{ Auth::user()->pabrik }}"/>
                            <input class="form-control" id="inputPabrik" type="text"
                            placeholder="" readonly value="{{ session()->get('pabrik') }}"/>
                            <label for="inputPabrik">Pabrik</label>
                    </div>
                    
                        <div class="form-floating">
                            <input class="form-control" name="password" id="inputPassword"
                                type="password" placeholder="Create a password" required />
                            <label for="inputPassword">Password</label>
                        </div>
                </form>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="buttonFormTambahKaryawan()">Tambah</button>
        </div>
      </div>
    </div>
  </div>

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
                                placeholder="Nama" readonly/>
                            <div class="form-group">
                                <label for="inputEmail">Posisi</label>
                                <select style="height: 35px;" class="form-control" name="posisi"
                                    id="input_posisi">
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
                        <a type="submit"  style="text-decoration: none;" class="btn btn-primary"
                            onclick="salert()">
                            Simpan
                    </a>
                    </div>
                    </form>
                </div>


            </div>
        </div>

    <!-- pop up end -->

        <script type="text/javascript">
            $(document).on('click', "#reset", function() {
                var id = $(this).data('id');
                console.log("hai " + id);
                $("#isi_idpass").val(id);
                // console.log(''+$("#isi_idpass").val());
            })
            
            $(document).ready(function() {
                $(document).on('click', "#detil", function() {
                    var nama = $(this).data('nama');
                    var id = $(this).data('id');
                    var posisi = $(this).data('posisi');


                    // console.log("ini " + nama + " posisi "+posisi);
                    $("#inputName").val(nama);
                    $("#input_posisi").val(posisi);
                    $("#isi_id").val(id);
                })
            });

            function TambahKaryawanModal() {
                // alert('ini');
                $('#ModalTambahKaryawan').modal('show');
            }
            
            function buttonFormTambahKaryawan() {
                // alert('itu');
                
                if ($('#inputFirstName').val() == '' || $('#inputLastName').val() == '' || $('#username').val() == ''|| $('#inputPassword').val() == '') 
                {
                swal({
                    title: 'Opppss!',
                    text: 'Harap isi semua form!',
                    icon: 'warning',
                    buttons: {                  
                        confirm: {
                            className : 'btn btn-focus'
                        }
                    },
                    });
                }
                else {
                    swal({
                        title: 'Simpan Data Karyawan?',
                        icon: 'warning',
                        buttons:{
                        confirm: {
                            text : 'Simpan',
                            className : 'btn btn-success'
                        },
                        cancel: {
                            text : 'Tidak',
                            visible: true,
                            className: 'btn btn-focus'
                        }
                        }
                    }).then((Simpan) => {
                        if (Simpan) {
                            document.getElementById("formModalTambahKaryawan").submit();
                        } else {
                            swal.close();
                        }
                    });
                }
            }

        </script>
        
        
    </main>
@endsection
