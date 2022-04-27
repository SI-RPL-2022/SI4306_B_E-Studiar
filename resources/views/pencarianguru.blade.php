@extends('layout')
@section('content')
<link rel="stylesheet" href="assets/css/guru.css" />

<link href="assets/css/theme.css" rel="stylesheet" />

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
          <img src="/img/guru/guru2.jpg" class=" card-img-top" alt="...">
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