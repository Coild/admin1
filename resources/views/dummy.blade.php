<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<tbody>

                                    <?php $i = 0; ?>
                                    @foreach ($data1 as $row)
                                        <?php $i++; ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $row['kode'] }}</td>
                                            <td>{{ $row['nama'] }}</td>
                                            <td>{{ $row['produk'] }}</td>
                                            <td>{{ $row['ruang'] }}</td>
                                            <td>
                                                @if ($row['ruang'] == 0)
                                                    {{ 'Diajukan' }}
                                                @else
                                                    {{ 'Diterima' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->level == 2)
                                                    <form method="post" action="detilterimabb">
                                                        @csrf
                                                        <input type="hidden" name="jenis" value=1 />
                                                        <input type="hidden" name="induk"
                                                            value="{{ $row['cp_bahan_id'] }}" />
                                                        <button type="submit" class="btn btn-primary">terima</button>
                                                    </form>
                                                @else
                                                    <form method="post" action="detilterimabb">
                                                        @csrf
                                                        <input type="hidden" name="jenis" value=1 />
                                                        <input type="hidden" name="induk"
                                                            value="{{ $row['cp_bahan_id'] }}" />
                                                        <button type="submit" class="btn btn-primary">edit</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
<body>
    <table class="table-responsive" id="tableuser">
        <thead>
            <td>nama</td>
            <td>Nama Depan</td>
            <td>Nama Belakang</td>
            <td>pabrik</td>
            <td>level</td>
        </thead>
        <tbody></tbody>
    </table>

    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tableuser').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/user') }}",
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'namadepan',
                        name: 'namadepan'
                    },
                    {
                        data: 'namabelakang',
                        name: 'namabelakang'
                    },
                    {
                        data: 'pabrik',
                        name: 'pabrik'
                    },
                    {
                        data: 'level',
                        name: 'level'
                    },
                ]
            });
        })
    </script>
</body>

</html>