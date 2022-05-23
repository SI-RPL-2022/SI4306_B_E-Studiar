<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>Estudiar | Solusi Jadi Pintar</title>


  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicons/favicon.png">
  <link rel="manifest" href="/assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="/assets/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">


  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link href="/assets/css/theme.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>


<body>

  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
      <div class="container"><a class="navbar-brand" href="/"><img src="https://i.ibb.co/6yTVSfP/image-1.png"
            height="50" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
            class="navbar-toggler-icon"> </span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#feature">Layanan</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#validation">Cara Kami Bekerja</a>
            </li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#superhero">Berikan Kursus</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="#marketing">Ulasan</a></li>
          </ul>
          <div class="d-flex ms-lg-4">
            @if (auth()->user())
            <div class="d-flex ms-lg-4">
              <div class="nama">
                <h5 style="margin-top:12px">Hai, {{ auth()->user()->nama }}</h5>
              </div>

              <div class="logout">
                <form action="/user/logout" method="POST">
                  @csrf
                  <button class="btn btn-danger" style="margin-left:8px">Logout</button>
                </form>
              </div>
            </div>
            @else
            <div class="dropdown">
              <a class="btn btn-secondary-outline" href="#" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">Masuk</a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/admin/login">Sebagai Admin</a></li>
                <li><a class="dropdown-item" href="/mentor/login">Sebagai Mentor</a></li>
                <li><a class="dropdown-item" href="/user/login">Sebagai User / Murid</a></li>
              </ul>
            </div>
            <div class="dropdown">
              <a class="btn" id="dropdownMenuDaftar" data-bs-toggle="dropdown" aria-expanded="false"
                style="background-color: #1780E2; color:white; margin-left:8px" href="/user/register">Daftar</a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuDaftar"
                style="background-color: #1780E2; color:white; margin-left:8px">
                <li><a class="dropdown-item text-white" href="/mentor/registrasi">Sebagai Mentor</a></li>
                <li><a class="dropdown-item text-white" href="/user/register">Sebagai User / Murid</a></li>
              </ul>
            </div>
            @endif
          </div>
        </div>
      </div>
    </nav>

    @yield('content')

    <section class="pb-2 pb-lg-5">

      <div class="container">
        <div class="row border-top border-top-secondary pt-7">
          <div class="col-lg-3 col-md-6 mb-4 mb-md-6 mb-lg-0 mb-sm-2 order-1 order-md-1 order-lg-1"><img class="mb-4"
              src="https://i.ibb.co/6yTVSfP/image-1.png" width="184" alt="" /></div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 order-3 order-md-3 order-lg-2">
            <p class="fs-2 mb-lg-4">Quick Links</p>
            <ul class="list-unstyled mb-0">
              <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">About us</a></li>
              <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Blog</a></li>
              <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Contact</a></li>
              <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">FAQ</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 mb-4 mb-lg-0 order-4 order-md-4 order-lg-3">
            <p class="fs-2 mb-lg-4">Legal stuff</p>
            <ul class="list-unstyled mb-0">
              <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Disclaimer</a></li>
              <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Financing</a></li>
              <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Privacy Policy</a></li>
              <li class="mb-1"><a class="link-900 text-secondary text-decoration-none" href="#!">Terms of Service</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 col-6 mb-4 mb-lg-0 order-2 order-md-2 order-lg-4">
            <p class="fs-2 mb-lg-4">
              Ingin dapat info menarik dari kami</p>
            <form class="mb-3">
              <input class="form-control" type="email" placeholder="Email" aria-label="phone" />
            </form>
            <button class="btn btn-warning fw-medium py-1">Langganan Sekarang</button>
          </div>
        </div>
      </div><!-- end of .container-->


    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->




    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="text-center py-0">

      <div class="container">
        <div class="container border-top py-3">
          <div class="row justify-content-between">
            <div class="col-12 col-md-auto mb-1 mb-md-0">
              <p class="mb-0">&copy; 2022 Estudiar</p>
            </div>

          </div>
        </div>
      </div><!-- end of .container-->

    </section>


  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->


  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.9/dist/sweetalert2.all.min.js"></script> --}}

  @include('sweetalert::alert')

  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script> --}}
  <script src="/vendors/@popperjs/popper.min.js"></script>
  <script src="/vendors/bootstrap/bootstrap.min.js"></script>
  <script src="/vendors/is/is.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="/vendors/fontawesome/all.min.js"></script>
  <script src="/assets/js/theme.js"></script>

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap"
    rel="stylesheet">
</body>

</html>