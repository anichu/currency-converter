<?php 
include 'header.php';
?>
<div class="w-50  mt-5 mx-auto">
    <div class="card mx-auto">
        <!-- Confirmation Alert -->
        <div class="alert alert-success mt-3" id="registrationConfirmationAlert" style="display: none;">
          <p id="registrationConfirmationText">
          </p>
        </div>
        <!-- Error Alert -->
        <div class="alert alert-danger mt-3" id="loginErrorAlert" style="display: none;">
          Registration failed. Please try again.
        </div>
        <div class="card-header text-center">
            Login Here
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5">Login</h2>
                <form action="" id="loginForm"  method="POST">
                    <div class="form-group mt-2">
                        <label for="username">Email</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn mt-3 btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
  function setCookie(cname, cvalue, exdays=30) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  // Get the form element
const loginForm = document.getElementById('loginForm');

// Add an event listener to the form submit event
loginForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting
  
  // Get the form values
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  const loginUser = {
    email,
    password
  }

  // Create an XMLHttpRequest object
  const xhr = new XMLHttpRequest();
  // Configure the request
  xhr.open('POST', 'http://localhost/rahat/api/login', true);
  xhr.setRequestHeader('Content-Type', 'application/json');

  // Convert the user data to JSON
  const jsonData = JSON.stringify(loginUser);

  // Handle the response
  xhr.onload = function() {
    if (xhr.status === 200) {
      const data = JSON.parse(this.responseText);
      setCookie('crud-user', JSON.stringify(data));
      // Redirect to the desired page
      window.location.href = 'index.php';
    } else {
      // Show the error message
      const errorAlert = document.getElementById('loginErrorAlert');
      errorAlert.style.display = 'block';
      const errorMessage = JSON.parse(xhr.response);
      console.log('Login failed:', errorMessage?.message);
      errorAlert.innerText = errorMessage?.message;
    }
  };
  // Send the request with the JSON data
  xhr.send(jsonData);
});



</script>