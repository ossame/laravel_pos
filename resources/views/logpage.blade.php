<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="shortcut icon" href="img/logo.png" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&family=Nanum+Gothic:wght@400;700;800&family=Quicksand:wght@300;400;500;600&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

  <style>
    .body{
      font-family: 'montserrat';
    }
    
   
    .navcolor{
       
        background-color: #A9C1E1;
        /* opacity: 0.5; */
    }
    ul li{
      margin-left: 25px;
    }

    .custom-container {
      background-color: #d1f5d3; /* Light green background color */
      padding: 20px;
      border-radius: 10px;
    }
    .custom-container2 {
      background-color: #ffcccc; /* Light red background color */
      padding: 20px;
      border-radius: 10px;
    }

    .custom-text2 {
      color: black; 
    }

    .footer {
      background-color: #f8f9fa; /* Light gray background color */
      padding: 20px;
      text-align: center;
      position: absolute;
      bottom: 0;
      width: 100%;
    }
    .para{
      margin-top: 15%;
      font-size: 2.5rem;

    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-light navcolor">
    <div class="container">
      <a class="navbar-brand" href="/"><img height="55px" src="{{ asset('img/logo.png') }}" alt="logo"></a>
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
                <button class="btn btn-dark" onclick="search()">rechercher</button>
                </li>
                <li class="nav-item">
                <button class="btn btn-dark" onclick="calculateNewBill()">Calculer nouvelle facture</button>
                </li>
                <li class="nav-item">
                </li>
            </ul>
        </div>

        
    
        @else
        
        <form action="/login" method="POST" class="form-inline ml-auto">
          @csrf
          <div class="form-group">
            <label for="loginUsername" class="sr-only">Nom d'utilisateur</label>
            <input name="loginUsername" type="text" class="form-control mr-2" id="loginUsername" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="loginPassword" class="sr-only">Mot de passe</label>
            <input name="loginPassword" type="password" class="form-control mr-2" id="loginPassword" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
        @endauth
      
      </div>
    </div>
  </nav>


 <!--------------------------------------------- -->



@if(session()->has('success'))
<div class="container">
  <div class="custom-container">
    <div class="text-center custom-text">
      {{session('success')}}
    </div>
  </div>
</div>
@endif

@if(session()->has('failure'))
  <div class="container">
    <div class="custom-container2">
      <div class="text-center custom-text2">
        {{ session('failure') }}
      </div>
    </div>
  </div>
@endif

 <!--------------------------------------------- -->

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <p class="para">
          Commencez dès maintenant et prenez le contrôle de votre processus de facturation. Bonne facturation !
        </p>
      </div>
      <div class="col-md-6">
        <h2>Inscription</h2>
        <form action="/register" method="POST">
          @csrf
          <div class="form-group" >
            <label for="signupUsername">nom d'utilisateur</label>
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
            <label for="signupPassword">mot de passe</label>
            <input type="password" name="password" class="form-control" id="signupPassword" placeholder="Enter password">
            @error('password')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <div class="form-group">
            <label for="signupConfirmPassword">Confirmation du mot de passe</label>
            <input type="password" name="pass2" class="form-control" id="signupConfirmPassword" placeholder="Confirm password">
            @error('pass2')
            <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Commencez !</button>
        </form>
      </div>
    </div>
  </div>
  <footer>
    <p></p>
    <footer class="footer">
      <div class="container">
        <p>&copy; {{date('Y')}} NoorFocus. Tous les droits sont reserves.</p>
      </div>
    </footer>
  
  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
