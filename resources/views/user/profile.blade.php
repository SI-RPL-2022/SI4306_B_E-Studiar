@extends('layout_login')

@section('content')
{{-- @foreach ($detailMentor as $m) --}}
<div class="container">
  <div class="content-mentor row flex-row justify-content-between" style="margin-top: 24px">

    <div class="container-dalam d-flex flex-row col-5">

      {{-- <div class="gambar">
        <img style="border-radius: 5px; width: 300px" src="/img/{{ $detailMentor->gambar }}" alt="">
      </div> --}}

      <div class="deskripsi" style="padding-left: 24px; width: 500px">
        <div class="nama">
          <h1>{{ $users->nama }}</h1>
          <h3 style="color: #FFBD07">{{$users->email}}</h3>

          {{--
          <hr style="height: 3px; width:100%"> --}}
          {{--
          <p>Mengajar Sejak : {{ $detailMentor->tahun_ngajar }}</p>
          <p class="text-justify">Desripsi : {{ $detailMentor->deskripsi }}</p> --}}

        </div>
      </div>

    </div>

    <div class="reservasi col-7" style="border-width: 1px; border-radius: 5px;">
      <div class="card shadow p-4">
        {{-- <h2>Status Permintaan Ajar</h2> --}}
        {{-- <br> --}}
        <div class="d-flex justify-content-between">
          <h4>Status: Diterima </h4>
          <h4>No Transaksi: 23242524</h4>
        </div>
        <hr>
        <div class="row">
          <h6 class="col-3">Mentor </h6>
          <h6 class="col-9">: James Rodrigues</h6>
        </div>
        <div class="row">
          <h6 class="col-3">Email Mentor </h6>
          <h6 class="col-9">: james@gmail.com</h6>
        </div>
        <div class="row">
          <h6 class="col-3">Jadwal </h6>
          <h6 class="col-9">: 09-11-2022, 13:00 - 14:00</h6>
        </div>
        <div class="row">
          <h6 class="col-3">Link </h6>
          <h6 class="col-9">: *selesaikan pembayaran dahulu</h6>
        </div>
        <hr>
        <div class="row">
          <div class="col-7">
            <h6 class="">Tanggal Melakukan Permintaan </h6>
            <h5 class="">09-11-2022</h5>
          </div>
          <div class="col-5 d-flex flex-column align-items-end">
            <h6 class="">Total Bayar</h6>
            <h5 class="">Rp. 500.000</h5>
          </div>
        </div>
        <hr>
        <a class="btn btn-warning btn-md mt-3" href="/transaksi/bayar">Bayar Sekarang</a>
        {{-- <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Mentor</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
          </tbody>
        </table> --}}
      </div>
    </div>

  </div>
</div>
{{-- @endforeach --}}
@endsection