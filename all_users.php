<?php  
  include_once "./header.php";
?>

<style>
  /* Custom table style */
  .table {
    font-size: 14px;
    color: #333;
  }
  .table thead th {
    background-color: #f8f9fa;
    color: #333;
    border-bottom: 2px solid #ddd;
    font-weight: bold;
  }

  .table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  .table tbody tr:hover {
    background-color: #f2f2f2;
  }
</style>

<div class="my-4">
  
  <!-- Error Alert -->
  <div id="errorMessage" class="alert alert-danger d-none" role="alert">
    Error inserting value. Please try again.
  </div>

  <!-- confirmation message  -->
  <div id="successMessage" class="alert alert-success d-none" role="alert">
    Value inserted successfully!
  </div>

  <!-- Button to trigger the modal -->
  <div class="my-2">
    <button type="submit" data-bs-toggle="modal"  data-bs-target="#insertUserModal" class="btn btn-primary">Add user</button>
  </div>

  <div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr class="text-center">
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>User Role</th>
        <th>Institution</th>
        <th>Post Code</th>
        <th>Full Name</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      
    </tbody>
  </table>
</div>


<!-- Update user Modal -->
<div class="modal fade" data-bs-backdrop="static" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
        <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
      </div>
      <div class="modal-body w-full">
        <!-- Update user Form -->
        <form id="updateUserForm" action="" method="POST">
          <!-- Hidden input field for user ID -->
          <input type="hidden" id="updateUserId">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="userRole" class="form-label">User Role</label>
            <input type="text" name="userRole" class="form-control" id="userRole" required>
          </div>
          <div class="mb-3">
            <label for="institution" class="form-label">Institution</label>
            <input type="text" name="institution" class="form-control" id="institution" required>
          </div>
          <div class="mb-3">
            <label for="postCode" class="form-label">Post Code</label>
            <input type="text" name="postCode" class="form-control" id="postCode" required>
          </div>
          <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" name="fullName" class="form-control" id="fullName" required>
          </div>
          <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address" required>
          </div>
          <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Insert post Modal -->
<div class="modal fade" data-bs-backdrop="static" id="insertUserModal" tabindex="-1" aria-labelledby="insertUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insertUserModalLabel">Insert User</h5>
        <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
      </div>
      <div class="modal-body w-full">
        <!-- Update user Form -->
        <form id="insertUserForm" action="" method="POST">
          <!-- Hidden input field for user ID -->
          <input type="hidden" id="updateUserId">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="userRole" class="form-label">User Role</label>
            <input type="text" name="userRole" class="form-control" id="userRole" required>
          </div>
          <div class="mb-3">
            <label for="institution" class="form-label">Institution</label>
            <input type="text" name="institution" class="form-control" id="institution" required>
          </div>
          <div class="mb-3">
            <label for="postCode" class="form-label">Post Code</label>
            <input type="text" name="postCode" class="form-control" id="postCode" required>
          </div>
          <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" name="fullName" class="form-control" id="fullName" required>
          </div>
          <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <input type="text" name="phoneNumber" class="form-control" id="phoneNumber" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
          </div>
          <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Insert</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>

//TODO:: show student information
const showAllUsers = () => {

  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'http://localhost/rahat/api/users/users/', true);
  var posts = [];
  document.getElementById('tableBody').innerHTML = `
  <tr>
    <td colspan="7" class="text-center">
      <div class="spinner-border" role="status">
        <span class="visually-hidden"></span>
      </div>
    </td>
  </tr>
  `;

  xhr.onload = function () {
    if (this.status == 200) {
      var users = JSON.parse(this.responseText);
      var tableRows = '';

      users.forEach(function (user) {
        tableRows += `
          <tr>
          <td class="px-2">${user.id}</td>
          <td class="px-2">${user.username}</td>
          <td class="px-2">${user.email}</td>
          <td class="px-2">${user.user_role}</td>
          <td class="px-2">${user.institution}</td>
          <td class="px-2">${user.postCode}</td>
          <td class="px-2">${user.fullName}</td>
          <td class="px-2">${user.phoneNumber}</td>
          <td class="px-2">${user.address}</td>

            <td>
              <button class='btn btn-primary btn-sm' onclick='deleteUser(${user.id})'>Delete</button>
            </td>
            <td>

            <button  onclick='editUser(${user.id})' class='btn btn-danger btn-sm'>edit</button>         
            </td>
          </tr>
        `;
      });

      document.getElementById('tableBody').innerHTML = tableRows;
    }
  };



  xhr.send();
};
//TODO:: Call the showAllUsers function to fetch and display the post data
showAllUsers();



// Get the form element
const insertUserForm = document.getElementById('insertUserForm');

