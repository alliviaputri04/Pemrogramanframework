@extends('layout.admin')

@section('content')

<body>
  <br>
  <br>
  <h1 class="text-center mb-5 mt-5">UPDATE DATA PEGAWAI</h1>
      <div class="container mb-5">
          <div class="row justify-content-center">
           <div class="col-8">
            <div class="card">
              <div class="card-body">
                <form action="/updateperusahaan/{{$data->id}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->nama }}">

                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Pendirian</label>
                    <input type="date" name="tanggal" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->tanggal }}">

                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Industri</label>
                    <input type="text" name="industri" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->industri }}">
                    
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->email }}">
                    
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $data->lokasi }}">
                    
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
           </div>
          </div>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

@endsection