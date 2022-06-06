@extends('layout')
@section('content')
<link rel="stylesheet" href="/assets/css/guru.css" />

{{--
<link href="assets/css/theme.css" rel="stylesheet" /> --}}
{{--
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

<div class="d-flex justify-content-center align-items-center mt-6">
  <div>
    <form action="/pencarianguru/filter" method="post">
      @csrf
      {{-- <h1>Search</h1> --}}
      <div class="d-flex">
        <input type="text" value="{{!empty($keyword) ? $keyword : ''}}" name="keyword"
          class="search-field guru col-sm-12 shadow"
          placeholder="Tuliskan nama, bidang materi atau guru yang diinginkan">
        {{-- <input type="text" class="search-field lokasi shadow" placeholder="Lokasi?"> --}}
        <div class="filter-btn ms-2 me-2">

          <div class="dropdown">
            <button class="btn dropdown-toggle" href="#" role="button" id="filter" data-bs-toggle="dropdown"
              aria-expanded="false">
              Filter
            </button>

            <div class="dropdown-menu" aria-labelledby="filter">
              <div class="pengalaman p-4 mb-0">
                <h5>Pengalaman Guru/Mentor</h5>
                <div class="input-group mb-3">
                  <input type="number" class="form-control" value="{{!empty($min_year) ? $min_year : 0}}"
                    placeholder="Min tahun" name="min_year">
                  <input type="number" class="form-control" value="{{!empty($max_year) ? $max_year : 0}}"
                    placeholder="Max tahun" name="max_year">
                </div>
              </div>
              <hr class="dropdown-divider mt-0 mb-0">
              <div class="tarif p-4">
                <h5>Range Tarif</h5>
                <div class="slidecontainer">
                  <label for="">Dari: <span id="display_price_from"></span></label>
                  <input type="range" min="0" max="1000000" value="{{!empty($price_from) ? $price_from : 0}}"
                    class="slider" id="price_from">
                  <input type="hidden" name="price_from" id="min_price">
                </div>
                <div class="slidecontainer mt-4">
                  <label for="">Sampai: <span id="display_price_to"></span></label>
                  <input type="hidden" name="price_to" id="max_price">
                  <input type="range" min="0" max="1000000" value="{{!empty($price_from) ? $price_to : 0}}"
                    class="slider" name="price_to" id="price_to">
                </div>
              </div>
              {{-- <button class="btn btn-primary col-12" type="submit" style="background: #1780E2">Submit Filter
                Pencarian</button> --}}
            </div>
          </div>
        </div>
        <button class="search-btn shadow" type="submit">Cari</button>
      </div>
    </form>


  </div>
</div>
<div class="container mt-5">
  <p class="mb-0">Menampilkan @if (empty($keyword) and empty($price) and empty($max_year))
    <span class="badge bg-light text-dark">semua hasil</span>
    @else
    <span class="badge bg-light text-dark">{{$keyword}}</span>

    @if (!empty($price))
    <span class="badge bg-light text-dark">range tarif {{$price}}</span>
    @endif

    @if (!empty($max_year))
    <span class="badge bg-light text-dark">{{$min_year}} - {{$max_year}} tahun pengalaman</span>
    @endif

    <a href="/pencarianguru"><span class="badge bg-danger text-white"><i class="fa-solid fa-xmark me-2"></i></i>reset
        filter</span></a>

    @endif
  </p>

  <div
    class="row mt-5 row-cols-1 row-cols-sm-2 row-cols-md-3 {{$list_guru->count() < 1 ? 'justify-content-center align-items-center mt-5' : ''}}">
    @forelse ($list_guru as $data)
    <div class="col-4 card-guru">
      <a href="/detail/mentor/{{$data->id_mentor}}" class="">
        <div class="card">
          <div class="thumbnail-img">
            <img src="/img/kelas/{{$data->id_mentor}}/{{$data->gambar}}" width="100%" height="100%" alt="...">
            <div class="guru-name">
              <p class="card-text">{{$data->nama}}</p>
            </div>
            <div class="bidang-ajar">
              <p class="mb-0 mt-0">{{$data->bidang}}</p>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text title-kelas">{{$data->nama_kelas}}</p>
            <p class="card-text deskripsi">{{Str::limit($data->deskripsi, 100,
              $end='...')}}
            </p>
            <div class="label-guru mb-2">{{rupiah($data->tarif)}}/jam</div>
            <div class="label-guru mb-2">{{$data->tahun_ngajar}} tahun pengalaman</div>
          </div>
        </div>
      </a>
    </div>
    @empty
    <div class="">
      <img src="/img/no-results-found.png" width="100%" alt="" srcset="">
      <h2 class="text-center">Tidak ada data ditemukan</h2>
    </div>
    @endforelse
  </div>
</div>


{{-- HASIL LAINNYA --}}
@if (!empty($keyword) or !empty($price) or !empty($max_year))
<div class="container" style="margin-top: 5rem">
  <hr>
  <h4 class="mb-0">Lihat mentor guru - guru hebat lainnya</h4>

  <div
    class="row mt-5 row-cols-1 row-cols-sm-2 row-cols-md-3 {{$data_guru->count() < 1 ? 'justify-content-center align-items-center mt-5' : ''}}">
    @foreach ($data_guru as $item)
    <div class="col-4 card-guru">
      <a href="/detail/mentor/{{$item->id_mentor}}" class="">
        <div class="card">
          <div class="thumbnail-img">
            <img src="/img/kelas/{{$item->id_mentor}}/{{$item->gambar}}" width="100%" height="100%" alt="...">
            <div class="guru-name">
              <p class="card-text">{{$item->nama}}</p>
            </div>
            <div class="bidang-ajar">
              <p class="mb-0 mt-0">{{$item->bidang}}</p>
            </div>
          </div>
          <div class="card-body">
            <p class="card-text title-kelas">{{$item->nama_kelas}}</p>
            <p class="card-text deskripsi">{{Str::limit($item->deskripsi, 100,
              $end='...')}}
            </p>
            <div class="label-guru mb-2">{{rupiah($item->tarif)}}/jam</div>
            <div class="label-guru mb-2">{{$item->tahun_ngajar}} tahun pengalaman</div>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endif



<script>
  const price_from = document.getElementById("price_from");
  const display_price_from = document.getElementById("display_price_from");

  const price_to = document.getElementById("price_to");
  const display_price_to = document.getElementById("display_price_to");

  const min_price = document.getElementById("min_price");
  const max_price = document.getElementById("max_price");

  function formatRupiah(angka, prefix){
    const number_string = angka.replace(/[^,\d]/g, '').toString()
    const split = number_string.split(',')
    const sisa = split[0].length % 3
    let rupiah = split[0].substr(0, sisa)
    const ribuan = split[0].substr(sisa).match(/\d{3}/gi);
  
    if(ribuan){
      let separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
  
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }

  display_price_from.innerHTML = price_from.value;
  price_from.oninput = function() {
    min_price.value = this.value;
    display_price_from.innerHTML = formatRupiah(this.value, 'Rp. ');
  }

  display_price_to.innerHTML = price_to.value;
  price_to.oninput = function() {
    max_price.value = this.value;
    display_price_to.innerHTML = formatRupiah(this.value, 'Rp. ');
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
@endsection