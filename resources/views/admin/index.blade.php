@extends('admin.admin_layout')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  <div class="d-flex align-items-center">
    <label class="form-label">Filter hari</label>
    <form action="/admin/filter" id="formMetodeBayar" class="col" method="post">
      @csrf
      <select id="filterMetodeBayar" class="form-select" name="filter" aria-label="Default select example">
        <option selected disabled>{{$filter != null ? $filter : 'Semua Waktu'}}</option>
        <option value="*">Semua Waktu</option>
        <option value="1">1 hari terakhir</option>
        <option value="7">7 hari terakhir</option>
        <option value="30">30 hari terakhir</option>
        <option value="90">3 bulan terakhir</option>
        <option value="180">6 bulan terakhir</option>
        <option value="360">1 tahun terakhir</option>
      </select>
    </form>

  </div>
  {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
</div>

<div class="row">

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Pendapatan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{rupiah($total_pendapatan)}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Transaksi</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_transaksi}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Mentor
            </div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$total_mentor}}</div>
              </div>

            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Total User</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_murid}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-comments fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->
<div class="row">
  {{-- Start --}}
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ $chart3->options['chart_title'] }}</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        {{-- <div class="chart-area"> --}}
          {!! $chart3->renderHtml() !!}
          {{-- </div> --}}
      </div>
    </div>
  </div>
  {{-- END --}}

  <!-- Bidang Ajar -->
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ $chart1->options['chart_title'] }}</h6>
      </div>
      <div class="card-body">
        {!! $chart1->renderHtml() !!}
      </div>
    </div>
  </div>



  <!-- End Bidang Ajar -->
</div>


<div class="row">
  {{-- Start --}}
  <div class="col-xl-7 col-lg-6">
    <div class="card shadow mb-4" style="height: 100%">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ $pendapatan->options['chart_title'] }}</h6>
        <form action="/admin/filterPendapatan" id="formPendapatan" class="col-5" method="post">
          @csrf
          <select id="filterPendapatan" class="form-select " name="filterPendapatan"
            aria-label="Default select example">
            <option selected disabled>{{$filterPendapatan ? 'Pendapatan ' . $filterPendapatan : 'Pendapatan perhari'}}
            </option>
            <option value="day">Perhari</option>
            <option value="month">Perbulan</option>
            <option value="year">Pertahun</option>
          </select>
        </form>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        {{-- <div class="chart-area"> --}}
          {!! $pendapatan->renderHtml() !!}
          {{-- </div> --}}
      </div>
    </div>
  </div>


  {{-- END --}}
  <!-- Bidang Ajar -->
  <div class="col-xl-5 col-lg-6">
    <div class="card shadow mb-4" style="height: 100%">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ $mentorLaku['chart_title'] }}</h6>

      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center" scope="col">Nama</th>
              <th class="text-center" scope="col">Peminat</th>
              <th class="text-center" scope="col">Pendapatan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mentorLaku['data'] as $item)
            <tr>
              <td class="text-center"><a class="fw-bold text-center" style="color: rgb(117, 117, 117)"
                  href="/admin/mentor/{{$item->id_mentor}}/detail">{{$item->nama}}</a>
              </td>

              <td class="text-center">
                {{-- <span class="badge bg-info">{{$item->total}}</span> --}}
                {{$item->total}}
              </td>

              <td class="text-center">
                <span class="badge bg-success">{{rupiah($item->totalPendapatan)}}</span>
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4 mt-4">
      <!-- Card Header - Dropdown -->
      <div class="card-body">
        <div class="table-transaksi">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Mentor</th>
                <th scope="col">Nama User</th>
                <th scope="col">Status</th>
                <th scope="col">Nominal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transaksi as $item)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$item->mentors->nama}}</td>
                <td>{{$item->users->nama}}</td>
                <td>{{$item->status}}</td>
                <td>{{$item->total_bayar}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End Bidang Ajar -->
</div>

@endsection

<script>
  window.onload = function(){
    const formMetodeBayar = document.getElementById('formMetodeBayar');
    const filterMetodeBayar = document.getElementById('filterMetodeBayar');

    const formPendapatan = document.getElementById('formPendapatan');
    const filterPendapatan = document.getElementById('filterPendapatan');

    filterMetodeBayar.addEventListener('change', function() {
      if (filterMetodeBayar.value != '') {
        formMetodeBayar.submit()
      }
    })

    filterPendapatan.addEventListener('change', function() {
      if (filterPendapatan.value != '') {
        formPendapatan.submit()
      }
    })
  }
  
</script>

{{-- BSAS --}}
@section('javascript')
{!! $chart1->renderChartJsLibrary() !!}

{!! $chart1->renderJs() !!}
{!! $pendapatan->renderJs() !!}
{!! $chart3->renderJs() !!}
@endsection
{{-- BSAS --}}