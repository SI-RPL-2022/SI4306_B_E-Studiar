@extends('mentor.mentor_layout')
@section('content')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script> --}}
{{--
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" />
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Jadwal Ajar | Kalender</h1>
  <p class="mb-4">Berikut merupakan data user yang melakukan Jadwal ajar terhadap anda.</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Kalendar</h6>
      <a href="/mentor/jadwal-ajar" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm ">
        Lihat Table
      </a>
    </div>
    <div class="card-body">
      {!! $calendar->calendar() !!}
      {!! $calendar->script() !!}
    </div>
  </div>

</div>



@endsection