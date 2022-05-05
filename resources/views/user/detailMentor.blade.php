@extends('layout_login')

@section('content')
@foreach ($detailMentor as $m)
<div class="container">
  <div class="content-mentor d-flex flex-row justify-content-between" style="margin-top: 24px">

    <div class="container-dalam d-flex flex-row">

      <div class="gambar">
        <img style="border-radius: 5px; width: 300px" src="{{ $m->gambar }}" alt="">
      </div>

      <div class="deskripsi" style="padding-left: 24px; width: 500px">
        <div class="nama">
          <h1>{{ $m->nama }}</h1>
          <h3 style="color: #FFBD07">Rp {{ $m->harga }}</h3>

          <hr style="height: 3px; width:100%">

          <p>Mengajar Sejak : {{ $m->tahun_ngajar }}</p>
          <p class="text-justify">Desripsi : {{ $m->deskripsi }}</p>

        </div>
      </div>
    </div>

    <div class="reservasi" style="width: 268px; height: 330px; border-width: 1px; border-radius: 5px;">
      <h3>Atur Reservasi</h3>
      <br>
      <div class="container-form">
        <form action="">
          <select class="form-select" aria-label="Default select example">
            <option selected>Durasi Kursus</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>

          <br>
          <button type="button" class="btn btn-primary">Primary</button>
        </form>




      </div>
    </div>

  </div>
</div>
@endforeach
@endsection