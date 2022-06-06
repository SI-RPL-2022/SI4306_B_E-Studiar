@extends('mentor.mentor_layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Jadwal Ajar</h1>
  <p class="mb-4">Detail jadwal ajar {{$jadwal->nama}}</p>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
      <h6 class="m-0 font-weight-bold">Status: {{$jadwal->status}}</h6>
      <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " type="button" data-bs-toggle="modal"
        data-bs-target="#update{{$jadwal->id_jadwal}}">
        Update
      </button>
    </div>

    <div class="card-body">
      <div class="row justify-content-between">
        {{-- <div class="col-3 d-flex justify-content-center">
          <img src="/img/{{$mentors->gambar}}" height="250px" width="200px" alt="" srcset=""
            style="border-radius: 16px">
        </div> --}}


        <div class="col-4 px-5">
          <h4 class="text-black">Jadwal</h4>
          <div class="">
            <h6 class="fw-bold mb-0">Tanggal</h6>
            <p>{{date('D, d M Y',strtotime($jadwal->jadwal))}}</p>
            {{-- <p>{{explode('T',$jadwal->jadwal)[0]}}</p> --}}
          </div>
          <div class="d-flex">
            <div class="me-5">
              <h6 class="fw-bold mb-0">Jam Mulai</h6>
              <p>{{date('G:i',strtotime($jadwal->jadwal))}}</p>

            </div>
            <div class="">
              <h6 class="fw-bold mb-0">Jam Berakhir</h6>
              <p>{{date('G:i',strtotime($jadwal->jadwal) + (3600*$jadwal->durasi))}}</p>
            </div>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Durasi</h6>
            <p>{{$jadwal->durasi}} jam</p>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Note</h6>
            @if ($jadwal->note)
            <p>{{$jadwal->note}}</p>
            @else
            <p>Tidak ada note saat ini</p>
            @endif
          </div>

        </div>
        <div class="col-4">
          <h4>{{$jadwal->nama}}</h4>
          <div class="">
            <h6 class="fw-bold mb-0">Email</h6>
            <p>{{$jadwal->email}}</p>
          </div>
          <div class="">
            <h6 class="fw-bold mb-0">Pendidikan</h6>
            <p>{{$jadwal->jenjang_pendidikan}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- Modal update -->
<div class="modal fade" id="update{{$jadwal->id_jadwal}}" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Jadwal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/mentor/jadwal-ajar/{{$jadwal->id_jadwal}}/update" method="post">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option selected value="{{$jadwal->status}}">{{$jadwal->status}}</option>
              <option value="Done">Done</option>
              <option value="Belum dilakukan">Belum dilakukan</option>
            </select>

          </div>
          <div class="mb-3">
            <label class="form-label">Note (opsional)</label>
            <textarea class="form-control" name="note" rows="3">{{$jadwal->note}}</textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2 fw-boldy">Update</button>
          <button type="button" data-bs-dismiss="modal"
            class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm me-2 fw-bold">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection