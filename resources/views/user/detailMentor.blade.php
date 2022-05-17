@extends('layout_login')

@section('content')
{{-- @foreach ($detailMentor as $m) --}}
<div class="container">
  <div class="content-mentor d-flex flex-row justify-content-between" style="margin-top: 24px">

    <div class="container-dalam d-flex flex-row">

      <div class="gambar">
        <img style="border-radius: 5px; width: 300px" src="/img/{{ $detailMentor->gambar }}" alt="">
      </div>

      <div class="deskripsi" style="padding-left: 24px; width: 500px">
        <div class="nama">
          <h1>{{ $detailMentor->nama }}</h1>
          <h3 style="color: #FFBD07">{{ rupiah($bidang->tarif) }}</h3>

          <hr style="height: 3px; width:100%">

          <p>Mengajar Sejak : {{ $detailMentor->tahun_ngajar }}</p>
          <p class="text-justify">Desripsi : {{ $detailMentor->deskripsi }}</p>

        </div>
      </div>
    </div>

    <div class="reservasi" style="width: 268px; height: 330px; border-width: 1px; border-radius: 5px;">
      <h3>Atur Reservasi</h3>
      <br>
      <div class="container-form">
        <form action="/permintaan/ajar" method="post">
          @csrf
          <input type="hidden" name="id_bidang" value="{{$bidang->id}}">
          <label class="form-label">Durasi</label>
          <select name="durasi" class="form-select" aria-label="Default select example">
            <option selected disabled>Durasi Kursus</option>
            <option value="1">Satu Jam</option>
            <option value="2">Dua Jam</option>
            <option value="3">Tiga Jam</option>
            <option value="4">Empat Jam</option>
            <option value="5">Lima Jam</option>
          </select>
          <br>
          <div class="mb-3">
            <label class="form-label">Jadwal</label>
            <input name="jadwal" type="datetime-local" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- @endforeach --}}
@endsection