<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Printable Invoice</title>
  <link rel="shortcut icon" href="img/logo.png" />
  <!-- Include the same CSS styles used in the main page -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom styles go here */
    /* Add any additional styles for printing the invoice */
    /* Optional: hide certain elements that you don't want to appear on the printed invoice */
    @media print {
      /* Example: hide the print button */
      .print-button {
        display: none;
      }
      .custom-container {
      display: none;
    }
      title{
        display: none;
      }
      
    }
    .navcolor {
      background-color: #A9C1E1;
    }
    .invoice-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #f8f9fa;
      padding: 20px;
      border: 1px solid #ccc;
      margin-top: 3%;
    }
    .invoice-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .invoice-id, .invoice-date {
      font-size: 1.2rem;
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

   
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-light navcolor">
    <div class="container">
      <a class="navbar-brand" href="/"><img height="55px" src="{{ asset('img/logo.png') }}" alt="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto pl-20">
          
          <li class="nav-item">
            <form action="/logout" method="POST">
            <button class="btn btn-dark" onclick="logout()">Se deconnecter</button>
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
  <!-- Include the invoice content that you want to print -->
  <!-- For example, you can include the .invoice-container div here -->
  <!-- Replace the content of this page with the actual invoice content you want to print -->
  <div class="invoice-container">
    <!-- Your invoice content goes here -->
    @if ($invoice)
    <h2><img id="img" src="{{ asset('img/logo.png') }}" height="30px" alt="logo" alt=""></h2>
    <div>
      <p><strong>Name:</strong> {{ $invoice->name }}</p>
      <p><strong>Date:</strong> {{ $invoice->date }}</p>
      <p><strong>Client Name:</strong> {{ $invoice->client_name }}</p>
      <p><strong>Address:</strong> {{ $invoice->adresse }}</p>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Product Name</th>
          <th>Unit Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($invoice->products as $product)
        <tr>
          <td>{{ $product->product_name }}</td>
          <td>{{ $product->unit_price }}</td>
          <td>{{ $product->quantity }}</td>
          <td>{{ $product->unit_price * $product->quantity }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3">Total</td>
          <td>{{ $total }} MAD</td>
        </tr>
      </tfoot>
    </table>
    @else
    <p>No invoice data found.</p>
    @endif
    <!-- Add any additional content or styling you want to include in the printed invoice -->
    <!-- For example, you can add a "Print" button to allow users to print the invoice -->
    <div class="print-button">
      <button class="btn btn-primary" onclick="window.print()">Imprimer</button>
    </div>
  </div>

  <!-- Include the Bootstrap JS and other scripts here (if needed) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
