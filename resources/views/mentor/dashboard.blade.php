<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <h1>DASHBOARD MENTOR</h1>
  @if (auth()->user())
  <div class="d-flex ms-lg-4 ">
    <h5>Hai, {{ auth()->user()->nama }}</h5>
    <form action="/user/logout" method="POST">
      @csrf
      <button class="btn btn-danger" style="margin-left:8px">Logout</button>
    </form>
  </div>
  @endif
</body>

</html>