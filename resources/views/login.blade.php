<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
@include('sweetalert::alert')
<div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
      
        <div class="card my-5 border rounded">

        <h2 class="text-center text-dark mt-5">Login</h2>
        @if ($errors -> any())
        <div class="alter alter-danger m-auto" style="background-color: #e6e1e1; padding-left: 15px; border-radius: 6px; color: red; font-weight: bold; width:400px;">
            <!-- <ul> -->
                @foreach($errors -> all() as $errorMsg)
                <p>{{ $errorMsg }}</p>
                @endforeach
            <!-- </ul> -->
        </div>
        @endif
          <form class="card-body cardbody-color p-lg-5" method="POST" action="">
          @csrf
            <div class="mb-3 form-floating">
              <input type="email" class="form-control" id="floating-inp" aria-describedby="emailHelp"
                placeholder="Email" name="email">
                <label for="floating-inp">Email</label>
            </div>
            <div class="mb-3 form-floating">
              <input type="password" class="form-control" id="floating-inp" placeholder="password" name="password">
              <label for="floating-inp">Password</label>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100 btn-secondary" name="submit">Login</button></div>
            <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
              Registered? <a href="/register" class="text-dark fw-bold"> Create an
                Account</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div> 

  <!-- <img src="{{ url('/images/arch.png') }}" alt=""> -->

</body>
</html>