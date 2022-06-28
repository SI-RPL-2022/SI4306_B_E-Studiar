@extends('layout_login')

@section('content')
<link rel="stylesheet" href="/css/app.css">
{{-- @foreach ($detailMentor as $m) --}}
<div class="container">
  <div class="content-mentor d-flex flex-row justify-content-between" style="margin-top: 24px">
    <div class="container-dalam d-flex flex-row">
      <div class="gambar">
        <img style="border-radius: 5px; width: 300px" height="200px" src="/img/mentor/{{ $detailMentor->gambar }}"
          alt="">
        <div class="mt-4">
          <h4 class="">Rating</h4>
          <span><span class="fa fa-star checkedStar"></span> {{number_format((float)$ratingMedian, 1,'.','')}} / 5
            <small class="text-dark">({{$totalRating}}
              ulasan)</small></span>
        </div>
      </div>

      <div class="deskripsi" style="padding-left: 24px; width: 500px">
        <div class="nama">
          <h1>{{ $detailMentor->nama }}</h1>
          <h3 style="color: #FFBD07">{{ rupiah($bidang->tarif) }} / jam</h3>
          <hr style="height: 3px; width:100%">
          <h5>Mengajar Sejak : {{ $detailMentor->tahun_ngajar }} tahun</h5>
          <p class="text-justify">
          <h5>Deskripsi : </h5>{{ $detailMentor->deskripsi }}</p>

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

  {{-- Feedback Review --}}
  <div class="card shadow p-4 mb-5">
    <h3>Feedback Review</h3>
    <div class="">
      <div class="row row-cols-2 g-4 justify-content-between">
        @forelse ($feedback as $item)
        <div class="col">
          <div class="card shadow px-4 py-3" style="height: 10rem">
            <div class="d-flex justify-content-between">
              <div>
                <p class="feedback-name">{{$item->nama_pelajar}}</p>
                <p class="feedback-time">
                  {{date('d M Y',strtotime($item->created_at))}}, {{date('G:i',strtotime($item->created_at))}}
                </p>
              </div>
              <div>
                @for ($i = 1; $i <= 5; $i++) @if ($i <=$item->rating)
                  <span class="fa fa-star checkedStar"></span>
                  @else
                  <span class="fa fa-star"></span>
                  @endif
                  @endfor
              </div>
            </div>
            <p class="feedback-review">
              {{-- {{$item->feedback}} --}}

              {{Str::limit($item->feedback, 150,
              $end='...')}}
            </p>
          </div>
        </div>
        @empty
        <div class="d-flex justify-content-center w-100 mt-4">
          <h6 class="badge bg-primary">Mentor {{$detailMentor->nama}} belum mendaptkan review dari pengguna
            lain</h6>
        </div>
        @endforelse
      </div>
    </div>
  </div>
  {{-- End Feedback Review --}}
</div>
{{-- @endforeach --}}
@endsection