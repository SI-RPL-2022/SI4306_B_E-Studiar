@extends('admin.admin_layout')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

  @if (auth()->user())
  <div class="d-flex ms-lg-4">
    <h5>Hai, {{ auth()->user()->nama }}</h5>
    <form action="/user/logout" method="POST">
      @csrf
      <button class="btn btn-danger" style="margin-left:8px">Logout</button>
    </form>
  </div>
  @endif

</div>
@endsection