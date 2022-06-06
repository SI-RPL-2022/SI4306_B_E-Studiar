@extends('mentor.mentor_layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Jadwal Ajar | Table</h1>
  <p class="mb-4">Berikut Jadwal Ajar.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Table</h6>
      <a href="/mentor/jadwal-ajar/calendar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ">
        Lihat Kalender
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Jadwal</th>
              <th>Durasi</th>
              <th>Link</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Jadwal</th>
              <th>Durasi</th>
              <th>Link</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($jadwal as $data)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$data->nama}}</td>
              <td>{{date('d-m-y',strtotime($data->jadwal))}}, {{date('G:i',strtotime($data->jadwal))}}</td>
              <td>{{$data->durasi}} jam</td>
              <td><a href="{{$data->link}}" target=”_blank”>{{$data->link}}</a></td>
              <td>{{$data->status}}</td>
              <td>
                <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm "
                  href="/mentor/jadwal-ajar/{{$data->id_jadwal}}">
                  Detail
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


@endsection