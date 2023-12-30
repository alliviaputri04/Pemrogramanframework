<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projek Akhir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    @if ($message = Session::get('success'))
        <div class="text-center alert alert-success" role="alert">
         {{$message}}
        </div>
    @endif
    <h1 class="text-center mb-4">DATA PEGAWAI</h1>
        <div class="container">
            <a href="/tambahpegawai" class="btn btn-success">Tambah +</a>

            <div class="row g-3 align-items-center mt-2">
                <div class="col-auto">
                    <form action="/pegawai" method="get">
                        <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
                    </form>
                </div>

                <div class="col-auto">
                    <a href="/exportpdf" class="btn btn-info">Export PDF</a>
                </div>

                <div class="col-auto">
                    <a href="/exportexcel" class="btn btn-success">Export Excel</a>
                </div>

              </div>
              <br>
            <div class="row">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Umur</th>
                        <th scope="col">No Telpon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =1;
                        @endphp
                        @foreach ($data as $index => $row)
                        <tr>
                            <th scope="row">{{$index + $data->firstItem()}}</th>
                            <td>{{$row->nama}}</td>
                            <td>
                                <img src="{{ asset('fotopegawai/'.$row->foto) }}" alt="" style="width: 40px;">
                            </td>
                            <td>{{$row->jeniskelamin}}</td>
                            <td>{{$row->umur}}</td>
                            <td>0{{$row->notelpon}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>{{$row->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>{{$row->updated_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <a href="/tampilkandata/{{$row->id}}" class="btn btn-warning">UPDATE</a>
                                <a href="#" class="btn btn-danger delete" data-id="{{$row->id}}" data-nama="{{$row->nama}}">HAPUS</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{$data->links()}}
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
  <script>
         $('.delete').click( function(){
        var pegawaiid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');

        swal({
            title: "Yakin ?",
            text: "Kamu yakin akan menghapus data pegawai dengan nama "+nama+" ",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/delete/"+pegawaiid+""
                swal("Data Berhasil Di hapus", {
                icon: "success",
         });
        } else {
            swal("Data tidak jadi di hapus");
        }
        });
        });


  </script>

  <script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @endif  
 </script>
</html>