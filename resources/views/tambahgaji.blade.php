@extends('layout.admin')

@section('content')
<body>
  <br>
  <br>
  <h1 class="text-center mb-5 mt-5">TAMBAH GAJI PEGAWAI</h1>
      <div class="container mb-5">
          <div class="row justify-content-center">
           <div class="col-8">
            <div class="card">
              <div class="card-body">
                <form action="/insertgaji" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Pegawai</label>
                    <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('nama')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Gaji</label>
                    <input type="number" name="gaji" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type-currency="IDR" placeholder="Rp">
                    @error('tanggal')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tunjangan</label>
                    <input type="number" name="tunjangan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" type-currency="IDR" placeholder="Rp">
                    @error('tunjangan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Bulan</label>
                    <input type="text" name="bulan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('bulan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('tahun')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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