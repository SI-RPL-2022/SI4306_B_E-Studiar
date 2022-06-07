@extends('admin.admin_layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Pembayaran</h1>

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
              <th>Nama User</th>
              <th>Id Mentor</th>
              <th>Tanggal Bayar</th>
              <th>Bukti</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama User</th>
              <th>Id Mentor</th>
              <th>Tanggal Bayar</th>
              <th>Bukti</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($pembayaran as $data)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$data->nama_user}}</td>
              <td>{{$data->id_mentor}}</td>
              <td>{{$data->tgl_bayar}}</td>
              <td><img src="/img/bukti_bayar/{{$data->bukti}}" width="50" height="30" alt="" srcset=""></td>
              <td>{{$data->status}}</td>
              <td>
                <div class="dropdown">
                  <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle"
                    type="button" id="dropdownMenuButtonAksi" data-bs-toggle="dropdown" aria-expanded="false">
                    Aksi
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonAksi">
                    <li><a class="dropdown-item" href="/admin/pembayaran/{{$data->id}}/terima">Terima</a>
                    </li>
                    <li><a class="dropdown-item" href="/admin/pembayaran/{{$data->id}}/tolak">Tolak</a></li>
                  </ul>
                </div>
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