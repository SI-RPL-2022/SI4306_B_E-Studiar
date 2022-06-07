@extends('layout')
@section('content')
<section class="min-vh-100 h-custom primary-bg">
  <div class="container py-5 h-100 d-flex justify-content-center align-items-center">
    <div class="col-10 card">

      <div class="row">
        <div class="col-5 p-0">
          <img src="/img/study.jpg" width="100%" height="100%" alt="" srcset="">
        </div>
        <div class="col-7 p-5">
          <div class="mb-4 text-center">
            <h1>Registrasi Calon Mentor</h1>
          </div>
          <form role="form" action="/mentor/registrasi/pilih_bidang" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" placeholder="Masukan nama lengkap" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" name="email" placeholder="Masukan alamat email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" name="tgl_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Pengalaman menjadi tenaga ajar</label>
              <div class="input-group">
                <input type="number" placeholder="Berapa lama sudah menjadi tenaga ajar" name="tahun_ngajar"
                  class="form-control" required>
                <div class="input-group-text">tahun</div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Deksripsi</label>
              <textarea name="deskripsi" class="form-control" required rows="5"
                placeholder="Deskripsikan diri anda sebagai calon mentor"></textarea>
            </div>

            <button type="submit" class="btn col-12 btn-primary">Selanjutnya</button>
          </form>
          <small class="d-block mt-3">Sudah punya akun Estudiar? <a class="text-primary" href="/mentor/login"> Masuk
              disini</a></small>
        </div>
      </div>

    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
@endsection