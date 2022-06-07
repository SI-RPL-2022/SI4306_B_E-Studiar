@extends('mentor.mentor_layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Permintaan Ajar</h1>
  <p class="mb-4">Berikut merupakan data user yang melakukan permintaan ajar terhadap anda.</p>

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
              <th>Status</th>
              <th>Jadwal Ajar</th>
              <th>Durasi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>#</th>
              <th>Nama User</th>
              <th>Email</th>
              <th>Status</th>
              <th>Jadwal Ajar</th>
              <th>Durasi</th>
              <th>Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($permintaan_ajar as $data)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$data->nama}}</td>
              <td>{{$data->email}}</td>
              <td>{{$data->status}}</td>
              <td>{{$data->jadwal}}</td>
              <td>{{$data->durasi}} jam</td>
              <td>
                <div class="dropdown">
                  <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm dropdown-toggle"
                    type="button" id="dropdownMenuButtonAksi" data-bs-toggle="dropdown" aria-expanded="false">
                    Aksi
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonAksi">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                        data-bs-target="#terima{{$data->id_permintaan}}">Terima</a>
                    </li>
                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#tolak{{$data->id_permintaan}}"
                        href="#">Tolak</a></li>
                  </ul>
                </div>
              </td>
            </tr>

            <!-- Modal Terima -->
            <div class="modal fade" id="terima{{$data->id_permintaan}}" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penerimaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/mentor/permintaan-ajar/{{$data->id_permintaan}}/terima" method="post">
                    @csrf
                    <div class="modal-body">
                      <p>Apakah anda yakin akan menerima permintaan ajar dari pelajar <span
                          class="fw-bold">{{$data->nama}}</span>?</p>
                      <hr>
                      <div class="mb-3">
                        <label class="form-label">Link Meet</label>
                        <input type="text" name="link" class="form-control" placeholder="masukan link mentoring"
                          required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Note (opsional)</label>
                        <textarea class="form-control" name="note" rows="3"></textarea>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="submit"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2 fw-boldy">Terima</button>
                      <button type="button" data-bs-dismiss="modal"
                        class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm me-2 fw-bold">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- --}}

            <!-- Modal Tolak -->
            <div class="modal fade" id="tolak{{$data->id_permintaan}}" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="/mentor/permintaan-ajar/{{$data->id_permintaan}}/tolak" method="post">
                    @csrf
                    <div class="modal-body">
                      <p>Apakah anda yakin akan menolak permintaan ajar dari pelajar <span
                          class="fw-bold">{{$data->nama}}</span></p>
                    </div>
                    <div class="modal-footer">
                      <button type="submit"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm me-2 fw-boldy">Tolak</button>
                      <button type="button" data-bs-dismiss="modal"
                        class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm me-2 fw-bold">Batal</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            {{-- --}}
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>


@endsection