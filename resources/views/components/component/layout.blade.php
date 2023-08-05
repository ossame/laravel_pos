<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <style>
    .logo {
      font-size: 24px;
      font-weight: bold;
    }
    .navcolor{
        background-color: #2c698d;
    }
    ul li{
      margin-left: 25px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-light navcolor">
    <div class="container">
      <a class="navbar-brand logo" href="#">MyWeb</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        @auth
        
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto pl-20">
              <li class="nav-item ">
                <button class="btn btn-dark  " onclick="search()">Search</button>
              </li>
              <li class="nav-item">
                <button class="btn btn-dark " onclick="calculateNewBill()">Calculate New Bill</button>
              </li>
              <li class="nav-item">
           
                <button class="btn btn-dark" onclick="logout()">Log Out</button>
              </li>
            </ul>
          </div>
          {{ $slot }}
        
    
        @else
        
        <form action="/login" method="POst" class="form-inline ml-auto">
          @csrf
          <div class="form-group">
            <label for="loginUsername" class="sr-only">Username</label>
            <input name="loginUsername" type="text" class="form-control mr-2" id="loginUsername" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="loginPassword" class="sr-only">Password</label>
            <input name="loginPassword" type="password" class="form-control mr-2" id="loginPassword" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary">Log in</button>
        </form>
        @endauth
      
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <h2>Welcome to MyWeb</h2>
        <p>
          This is a wonderful place where you can connect with friends and family, share updates, and discover
          interesting content.
        </p>
      </div>
      <div class="col-md-6">
        <h2>Sign Up</h2>
        <form action="/register" method="POST">
          @csrf
          <div class="form-group" >
            <label for="signupUsername">Username</label>
            <input value="{{old('username')}}" type="text" name="username" class="form-control" id="signupUsername" placeholder="Enter username">
            @error('username')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="signupEmail">Email</label>
            <input value="{{old('email')}}" type="email" name="email" class="form-control" id="signupEmail" placeholder="Enter email">
            @error('email')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="signupPassword">Password</label>
            <input type="password" name="password" class="form-control" id="signupPassword" placeholder="Enter password">
            @error('password')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="signupConfirmPassword">Confirm Password</label>
            <input type="password" name="pass2" class="form-control" id="signupConfirmPassword" placeholder="Confirm password">
            @error('pass2')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
      </div>
    </div>
  </div>
 
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
