@extends('admin.admin_layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Mentor</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Tanggal Lahir</th>
              <th>Pengalaman Ngajar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Tanggal Lahir</th>
              <th>Pengalaman Ngajar</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($mentors as $data)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$data->nama}}</td>
              <td>{{$data->email}}</td>
              <td>{{$data->tgl_lahir}}</td>
              <td>{{$data->tahun_ngajar}} tahun</td>
              <td>
                <a href="/admin/mentor/{{$data->id}}/detail"
                  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-circle-info fa-sm text-white-50"></i> Detail</a>
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