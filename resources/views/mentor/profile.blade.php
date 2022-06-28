@extends('mentor.mentor_layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">{{auth()->user()->nama}}</h1>
  <p class="mb-4">Profile Page </p>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold">Status Akun: {{auth()->user()->status}}</h6>
      <div class="dropdown">
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle" type="button"
          id="dropdownMenuButtonAksi" data-bs-toggle="dropdown" aria-expanded="false">
          Update
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonAksi">
          <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updateProfile" href="#">Update
              Profile</a>
          </li>
          <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#updatePassword" href="#">Update
              Password</a></li>
        </ul>
      </div>
    </div>

    <div class="card-body">
      <div class="row justify-content-between">
        <div class="col-3 d-flex justify-content-center">
          <img src="/img/mentor/{{auth()->user()->gambar}}" height="250px" width="200px" alt="" srcset=""
            style="border-radius: 16px">
        </div>
        <div class="col-4">
          <h4>Tentang</h4>
          <p>{{auth()->user()->deskripsi}}.</p>
        </div>

        <div class="col-4">
          <h4 class="text-black">Detail</h4>
          <div class="">
            <h6 class="fw-bold mb-0">Nama</h6>
            <p>{{auth()->user()->nama}}</p>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Email</h6>
            <p>{{auth()->user()->email}}</p>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Tanggal Lahir</h6>
            <p>{{auth()->user()->tgl_lahir}}</p>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Pengalaman Ngajar</h6>
            <p>{{auth()->user()->tahun_ngajar}} Tahun</p>
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
            <h5 data-bs-toggle="modal" data-bs-target="#updateKelas" class="font-weight-bold text-primary"
              style="cursor: pointer">
              {{$data->nama_kelas}}</h5>
          </div>
        </li>

        <!-- Update -->
        <div class="modal fade" id="updateKelas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/mentor/kelas/update/{{$data->id}}" method="post">
                @csrf
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label">Bidang</label>
                    <input type="text" class="form-control" name="bidang" value="{{$data->bidang}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Kelas</label>
                    <input type="text" class="form-control" name="nama_kelas" value="{{$data->nama_kelas}}">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tarif / jam</label>
                    <div class="input-group">
                      <div class="input-group-text">Rp.</div>
                      <input type="text" class="form-control" name="tarif" value="{{$data->tarif}}">
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Deskripsi Kelas</label>
                    <textarea class="form-control" name="deskripsi">{{$data->deskripsi}}</textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"
                    data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Save
                    changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </ul>

    </div>
  </div>
</div>

<!-- Modal Terima -->
<div class="modal fade" id="updatePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/mentor/ubah-password" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password1" placeholder="Masukan password baru anda">
            <div id="passLabel1" class="form-text"></div>
          </div>
          <div class="mb-3">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" class="form-control" id="password2" name="password"
              placeholder="Konfirmasi password baru anda">
            <div id="passLabel2" class="form-text"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" disabled class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2 fw-boldy"
            id="btnSubmit">Submit</button>
          <button type="button" data-bs-dismiss="modal"
            class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm me-2 fw-bold">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/mentor/profile/{{auth()->user()->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" value="{{auth()->user()->nama}}">
          </div>
          <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}">
          </div>
          <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tgl_lahir" value="{{auth()->user()->tgl_lahir}}">
          </div>
          <div class="mb-3">
            <label class="form-label">Pengalaman Ngajar</label>
            <div class="input-group">
              <input type="number" class="form-control" name="tahun_ngajar" value="{{auth()->user()->tahun_ngajar}}">
              <div class="input-group-text">Tahun</div>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" rows="3">{{auth()->user()->deskripsi}}</textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Foto Profile</label>
            <input type="file" class="form-control" name="image">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2 fw-boldy">Submit</button>
          <button type="button" data-bs-dismiss="modal"
            class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm me-2 fw-bold">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  window.onload = function(){
    const password1 = document.getElementById('password1');
    const password2 = document.getElementById('password2');
    const btnSubmit = document.getElementById('btnSubmit');
    const passLabel1 = document.querySelector('#passLabel1');
    const passLabel2 = document.querySelector('#passLabel2');

    const passOld = document.getElementById('passOld');


    const isPasswordMatch = () => {
      if (password1.value !== password2.value) {
        console.log('Tidak samaa')

        passLabel1.classList.remove("text-success");
        passLabel2.classList.remove("text-success");

        passLabel1.classList.add("text-danger");
        passLabel2.classList.add("text-danger");
        
        passLabel1.textContent = "Password tidak cocok";
        passLabel2.textContent = "Password tidak cocok";
        btnSubmit.disabled = true;
      } else {
        passLabel1.classList.remove("text-danger");
        passLabel2.classList.remove("text-danger");

        passLabel1.classList.add("text-success");
        passLabel2.classList.add("text-success");

        passLabel1.textContent = "Password cocok";
        passLabel2.textContent = "Password cocok";
        btnSubmit.disabled = false;
        console.log(' samaa')
      }
    }

    password1.addEventListener('keyup', isPasswordMatch);
    password2.addEventListener('keyup', isPasswordMatch);

  }
</script>

@endsection