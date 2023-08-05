<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <link rel="shortcut icon" href="img/logo.png" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&family=Nanum+Gothic:wght@400;700;800&family=Quicksand:wght@300;400;500;600&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    /* Custom styles go here */
    .body{
        font-family: 'montserrat';
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
    .customer-name {
      font-size: 1.1rem;
      margin-top: 10px;
      margin-bottom: 20px;
    }
    .product-table {
      width: 100%;
      margin-bottom: 20px;
    }
    .product-table th, .product-table td {
      text-align: center;
    }
    .invoice-total {
      font-weight: bold;
    }
    .btn-container {
      text-align: center;
      margin-bottom: 20px;
    }
    .btn {
      margin-right: 10px;
    }
    .navcolor {
      background-color: #A9C1E1;
    }
    ul li{
      margin-left: 20px;
    }

    .btn-container form, .btn-container button {
  display: inline-block;
  /* You can also use 'inline-flex' instead of 'inline-block' for more control over button alignment */
}

  #print-pdf-btn{
    margin-top:20px; 
  }
  .button-clicked {
    background-color: green; /* Change the color to your desired color */
    pointer-events: none; /* Disable further clicks */
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

  <div class="invoice-container">
    <div class="invoice-header">
      <h2>Les informations Personnelles</h2>
    </div>
    <form id="invoice-form" action="/saveInvoice" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Votre nom</label>
        <input value="{{ old('name') }}" name="name" type="text" class="form-control" id="invoice-name">
        @error('name')
        <p class="m-0 small alert-danger shadow-sm">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="date">Date:</label>
        <input value="{{ old('date', date('Y-m-d')) }}" name="date" type="date" class="form-control" id="invoice-date">
        @error('date')
        <p class="m-0 small alert-danger shadow-sm">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="client_name">Nom du Client:</label>
        <input name="client_name" type="text" class="form-control" id="customer-name">
        @error('client_name')
        <p class="m-0 small alert-danger shadow-sm">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="adresse">Son adresse:</label>
        <input name="adresse" type="text" class="form-control" id="customer-address">
        @error('adresse')
        <p class="m-0 small alert-danger shadow-sm">{{ $message }}</p>
        @enderror
    </div>
    
      <button class="btn btn-primary btn-container" type="submit" id="valider_continuer">Valider et Continuer</button>
    </form>
    <div class="btn-container">
      <button class="btn btn-success" id="add-product-btn">Ajouter un Nouveau Produit</button>
    </div>

      
      <form id="product-form" action="/saveProduct" method="POST"> 
          @csrf
        <table class="table table-bordered product-table">
          <thead>
            <tr>
              <th>Nom du Produit</th>
              <th>Prix unitaire</th>
              <th>Quantité</th>
              <th>Total</th>
              <th>Supprimer le produit</th>
            </tr>
          </thead>
          <tbody id="product-list">
            <tr class="product-row">
              <td><input type="text" class="form-control" name="product_name[]"></td>
              @error('product_name.*')
              <p class="m-0 small alert-danger shadow-sm">{{ $message }}</p>
              @enderror
              <td><input type="number" class="form-control" name="unit_price[]"></td>
              @error('unit_price.*')
              <p class="m-0 small alert-danger shadow-sm">{{ $message }}</p>
              @enderror
              <td><input type="number" class="form-control" name="quantity[]"></td>
              @error('quantity.*')
              <p class="m-0 small alert-danger shadow-sm">{{ $message }}</p>
              @enderror
              <td>0.00</td>
              <td><button type="button" class="btn btn-danger btn-remove-product">Supprimer</button></td>
          </tr>
          </tbody>
          <tfoot>
            <tr class="invoice-total">
              <td colspan="3">Total</td>
              <td>0.00</td>
            </tr>
          </tfoot>
        </table>
        <button class="btn btn-primary btn-container" type="submit" >Valider et Continuer</button>
      </form>
      

  </div>

  <!-- Bootstrap JS and other scripts (if needed) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
  $(document).ready(function() {
    // Reset localStorage when the page loads
    localStorage.removeItem('buttonClicked');

    // Check if the button has been clicked before using localStorage
    if (localStorage.getItem('buttonClicked')) {
      // Button has already been clicked, change its color and disable it
      $('#valider_continuer').addClass('button-clicked').attr('disabled', true);
    }

    // Handle the form submission
    $('#invoice-form').submit(function(e) {
      e.preventDefault();

      // Disable the button and add the 'button-clicked' class
      $('#valider_continuer').addClass('button-clicked').attr('disabled', true);

      // Set the localStorage item to remember that the button has been clicked
      localStorage.setItem('buttonClicked', 'true');

      // Continue with the AJAX request
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: '/saveInvoice', // Replace this with the correct route for saving the invoice data in your Laravel app
        data: formData,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting the content type
        success: function(response) {
          // Handle the response from the server after successful invoice submission
          console.log('Invoice saved successfully:', response);
          // You can redirect the user to a new page or display a success message here
          // For example, you can redirect to a confirmation page or display a success alert
          // window.location.href = '/invoice/confirmation';
          // $('#success-alert').fadeIn();
        },
        error: function(xhr, status, error) {
          // Handle any error during invoice submission
          console.error('Error during invoice submission:', error);
          // Display an error message to the user if needed
          // $('#error-alert').fadeIn();
        }
      });
    });


      
        // Function to get a cookie value
        function getCookie(name) {
          const value = `; ${document.cookie}`;
          const parts = value.split(`; ${name}=`);
          if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // Function to set a cookie
        function setCookie(name, value, days) {
          const d = new Date();
          d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
          const expires = `expires=${d.toUTCString()}`;
          document.cookie = `${name}=${value};${expires};path=/`;
        }
      });


    
        

      // Script for handling adding new product rows
      let productId = 1; // Counter for product rows

      $('#add-product-btn').click(function() {
        const newRow = $('.product-row').first().clone();

        // Set unique IDs for input fields
        newRow.find('input').each(function() {
          const name = $(this).attr('name');
          $(this).attr('name', name + productId);
          $(this).val('');
        });

        // Append the new row to the product list
        $('#product-list').append(newRow);

        productId++;
      });

      // Script for handling removing product rows
      $(document).on('click', '.btn-remove-product', function() {
        if ($('#product-list tr').length > 1) {
          $(this).closest('tr').remove();
          updateTotal();
        }
      });

      // Script for updating total amount based on input changes
      $(document).on('input', 'input[name^="unit_price"], input[name^="quantity"]', function() {
        updateTotal();
      });

      // Function to update the total amount
      function updateTotal() {
        let total = 0;
        $('tbody tr').each(function() {
          const unitPrice = parseFloat($(this).find('input[name^="unit_price"]').val()) || 0;
          const quantity = parseInt($(this).find('input[name^="quantity"]').val()) || 0;
          const subtotal = unitPrice * quantity;
          $(this).find('td:eq(3)').text(subtotal.toFixed(2) + 'MAD');
          total += subtotal;
        });
        $('.invoice-total td:last').text(total.toFixed(2) + 'MAD');
      }

      // Update total on page load
      updateTotal();
    
  </script>

</body>
</html>