@extends('layout_login')


@section('content')
{{-- @foreach ($detailMentor as $m) --}}
<div class="container mb-5">
  {{-- <div class="col-12 d-flex flex-column align-items-center"> --}}
    <div class="mt-2 vh-100 shadow p-5 row align-items-center justify-content-center">
      <div class="col-6 d-flex flex-column align-items-center">
        {{-- <h2>
          adada
        </h2> --}}
        <h4 class="fw-bold">Total Bayar {{rupiah($pembayaran->total_bayar)}}</h4>
        <h5>Lakukan pembayaran ke</h5>
        {{-- @if ($metode == 'Dana' or $metode == 'Gopay') --}}
        @if ($pembayaran->metode_bayar == 'Dana' or $pembayaran->metode_bayar == 'Gopay')
        <h5 class="fw-bold">082123321456</h5>
        <h6 class="mt-3 mb-3">Atau Scan</h6>
        <img src="/img/metode/qr-{{$pembayaran->metode_bayar}}.jpg" width="200" height="200" alt="" srcset="">
        @else
        <h5 class="fw-bold">4450399343095893843</h5>
        @endif
        <div class="d-flex align-items-center mt-5">
          <h5 class="me-4">Bayar Via</h5>
          <img src="/img/metode/{{$pembayaran->metode_bayar}}.png" width="150" height="50" alt="" srcset="">
        </div>
      </div>

      <div class="col-5 d-flex flex-column justify-content-center p-5">
        <form action="/transaksi/{{$pembayaran->id}}/upload-bukti" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="formFile" class="form-label">Masukan gambar sebagai bukti</label>
            <input class="form-control" type="file" name="gambar" required>
          </div>
          <button type="submit" class="btn col-12 btn-warning
              btn-md
              mt-3">Upload Sekarang</button>
        </form>
      </div>
    </div>
  </div>
  {{-- <div class="col-5 d-flex flex-column justify-content-center p-5">
    <form action="" method="post">
      @csrf
      <div class="mb-3">
        <label for="formFile" class="form-label">Masukan gambar sebagai bukti</label>
        <input class="form-control" type="file" id="formFile" name="bukti">
      </div>
      <button type="submit" class="btn col-12 btn-warning
          btn-md
          mt-3" href="/transaksi/{{$pembayaran->id}}/upload-bukti">Upload Sekarang</button>
    </form>
  </div> --}}
  {{--
</div> --}}
</div>
{{-- @endforeach --}}
@endsection