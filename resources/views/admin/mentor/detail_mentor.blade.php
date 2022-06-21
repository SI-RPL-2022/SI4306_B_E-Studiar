@extends('admin.admin_layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">{{$page}}</h1>
  <p class="mb-4">Detail mentor </p>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold">Status: {{$mentors->status}}</h6>
      <div class="dropdown">
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" type="button"
          id="dropdownMenuButtonAksi" data-bs-toggle="dropdown" aria-expanded="false">
          Aksi
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonAksi">
          <li><a class="dropdown-item" href="/admin/mentor/{{$mentors->id}}/banned">Banned</a>
          </li>
          <li><a class="dropdown-item" href="/admin/mentor/{{$mentors->id}}/hapus">Hapus</a></li>
        </ul>
      </div>
    </div>

    <div class="card-body">
      <div class="row justify-content-between">
        <div class="col-3 d-flex justify-content-center">
          <img src="/img/mentor/{{$mentors->gambar}}" height="250px" width="200px" alt="" srcset=""
            style="border-radius: 16px">
        </div>
        <div class="col-4">
          <h4>Tentang</h4>
          <p>{{$mentors->deskripsi}}.</p>
        </div>

        <div class="col-4">
          <h4 class="text-black">Detail</h4>
          <div class="">
            <h6 class="fw-bold mb-0">Nama</h6>
            <p>{{$mentors->nama}}</p>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Email</h6>
            <p>{{$mentors->email}}</p>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Tanggal Lahir</h6>
            <p>{{$mentors->tgl_lahir}}</p>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Pengalaman Ngajar</h6>
            <p>{{$mentors->tahun_ngajar}} Tahun</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold">Kelas Yang Diajar</h6>
    </div>
    <div class="card-body">

      <ul class="row">
        @foreach ($bidang as $data)
        <li class="col-4">
          <div class="-1">
            <div class="flex">
              <span class="badge bg-warning text-dark mb-0">{{$data->bidang}}</span>
              <span class="badge bg-light text-dark">{{rupiah($data->tarif)}}</span>
            </div>
            <h5 class="font-weight-bold text-primary">{{$data->nama_kelas}}</h5>
          </div>
        </li>
        @endforeach
      </ul>

    </div>
  </div>
</div>

<!-- Modal Terima -->
<div class="modal fade" id="terima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penerimaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin/calon-mentor/{{$mentors->id}}/terima" method="post">
        @csrf
        <div class="modal-body">
          <p>Apakah anda yakin akan menerima akun calon mentor benama <span class="fw-bold">{{$mentors->nama}}</span>
          </p>
        </div>
        <div class="modal-footer">
          <button type="submit"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2 fw-boldy">Terima</button>
          <button type="button" data-bs-dismiss="modal"
            class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm me-2 fw-bold">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="tolak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penolakan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/admin/calon-mentor/{{$mentors->id}}/tolak" method="post">
        @csrf
        <div class="modal-body">
          <p>Apakah anda yakin akan menolak akun calon mentor benama <span class="fw-bold">{{$mentors->nama}}</span></p>
        </div>
        <div class="modal-footer">
          <button type="submit"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2 fw-boldy">Tolak</button>
          <button type="button" data-bs-dismiss="modal"
            class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm me-2 fw-bold">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection