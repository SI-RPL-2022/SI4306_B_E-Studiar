@extends('layout')
@section('content')

<div class="row justify-content-center" style="margin-top: 90px">

  {{-- @if($errors->has('email'))
  <div class="error">{{ $errors->first('email') }}</div>
  {{$errors}}
  @endif
  @if($errors->has('password'))
  <div class="error">{{ $errors->first('password') }}</div>
  @endif --}}
  <div class="col-lg-6">
    <main class="form-registration">
      <h1 class="h3 mb-4 fw-normal text-center">Administrator | Masuk Estudiar</h1>
      <form action="/admin/login" method="POST">
        @csrf
        <div class="form-floating">
          <input type="email" class="form-control " name="email" id="email" required placeholder="name@example.com">
          <label for="email">Alamat Email</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control rounded-bottom" name="password" id="password" required
            placeholder="Password">
          <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg mt-3" style="background-color: #1780E2; color:white;"
          type="submit">Login</button>
      </form>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>


@endsection