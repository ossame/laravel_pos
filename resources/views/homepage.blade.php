<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>invoice</title>
  <link rel="shortcut icon" href="img/logo.png" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&family=Nanum+Gothic:wght@400;700;800&family=Quicksand:wght@300;400;500;600&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <style>
   
    body{
      font-family:'montserrat' ;
    }
    .navcolor {
      background-color: #A9C1E1;
    }
    ul li{
      margin-left: 20px;
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
      color: #ff0000; /* Red text color */
    }

    .footer {
      background-color: #f8f9fa; /* Light gray background color */
      padding: 20px;
      text-align: center;
      position: absolute;
      bottom: 0;
      width: 100%;
      
    }
    section{
      margin-bottom: 2%;
    }
 
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light navcolor">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img height="55px" src="{{ asset('img/logo.png') }}" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto pl-20">
                <li class="nav-item">
                  <form action="/search" method="GET">
                    @csrf
                    <div class="input-group">
                        <input type="search" name="search" id="searchInput" placeholder="Rechercher" class="form-control search-input">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary search-button" type="submit">
                                <img height="20px" src="{{ asset('img/search.png') }}" alt="">
                            </button>
                        </div>
                    </div>
                </form>
                            
                </li>
                <li class="nav-item">
                    <a class="btn btn-dark" href="/invoice" onclick="calculateNewBill()">Calculer nouvelle facture</a>
                </li>
                @csrf
                <li class="nav-item">
                    <form action="/logout" method="POST">
                        <button class="btn btn-dark" onclick="logout()">Se déconnecter</button>
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

  @if(session()->has('success'))
  <div class="container">
    <div class="custom-container">
      <div class="text-center custom-text">
        {{session('success')}}
      </div>
    </div>
  </div>
  @endif
 


  <!-- Section: Latest Bills -->
  <section class="container mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>N` Facture</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Nom du Client</th>
                <th style="width: 40%;">Adresse</th> <!-- Increase the width of the Adresse column -->
                <th style="width: 15%;">Action</th> <!-- Reduce the width of the Actions column -->
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->name }}</td>
                    <td>{{ $invoice->date }}</td>
                    <td>{{ $invoice->client_name }}</td>
                    <td>{{ $invoice->adresse }}</td>
                    <td>
                        <a href="/viewInvoice/{{ $invoice->id }}" class="btn btn-primary">Voir la facture</a>
                        <a href="/delete/{{ $invoice->id }}" class="btn btn-danger">
                            Supprimer <img height="20px" src="{{ asset('img/trash.png') }}" alt="">
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<style>
  
  
  </section>

  


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  

 
</body>

</html>
