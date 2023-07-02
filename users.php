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
  <div id="insertErrorAlert" class="alert alert-danger" role="alert" style="display: none;">
    Error inserting value. Please try again.
  </div>

  <!-- confirmation message  -->
  <div id="insertConfirmationAlert" class="alert alert-success" role="alert" style="display: none;">
    Value inserted successfully!
  </div>

  <!-- Button to trigger the modal -->
  <button type="submit" data-bs-toggle="modal"  data-bs-target="#insertUserModal" class="btn btn-primary">Add User</button>

  
  <table class="table">
    <thead class="text-center">
      <tr>
        <th>User ID</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Postal Code</th>
        <th>Institution</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <tr>
        <td>1</td>
        <td>John Doe</td>
        <td>john.doe@example.com</td>
        <td>12345</td>
        <td>University A</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Jane Smith</td>
        <td>jane.smith@example.com</td>
        <td>67890</td>
        <td>University B</td>
      </tr>
      <tr>
        <td>3</td>
        <td>Bob Johnson</td>
        <td>bob.johnson@example.com</td>
        <td>54321</td>
        <td>University C</td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Update User Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body w-full">
        <!-- Update User Form -->
        <form  id="updateUserForm">
          <!-- Hidden input field for user ID -->
          <input type="hidden" id="updateUserId">
          <div class="mb-3">
            <label for="updateUserName" class="form-label">Name</label>
            <input type="text" class="form-control w-full" id="updateUserName" required>
          </div>
          <div class="mb-3">
            <label for="updateUserEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="updateUserEmail" required>
          </div>
          <div class="mb-3">
            <label for="updateUserInstitution" class="form-label">Institution</label>
            <input type="text" class="form-control" id="updateUserInstitution" required>
          </div>
          <div class="mb-3">
            <label for="updateUserPostCode" class="form-label">Post Code</label>
            <input type="number" class="form-control" id="updateUserPostCode" required>
          </div>
          <button type="submit" data-bs-target="#updateUserModal" data-bs-dismiss="modal" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Insert User Modal -->
<div class="modal fade" id="insertUserModal" tabindex="-1" aria-labelledby="insertUserModalLabel"  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insertUserModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Insert User Form -->
        <form id="insertUserForm">
          <div class="mb-3">
            <label for="insertUserName" class="form-label">Name</label>
            <input type="text" class="form-control" id="insertUserName" required>
          </div>
          <div class="mb-3">
            <label for="insertUserEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="insertUserEmail" required>
          </div>
          <div class="mb-3">
            <label for="insertUserInstitution" class="form-label">Institution</label>
            <input type="text" class="form-control" id="insertUserInstitution" required>
          </div>
          <div class="mb-3">
            <label for="insertUserPostCode" class="form-label">Post Code</label>
            <input type="number" class="form-control" id="insertUserPostCode" required>
          </div>
          <button  type="submit" data-bs-dismiss="modal" class="btn btn-primary">Add User</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>

//TODO:: show student information
const showUsers = () => {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'http://localhost/rahat/api/users', true);
  var users = [];
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
      users = JSON.parse(this.responseText);
      var tableRows = '';

      users.forEach(function (user) {
        var userId = user.user_id;
        var userName = user.user_name;
        var email = user.email;
        var institution = user.institution;
        var postCode = user.post_code;

        tableRows += `
          <tr class="text-black-100 text-xl">
            <td class="border border-slate " id="btnId">${userId}</td>
            <td class="border border-slate ">${userName}</td>
            <td class="border border-slate ">${email}</td>
            <td class="border border-slate ">${institution}</td>
            <td class="border border-slate ">${postCode}</td>
            <td>
            <button class='btn btn-primary btn-sm' onclick='deleteUser(${userId})' id="deleteBtn">Delete</button>
            </td>
            <td>
            <button  onclick='editUser(${userId})' class='btn btn-danger btn-sm'>edit</button>
            </td>
          </tr>
        `;
      });

      document.getElementById('tableBody').innerHTML = tableRows;
    }
  };

  xhr.send();
};
//TODO:: Call the showUsers function to fetch and display the user data
showUsers();

//  TODO:: Get the form element
const insertUserForm = document.getElementById('insertUserForm');

