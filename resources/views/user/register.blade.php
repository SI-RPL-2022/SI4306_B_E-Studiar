<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Daftar Estudiar</title>
</head>

<body>
    <div class="row justify-content-center" style="margin-top: 150px">
        <div class="col-lg-6">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal text-center">Form Pendaftaran</h1>
                <form action="/user/register" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control rounded-top" name="nama" id="nama" required placeholder="Nama">
                        <label for="nama">Nama</label>
                    </div>
                    <div class="form-floating">
                        <input type="date" class="form-control " name="tgl_lahir" id="tgl_lahir" required>
                        <label for="tgl_lahir">Tanggal Lahir</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control " name="email" id="email" required placeholder="Masukkan alamat Email">
                        <label for="email">Alamat Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control rounded-bottom" name="password" id="password" required
                            placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating">
                        <input type="jenjang_pendidikan" class="form-control " name="jenjang_pendidikan" id="jenjang_pendidikan" required placeholder="Masukkan Jenjang Pendidikan Anda">
                        <label for="jenjang_pendidikan">Jenjang Pendidikan</label>
                    </div>

                    <button class="w-100 btn mt-3" style="background-color: #1780E2; color:white;" type="submit">Register</button>
                </form>
                <small class="d-block mt-3">Sudah punya akun Estudiar? <a class="text-primary" href="/user/login"> Masuk
                        disini</a></small>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>
 
</html>