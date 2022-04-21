@extends('layout')
@section('content')
<link rel="stylesheet" href="assets/css/guru.css" />

<link href="assets/css/theme.css" rel="stylesheet" />

<<<<<<< HEAD
<main class="main" id="top">

  <nav class="navbar navbar-expand-lg navbar-light sticky-top" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container"><a class="navbar-brand" href="/"><img src="https://i.ibb.co/6yTVSfP/image-1.png" height="50"
          alt="logo" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
          class="navbar-toggler-icon"> </span></button>
      <div class="h0
=======
<div class="d-flex justify-content-center align-items-center mt-6">
  <form action="">
    {{-- <h1>Search</h1> --}}
    <div class="form-box">
      <input type="text" class="search-field guru shadow" placeholder="Cari Materi?">
      <input type="text" class="search-field lokasi shadow" placeholder="Lokasi?">
      <button class="search-btn shadow" type="button">Cari</button>
    </div>
  </form>
</div>

<div class="container mt-5">
  <div class="row row-cols-3 ">
    <div class="col">
      <div class="card" style="width: 18rem;">
        <img src="/img/guru/guru1.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
        </div>
      </div>
    </div>
    <div class="col">
      <a href="" class="card-guru">
        <div class="card" style="width: 18rem;">
          <img src="/img/guru/guru2.jpg"" class=" card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col">
      <a href="" class="card-guru">
        <div class="card" style="width: 18rem;">
          <img src="/img/guru/guru3.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
          </div>
        </div>
      </a>
    </div>
    <div class="col">
      <div class="card" style="width: 18rem;">
        <img src="/img/guru/guru4.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
>>>>>>> d14b6337c0b9b122ccbd7b9630a41b1e1f8de928