//TODO:: Add an event listener to the form submit event
insertUserForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the input values from the form
  const userName = document.getElementById('insertUserName').value;
  const userEmail = document.getElementById('insertUserEmail').value;
  const userInstitution = document.getElementById('insertUserInstitution').value;
  let userPostCode = document.getElementById('insertUserPostCode').value;

  if(!userName || !userInstitution || !userPostCode || !userEmail){
    alert('Please,fill all the fields');
    return;
  }

  userPostCode = parseInt(userPostCode);

  // Create an object with the user data
  const userData = {
    user_name: userName,
    email: userEmail,
    institution: userInstitution,
    post_code: userPostCode
  };

  // Perform an AJAX call to insert the user data
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://localhost/rahat/api/users', true);
  xhr.setRequestHeader('Content-type', 'application/json');
  xhr.onload = function() {
    if (xhr.status === 201) {

      const message = JSON.parse(this.responseText)
      // Success, do something
      console.log('User inserted successfully',message);

      // Reset the form
      insertUserForm.reset();
      // Get the modal element
      // const insertUserModalElement = document.getElementById('insertUserModal');
      // console.log(insertUserModalElement);
      // var modal = new bootstrap.Modal(document.getElementById('insertUserModalElement'));
      // Close the modal manually
      // insertUserModal.hide();
      // console.log(insertUserModal)
      // Show the confirmation alert
      const insertConfirmationAlert = document.getElementById('insertConfirmationAlert');
      insertConfirmationAlert.style.display = 'block';

      showUsers();

    } else {
      // Error, handle it
      console.log('Error inserting user');
      document.getElementById('insertErrorAlert').style.display = 'block';
    }
  };
  xhr.onerror = function() {
    console.log('Request error');
  };
  xhr.send(JSON.stringify(userData));
});



// Delete user
const deleteUser = (userId) => {
  const id = parseInt(userId);
  console.log(id);

  const flag = window.confirm('Are you sure you want to delete it?');
  console.log(flag);
  if(!flag){
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('DELETE', `http://localhost/rahat/api/users/${id}`, true);
  xhr.onload = function () {
    if (this.status == 200) {
      showUsers();
    }
  };
  xhr.send();
};


const editUser = (userId)=>{
  const id = parseInt(userId);

  // Get the user data for the specified userId
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `http://localhost/rahat/api/users/${id}`, true);

  xhr.onload = function () {
    if (this.status == 200) {
      var user = JSON.parse(this.responseText);
      var userName = user.user_name;
      var email = user.email;
      var institution = user.institution;
      var postCode = user.post_code;
      var userId = user.user_id;

      // Set the form values in the update user modal
      document.getElementById("updateUserId").value = userId; 
      document.getElementById('updateUserName').value = userName;
      document.getElementById('updateUserEmail').value = email;
      document.getElementById('updateUserInstitution').value = institution;
      document.getElementById('updateUserPostCode').value = postCode;

      // Open the update user modal
      var modal = new bootstrap.Modal(document.getElementById('updateUserModal'));
      modal.show();
    }
  };
  xhr.send();
}

// Get the form element
const updateUserForm = document.getElementById('updateUserForm');

// Add an event listener to the form submit event
updateUserForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the updated values from the input fields
  let userId = document.getElementById('updateUserId').value;
  const updatedUserName = document.getElementById('updateUserName').value;
  const updatedUserEmail = document.getElementById('updateUserEmail').value;
  const updatedUserInstitution = document.getElementById('updateUserInstitution').value;
  let updatedUserPostCode = document.getElementById('updateUserPostCode').value;

  userId  = parseInt(userId);
  updatedUserPostCode = parseInt(updatedUserPostCode);

  // Perform further operations with the updated data
  // Include the userId when sending an AJAX request to update the user data on the server

  // Create an object with the updated user data
  const updatedUserData = {
    user_name: updatedUserName,
    email: updatedUserEmail,
    institution: updatedUserInstitution,
    post_code: updatedUserPostCode
  };

   // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  
  // Set the request method and URL
  xhr.open('PUT', 'http://localhost/rahat/api/users/' + userId, true);

  // Set the request header
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  // Define the callback function for when the request is complete
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Request was successful, handle the response
      const response = JSON.parse(xhr.responseText);
      console.log(response);
      // Additional logic here
      showUsers();
    } else {
      // Request failed, handle the error
      console.error('Error:', xhr.status);
    }
  };

  // Convert the updated user data to JSON string
  const jsonData = JSON.stringify(updatedUserData);

  // Send the request with the JSON data
  xhr.send(jsonData);


  const updateUserModal = new bootstrap.Modal(document.getElementById('updateUserModal'));
  updateUserModal.hide();

  // Reset the form
  updateUserForm.reset();
  
});


</script>

<?php 
require_once("./footer.php")

?>


