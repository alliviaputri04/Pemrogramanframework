@extends('layout.admin')
  @push('css')

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  @endpush
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Perusahaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Perusahaan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container">
        <a href="/tambahperusahaan" class="btn btn-success">Tambah +</a>
        {{-- {{ Session::get('halaman_url') }} --}}
        <div class="row g-3 align-items-center mt-2">
            <div class="col-auto">
                <form action="/perusahaan" method="get">
                    <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
                </form>
            </div>
    
            <div class="col-auto">
                <a href="/exportexcel" class="btn btn-success">Export Excel</a>
            </div>
    
          </div>
          <br>
        <div class="row">
            <table class="table table-dark table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Perusahaan</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Tanggal Pendirian</th>
                    <th scope="col">Industri</th>
                    <th scope="col">Email</th>
                    <th scope="col">Lokasi</th>
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
                          <img src="{{ asset('fotoperusahaan/'.$row->foto) }}" alt="" style="width: 40px;">
                        </td>
                        <td>{{$row->tanggal}}</td>
                        <td>{{$row->industri}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->lokasi}}</td>
                        <td>{{$row->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{$row->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="/tampilkanperusahaan/{{$row->id}}" class="btn btn-warning">UPDATE</a>
                            <a href="#" class="btn btn-danger delete" data-id="{{$row->id}}" data-nama="{{$row->nama}}">HAPUS</a>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              {{$data->links()}}
        </div>
    </div>
</div>

@push('scripts')

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
        text: "Kamu yakin akan menghapus data perusahaan dengan nama "+nama+" ",
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
  
@endpush
@endsection