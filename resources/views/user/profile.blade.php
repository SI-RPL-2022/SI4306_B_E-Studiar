@extends('layout_login')


@section('content')
{{-- @foreach ($detailMentor as $m) --}}
<div class="container">
  <div class="content-mentor row flex-row justify-content-between" style="margin-top: 24px">

    <div class="container-dalam d-flex flex-row col-5">

      {{-- <div class="gambar">
        <img style="border-radius: 5px; width: 300px" src="/img/{{ $detailMentor->gambar }}" alt="">
      </div> --}}

      <div class="deskripsi" style="padding-left: 24px; width: 500px">
        <div class="nama">
          {{-- <h1>{{ $users->nama }}</h1>
          <h3 style="color: #FFBD07">{{$users->email}}</h3> --}}
          <h1>{{auth()->user()->nama}}</h1>
          <h3 style="color: #FFBD07">{{auth()->user()->email}}</h3>

          {{--
          <hr style="height: 3px; width:100%"> --}}
          {{--
          <p>Mengajar Sejak : {{ $detailMentor->tahun_ngajar }}</p>
          <p class="text-justify">Desripsi : {{ $detailMentor->deskripsi }}</p> --}}

        </div>
        <hr>
        <div class="card shadow py-2">
          <h5 class="ps-3 pt-3">Permintaan Ajar (Pending)</h5>
          <small class="ps-3 pb-3">* Belum / tidak di acc oleh mentor</small>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Mentor</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($permintaan as $item)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>
                  {{$item->nama_mentor}}
                  {{-- {{date('d-m-y',strtotime($item->created_at))}}, {{date('G:i',strtotime($item->created_at))}} --}}
                </td>
                <td>{{$item->status}}</td>
                <td>
                  <a class="btn btn-warning btn-sm" href="#" data-bs-toggle="modal"
                    data-bs-target="#detail{{$item->id}}">Detail</a>
                </td>
              </tr>
              <!-- Modal Detail -->
              <div class="modal fade" id="detail{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Detail Permintaan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <div class="row">
                        <div class="col-3">
                          <h6>Status</h6>
                        </div>
                        <div class="col-9">
                          <p style="font-size: 14px">: {{$item->status}}</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-3">
                          <h6>Mentor</h6>
                        </div>
                        <div class="col-9">
                          <p style="font-size: 14px">: {{$item->nama_mentor}} | {{$item->mentor_email}}</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-3">
                          <h6>Alasan</h6>
                        </div>
                        <div class="col-9">
                          <textarea disabled id="" cols="13" class="form-control mb-2"
                            style="font-size: 12px; padding: 4px;">{{$item->note}}</textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-3">
                          <h6>Tanggal Permintaan</h6>
                        </div>
                        <div class="col-9">
                          <p style="font-size: 14px">: {{date('D, d-m-Y',strtotime($item->created_at))}}, Pukul
                            {{date('G:i',strtotime($item->created_at))}}</>
                        </div>
                      </div>
                      {{-- <p>Apakah anda yakin akan menolak permintaan ajar dari pelajar <span
                          class="fw-bold">{{$data->nama}}</span></p>
                      <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" name="note" rows="3" required></textarea>
                      </div> --}}
                    </div>
                    <div class="modal-footer">
                      <button type="button" data-bs-dismiss="modal"
                        class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm me-2 fw-bold">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              {{-- --}}
              @endforeach
            </tbody>
          </table>
        </div>
        <hr>
        <div class="card shadow py-2">
          <h5 class="p-3">History Permintaan Ajar</h5>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jadwal as $item)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>
                  {{date('d-m-y',strtotime($item->jadwal))}}, {{date('G:i',strtotime($item->jadwal))}}
                </td>
                <td>{{$item->status}}</td>
                <td>
                  <a class="btn btn-warning btn-sm"
                    href="/user/profile/{{auth()->user()->id}}/transaksi/{{$item->id_bayar}}">Detail</a>

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="reservasi col-7" style="border-width: 1px; border-radius: 5px;">
      <div class="card shadow p-4">
        {{-- <h2>Status Permintaan Ajar</h2> --}}
        {{-- <br> --}}
        @if (empty($detail))
        <h6>Klik detail untuk menampilkan jadwal ajar anda secara lengkap</h6>
        @else
        <div class="d-flex justify-content-between">
          <h4>Status: <span
              class="badge {{$detail->status != 'Terverifikasi' ? 'bg-danger' : 'bg-light text-dark'}}">{{$detail->status}}</span>
          </h4>
          <h4>No Transaksi: {{$detail->id}}</h4>
        </div>
        <hr>
        <div class="row">
          <h6 class="col-3">Status Jadwal </h6>
          <h6 class="col-9">: {{$detail->jadwal_status}}</h6>
        </div>
        <div class="row">
          <h6 class="col-3">Mentor </h6>
          <h6 class="col-9">: {{$detail->nama_mentor}}</h6>
        </div>
        <div class="row">
          <h6 class="col-3">Email Mentor </h6>
          <h6 class="col-9">: {{$detail->email_mentor}}</h6>
        </div>
        <div class="row">
          <h6 class="col-3">Jadwal </h6>
          <h6 class="col-9">: {{date('d-m-y',strtotime($detail->jadwal_ajar))}},
            {{date('G:i',strtotime($detail->jadwal_ajar))}} - {{date('G:i',strtotime($detail->jadwal_ajar) +
            (3600*$detail->jadwal_durasi))}} ({{$detail->jadwal_durasi}} jam)
          </h6>
        </div>
        <div class="row">
          <h6 class="col-3">Link </h6>
          <h6 class="col-9">:
            {{-- <span class="badge bg-warning text-dark">Warning</span> --}}
            @if ($detail->status == 'Terverifikasi')
            <a href="{{$detail->jadwal_link}}" target="__blank">{{$detail->jadwal_link}}</a>
            @else
            <span class="badge bg-danger">*selesaikan
              pembayaran
              dahulu</span>
            @endif

          </h6>
        </div>
        <hr>
        <form action="/transaksi/{{$detail->id}}/bayar" method="post">
          @csrf
          <div class="row">
            <div class="col-5">
              <h6 class="">Metode Bayar </h6>
              <select {{$detail->status != 'Terverifikasi' ? '' : 'disabled'}} class="form-select"
                name="metode_bayar">
                <option selected value="{{$detail->metode_bayar}}">{{$detail->status != 'Terverifikasi' ? 'Pilih opsi' :
                  $detail->metode_bayar}}</option>
                <option value="Bank BCA">Bank BCA</option>
                <option value="Gopay">Gopay</option>
                <option value="Dana">Dana</option>
              </select>
              {{-- <h5 class="">{{date('d-m-y',strtotime($detail->))}}</h5> --}}
            </div>
            <div class="col-7 d-flex flex-column align-items-end">
              <h6 class="">Total Bayar</h6>
              <h4 class=""><span class="badge bg-warning">{{rupiah($detail->total_bayar)}}</span></h4>
            </div>
          </div>
          <hr>
          <button type="submit" {{$detail->status != 'Terverifikasi' ? '' : 'disabled'}} class="btn col-12 btn-warning
            btn-md
            mt-3"
            href="/transaksi/{{$detail->id}}/bayar">{{$detail->status == 'Terverifikasi' ? 'Sudah bayar & terverifikasi'
            : 'Bayar Sekarang'}}</button>
        </form>
        @endif
      </div>
    </div>

  </div>
</div>
{{-- @endforeach --}}
@endsection