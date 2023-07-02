<?php include "header.php"; ?>
<div>
  <!-- Confirmation Alert -->
  <div class="alert alert-success mt-3" id="registrationConfirmationAlert" style="display: none;">
    <p id="registrationConfirmationText">
    </p>
  </div>
  <!-- Error Alert -->
  <div class="alert alert-danger mt-3" id="registrationErrorAlert" style="display: none;">
    Registration failed. Please try again.
  </div>
  <h3 class="text-center mt-5 ">Register Here</h3>
  <form id="registrationForm" class="py-5" method="POST" action="">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="fullName">Full Name:</label>
        <input type="text" class="form-control" id="fullName">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="phone">Phone Number:</label>
        <input type="tel" class="form-control" id="phone">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="institution">Institution:</label>
        <input type="text" class="form-control" id="institution">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="postCode">Post Code:</label>
        <input type="text" class="form-control" id="postCode">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password">
      </div>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col">
      <button type="submit" class="btn btn-primary btn-block">Register</button>
    </div>
  </div>
  </form>

</div>

<script>

  function setCookie(cname, cvalue, exdays=30) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  // Get the form element
  const registrationForm = document.getElementById('registrationForm');

  // Add an event listener to the form submit event
  registrationForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting
    // Get the form values
    const username = document.getElementById('username').value;
    const fullName = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const phoneNumber = document.getElementById('phone').value;
    const institution = document.getElementById('institution').value;
    const address = document.getElementById('address').value;
    const postCode = document.getElementById('postCode').value;
    const password = document.getElementById('password').value;

    const createdUser = {
      username,
      fullName,
      email,
      phoneNumber,
      institution,
      address,
      postCode,
      password
    }

    // Create an XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    // Configure the request
    xhr.open('POST', 'http://localhost/rahat/api/register', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Convert the user data to JSON
    const jsonData = JSON.stringify(createdUser);

    // Handle the response
    xhr.onload = function() {
      if (xhr.status === 201) {
        const data = JSON.parse(this.responseText)
        // Show the confirmation alert
        const confirmationAlert = document.getElementById('registrationConfirmationAlert');
        confirmationAlert.style.display = 'block';
        
        // hide the error message
        const errorAlert = document.getElementById('registrationErrorAlert');
        errorAlert.style.display = 'none';

        // added confirmation text 
        registrationConfirmationText = document.getElementById('registrationConfirmationText');
        registrationConfirmationText.innerText = data?.message;
        setCookie('crud-user', JSON.stringify(data));
        window.location.href="index.php";
        
        // Reset the form
        registrationForm.reset();
      } else {
        // Show the confirmation alert
        const confirmationAlert = document.getElementById('registrationConfirmationAlert');
        confirmationAlert.style.display = 'none';
        // hide the error message
        const errorAlert = document.getElementById('registrationErrorAlert');
        errorAlert.style.display = 'block';
        const errorMessage = JSON.parse(xhr.response);
        console.log('Failed to create user:', errorMessage?.message);
        errorAlert.innerText = errorMessage?.message;
      }
    };
    // Send the request with the JSON data
    xhr.send(jsonData);
  });
</script>

<?php  
require_once("footer.php")
?>