// Add an event listener to the form submit event
insertUserForm.addEventListener('submit', function(event) {
  event.preventDefault();

  // Get the input values from the form
  const username = event.target.username.value;
  const email = event.target.email.value;
  const userRole = event.target.userRole.value;
  const institution = event.target.institution.value;
  const postCode = event.target.postCode.value;
  const fullName = event.target.fullName.value;
  const phoneNumber = event.target.phoneNumber.value;
  const address = event.target.address.value;
  const password = event.target.password.value;

  // Create an object with the user data
  const userData = {
    username: username,
    email: email,
    user_role: userRole,
    institution: institution,
    postCode: postCode,
    fullName: fullName,
    phoneNumber: phoneNumber,
    address: address,
    password: password
  };

  // Perform an AJAX call to insert the user data
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://localhost/rahat/api/register/', true);
  xhr.setRequestHeader('Content-type', 'application/json');
  xhr.onload = function() {
    if (xhr.status === 201) {
      const message = JSON.parse(this.responseText);
      // Success, do something
      console.log('User inserted successfully', message);

      // Reset the form
      insertUserForm.reset();

      document.getElementById("successMessage").classList.remove("d-none");
      document.getElementById("errorMessage").classList.add("d-none");

      showAllUsers();
    } else {
      console.error("Error:", xhr.response);
      const errorResponse = JSON.parse(xhr.response);
      console.log(errorResponse);
      document.getElementById("errorMessage").classList.remove("d-none");
      document.getElementById("successMessage").classList.add("d-none");
      document.getElementById("errorMessage").innerText = errorResponse?.message;
}
  };
  xhr.onerror = function() {
    console.log('Request error');
  };
  xhr.send(JSON.stringify(userData));
});



const editUser = (userId) => {
  const id = parseInt(userId);

  // Get the user data for the specified userId
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `http://localhost/rahat/api/users/users/id/${id}`, true);

  xhr.onload = function () {
    if (this.status == 200) {
      var user = JSON.parse(this.responseText);
      var id = user.id;
      var username = user.username;
      var email = user.email;
      var userRole = user.user_role;
      var institution = user.institution;
      var postCode = user.postCode;
      var fullName = user.fullName;
      var phoneNumber = user.phoneNumber;
      var address = user.address;
  

      // Set the form values in the update user modal
      document.getElementById('updateUserId').value = id;
      document.getElementById('username').value = username;
      document.getElementById('email').value = email;
      document.getElementById('userRole').value = userRole;
      document.getElementById('institution').value = institution;
      document.getElementById('postCode').value = postCode;
      document.getElementById('fullName').value = fullName;
      document.getElementById('phoneNumber').value = phoneNumber;
      document.getElementById('address').value = address;

      // Open the update user modal
      var modal = new bootstrap.Modal(document.getElementById('updateUserModal'), {
        backdrop: true,
        keyboard: true
      });
      modal.show();
    }
  };
  xhr.send();
};

// Get the form element
const updateUserForm = document.getElementById('updateUserForm');

// Add an event listener to the form submit event
updateUserForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the updated values from the input fields
  let userId = parseInt(document.getElementById('updateUserId').value);
  const username = event.target.username.value;
  const email = event.target.email.value;
  const userRole = event.target.userRole.value;
  const institution = event.target.institution.value;
  const postCode = event.target.postCode.value;
  const fullName = event.target.fullName.value;
  const phoneNumber = event.target.phoneNumber.value;
  const address = event.target.address.value;

  // Create an object with the updated user data
  const updatedUserData = {
    username: username,
    email: email,
    user_role: userRole,
    institution: institution,
    postCode: postCode,
    fullName: fullName,
    phoneNumber: phoneNumber,
    address: address,
  };

  console.log(updatedUserData);

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Set the request method and URL
  xhr.open('PUT', 'http://localhost/rahat/api/users/users/' + userId, true);

  console.log(userId);

  // Set the request header
  xhr.setRequestHeader('Content-Type', 'application/json');

  // Define the callback function for when the request is complete
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Request was successful, handle the response
      const response = JSON.parse(xhr.responseText);

      var modal = bootstrap.Modal.getInstance(document.getElementById('updateUserModal'));
      modal.hide();
      console.log(response);
      document.getElementById("successMessage").classList.remove("d-none");
      document.getElementById("errorMessage").classList.add("d-none");
      document.getElementById("successMessage").innerText = response?.message;
      // Reset the form
      updateUserForm.reset();
      // Additional logic here
      showAllUsers();
    } else {
      // Request failed, handle the error
      console.error('Error:', xhr.status);
    }
  };

  // Convert the updated user data to JSON string
  const jsonData = JSON.stringify(updatedUserData);

  // Send the request with the JSON data
  xhr.send(jsonData);

});



// Delete User
const deleteUser = (studentId) => {
  const id = parseInt(studentId);
  console.log(id);

  const flag = window.confirm('Are you sure you want to delete it?');
  console.log(flag);
  if(!flag){
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('DELETE', `http://localhost/rahat/api/users/users/${id}`, true);
  xhr.onload = function () {
    if (this.status == 200) {
      const response = JSON.parse(xhr.responseText);
      console.log(response);
      document.getElementById("successMessage").classList.remove("d-none");
      document.getElementById("errorMessage").classList.add("d-none");
      document.getElementById("successMessage").innerText = response?.message;
      showAllUsers();
    }
  };
  xhr.send();
};



</script>

<?php 
require_once("./footer.php")
?>


