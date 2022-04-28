@extends('layout')
@section('content')
<link rel="stylesheet" href="/assets/css/guru.css" />

{{--
<link href="assets/css/theme.css" rel="stylesheet" /> --}}
{{--
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

<div class="d-flex justify-content-center align-items-center mt-6">
  <form action="/pencarianguru/filter" method="post">
    @csrf
    {{-- <h1>Search</h1> --}}
    <div class="form-box">
      <input type="text" name="keyword" class="search-field guru shadow" placeholder="Cari Materi?">
      <input type="text" class="search-field lokasi shadow" placeholder="Lokasi?">
      <button class="search-btn shadow" type="submit">Cari</button>
    </div>
  </form>
</div>
<div class="container mt-5">
  <p class="mb-0">Menampilkan @if (empty($keyword))
    <b>semua hasil</b>
    @else
    hasil terkait <b>{{$keyword}}</b>
    @endif
  </p>
  <p class="mt-0">Tarif ajar: @if (empty($price))
    <b>semua</b>
    @else
    <b>{{$price}}</b>
    @endif
  </p>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 justify-content-between">
    @forelse ($list_guru as $data)
    <div class="col-4 card-guru">
      <a href="" class="">
        <div class="card">
          <img src="/img/kelas/{{$data->id_mentor}}/{{$data->gambar}}" height="200px" alt="...">
          <div class="card-body">
            <p class="card-text">{{$data->nama}}</p>
            <p class="card-text">{{$data->bidang}}</p>
            <p class="card-text">{{$data->nama_kelas}}</p>
            <p class="card-text">{{$data->tarif}}</p>
          </div>
        </div>
      </a>
    </div>
    @empty
    <h5>Tidak ada data</h5>
    @endforelse


  </div>
</div>


@endsection