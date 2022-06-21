@extends('mentor.mentor_layout')
@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  {{-- <h1 class="h3 mb-2 text-gray-800">Jadwal Ajar | Table</h1>
  <p class="mb-4">Berikut Jadwal Ajar.</p> --}}

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Feedback</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>#</th>
              <th width="20%">Nama Pelajar</th>
              <th width="13%">Rating</th>
              <th>Feedback</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($feedback as $item)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>{{$item->nama_pelajar}}</td>
              <td class="text-center">
                <div>
                  @for ($i = 1; $i <= 5; $i++) @if ($i <=$item->rating)
                    <span class="fa fa-star fa-xs checkedStar"></span>
                    @else
                    <span class="fa fa-star fa-xs"></span>
                    @endif
                    @endfor
                </div>
              </td>
              <td>{{Str::limit($item->feedback, 100,
                $end='...')}}</td>
              <td>
                <button type="Detail" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                  data-bs-toggle="modal" data-bs-target="#detailFeedback{{$item->id}}">
                  Detail
                </button>
              </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="detailFeedback{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row mb-2">
                      <div class="col-3">
                        Nama
                      </div>
                      <div class="col-9">
                        : {{$item->nama_pelajar}}
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-3">
                        Rating
                      </div>
                      <div class="col-9">
                        <div>:
                          @for ($i = 1; $i <= 5; $i++) @if ($i <=$item->rating)
                            <span class="fa fa-star fa-xs checkedStar"></span>
                            @else
                            <span class="fa fa-star fa-xs"></span>
                            @endif
                            @endfor
                            <span>({{$item->rating}})</span>
                        </div>

                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-3">
                        Review Feedback
                      </div>
                      <div class="col-9">
                        : {{$item->feedback}}
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                      data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Pelajar</th>
              <th>Rating</th>
              <th>Feedback</th>
              <th>
                Aksi
              </th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection