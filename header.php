<html>

  <head>
  <!-- bootstrap cdn -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- bootstrap cdn -->

  <!-- ajax library -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
        $('#convertBtn').click(function() {

        // Get the selected values and input text
        var fromCurrency = $('#fromCurrency').val();
        var toCurrency = $('#toCurrency').val();
        var amount = $('#amount').val();
        const currentDate = new Date();
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0');
        const day = String(currentDate.getDate()).padStart(2, '0');
        let formattedDate = `${year}-${month}-${day}`;
        formattedDate = new Date(formattedDate);
        console.log(fromCurrency,toCurrency,amount,formattedDate)
        const apiKey = "7f299f7f341a48e5955d6f2912d7e2d8";

        $.ajax({
          url: `https://api.exchangerate.host/convert?from=${fromCurrency}&to=${toCurrency}&amount=${amount}&date=${formattedDate}`,
          method: 'GET',
          success: function(response) {
            // var conversionRate = response.rates[toCurrency];
            // var convertedAmount = amount * conversionRate;
            var result = amount + ' ' + fromCurrency + ' = ' + response?.result.toFixed(2) + ' ' + toCurrency;
            $('#result').text(result);
            $('#result').addClass('mt-2 bg-primary text-light rounded px-3 py-2');
            console.log(response)
          },
          error: function(xhr, status, error) {
            $('.result').text('');
            $('#errorMessage').removeClass('d-none');
            $('#successMessage').addClass('d-none');
            console.error(error);
          }
        });

        function getCookie(cname) {
          let name = cname + "=";
          let decodedCookie = decodeURIComponent(document.cookie);
          let ca = decodedCookie.split(';');
          for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
              c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
            }
          }
          return "";
        }
        const userData = JSON.parse(getCookie('crud-user'));
        let user = null;

        $.ajax({
          url: "http://localhost/rahat/api/verify-jwt",
          type:"POST",
          data:{
            token:userData?.token,
          },
          success:function(response){
            user = response;
            console.log(user);
            var data = {
              fromCurrency: fromCurrency,
              toCurrency: toCurrency,
              email: user?.email
            };
            $.ajax({
            url: "http://localhost/rahat/api/conversion/conversion/",
            type: "POST",
            data:data,
            success:function(response){
              console.log(response);
            }
          })
          }
        })

      });
    });
  </script>

  <style>
      body, html {
          height: 100%;
      }

      .vertical-center {
          min-height: 100%;
          display: flex;
          align-items: center;
      }
              .navbar {
          background-color: #0A4D68;
          border-radius: 8px;
      }

      .navbar-dark .navbar-brand,
      .navbar-dark .navbar-nav .nav-link {
          color: white;
      }

      .navbar-avatar {
          width: 40px;
          height: 40px;
          border-radius: 50%;
          background-color: #ccc;
          margin-left: 10px;
      }
  </style>

</head>

<body>
  
  <!-- From Currency Dropdown -->
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>  
            <?php
              // Retrieve the user tracking data from the cookie
              $userData = isset($_COOKIE['crud-user']) ? json_decode($_COOKIE['crud-user'], true) : [];
              $token = "";
              if(count($userData) > 0){
                $token = $userData['token'] ? $userData['token'] : '';
              }
              if(!$token){
                // User is not logged in
                echo '
                  <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                  </li>
                ';
              } else {
                // User is logged in
                echo '
                  <li class="nav-item">
                    <a class="nav-link" href="template.php">Template</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="alerts.php">Alerts</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="conversion.php">Conversion</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="favorite_currency.php">Favorite Currency</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                  </li>
                  
                  <li class="nav-item dropdown d-none">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Crud
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="users.php">Users</a></li>
                      <li><a class="dropdown-item" href="posts.php">Posts</a></li>
                      <li><a class="dropdown-item" href="students.php">Students</a></li>
                      <li><a class="dropdown-item" href="books.php">Books</a></li>
                      <li><a class="dropdown-item" href="results.php">Results</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                  </li>
                ';
              }
            ?>
          </ul>
        </div>
      </div>
    </nav>
