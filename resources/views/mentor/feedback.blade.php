@extends('mentor.mentor_layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  {{-- <h1 class="h3 mb-2 text-gray-800">Jadwal Ajar | Table</h1>
  <p class="mb-4">Berikut Jadwal Ajar.</p> --}}

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Table</h6>

    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Pelajar</th>
              <th>Rating</th>
              <th>Feedback</th>
            </tr>
          </thead>


        </table>
      </div>
    </div>
  </div>

</div>
@endsection