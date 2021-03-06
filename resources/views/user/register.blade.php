@extends('layout')
@section('content')
<section class="min-vh-100 h-custom primary-bg">
    <div class="container py-5 h-100 d-flex justify-content-center align-items-center">
        <div class="col-10 card">

            <div class="row">
                <div class="p-5">
                    <div class="mb-4 text-center">
                        <h1>Registrasi Akun Estudiar</h1>
                    </div>
                    <form role="form" action="/user/register" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Masukan nama lengkap" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" placeholder="Masukan alamat email" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenjang Pendidikan</label>
                            <textarea name="jenjang_pendidikan" class="form-control" required rows="2"
                                placeholder="Masukkan Jenjang Pendidikan anda"></textarea>
                        </div>

                        <button type="submit" class="btn col-12 btn-primary">Daftar</button>
                    </form>
                    <small class="d-block mt-3">Sudah punya akun Estudiar? <a class="text-primary" href="/user/login">
                            Masuk
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