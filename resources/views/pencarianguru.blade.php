@extends('layout')
@section('content')

<link href="assets/css/guru.css" rel="stylesheet" />

<link href="assets/css/theme.css" rel="stylesheet" />

<main class="main" id="top">
  <nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="/"><img src="https://i.ibb.co/6yTVSfP/image-1.png" height="50"
          alt="logo" /></a>
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
          <a class="btn btn-secondary-outline" href="#!">Masuk</a>
          <div class="button-signup">
            <button type="button" style="background-color: #1780E2; color:white; margin-left:8px"
              class="btn">Daftar</button>
          </div>

        </div>
      </div>
    </div>
  </nav>

  <div class="container">

    <input class="search__input" type="text" placeholder="Semua Materi">
  </div>

  @endsection