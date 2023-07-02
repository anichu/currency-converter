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
  <button type="submit" data-bs-toggle="modal"  data-bs-target="#insertStudentModal" class="btn btn-primary">Add student</button>

  <div  class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>StudentID</th>
            <th>Major</th>
            <th>CGPA</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>ZIP</th>
            <th>GraduationYear</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
      <tbody id="tableBody">
  
      </tbody>
    </table>
  </div>
</div>

<!-- Update post Modal -->
<div class="modal fade" data-bs-backdrop="static"  id="updateStudentModal" tabindex="-1" aria-labelledby="updateStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateStudentModalLabel">Update Post</h5>
        <button type="button" data-bs-dismiss="modal" class="btn-close"></button>
      </div>
      <div class="modal-body w-full">
        <!-- Update post Form -->
        <form  id="updateStudentForm"  action="" method="POST">
          <!-- Hidden input field for post ID -->
          <input type="hidden" id="updateStudentId">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="text" name="age" class="form-control" id="age" required>
          </div>
          <div class="mb-3">
            <label for="studentId" class="form-label">StudentId</label>
            <input type="text" name="studentId" class="form-control" id="studentId" required>
          </div>
          <div class="mb-3">
            <label for="majorSub" class="form-label">Major</label>
            <input type="text" name="majorSub" class="form-control" id="majorSub" required>
          </div>
          <div class="mb-3">
            <label for="cgpa" class="form-label">Cgpa</label>
            <input type="number" name="cgpa" class="form-control" id="cgpa" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" required>
          </div>
          <div class="mb-3">
            <label for="street" class="form-label">Street</label>
            <input type="email" name="street" class="form-control" id="street" required>
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" class="form-control" id="city" required>
          </div>
          <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" name="state" class="form-control" id="state" required>
          </div>
          <div class="mb-3">
            <label for="zip" class="form-label">Zip</label>
            <input type="text" name="zip" class="form-control" id="zip" required>
          </div>
          <div class="mb-3">
            <label for="graduationYear" class="form-label">Graduation year</label>
            <input type="text" name="graduationYear" class="form-control" id="graduationYear" required>
          </div>
          <button type="submit" data-bs-dismiss="modal"  class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- update modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <!-- Hidden input field for post ID -->
          <input type="hidden" id="updateStudentId">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="text" name="age" class="form-control" id="age" required>
          </div>
          <div class="mb-3">
            <label for="studentId" class="form-label">StudentId</label>
            <input type="text" name="studentId" class="form-control" id="studentId" required>
          </div>
          <div class="mb-3">
            <label for="majorSub" class="form-label">Major</label>
            <input type="text" name="majorSub" class="form-control" id="majorSub" required>
          </div>
          <div class="mb-3">
            <label for="cgpa" class="form-label">Cgpa</label>
            <input type="number" name="cgpa" class="form-control" id="cgpa" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" required>
          </div>
          <div class="mb-3">
            <label for="street" class="form-label">Street</label>
            <input type="email" name="street" class="form-control" id="street" required>
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" class="form-control" id="city" required>
          </div>
          <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" name="state" class="form-control" id="state" required>
          </div>
          <div class="mb-3">
            <label for="zip" class="form-label">Zip</label>
            <input type="text" name="zip" class="form-control" id="zip" required>
          </div>
          <div class="mb-3">
            <label for="graduationYear" class="form-label">Graduation year</label>
            <input type="text" name="graduationYear" class="form-control" id="graduationYear" required>
          </div>
          <button type="submit"  class="btn btn-primary">Update</button>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="sendMessage()" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>


<!-- update modal -->


<!-- Insert post Modal -->
<div aria-labelledby="insertStudentModalLabel"  data-bs-backdrop="static" 
class="modal fade" id="insertStudentModal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insertStudentModalLabel">Add student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Insert post Form -->
        <form method="post"  id="insertStudentForm">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="age" class="form-control" id="age" required>
          </div>
          <div class="mb-3">
            <label for="studentId" class="form-label">StudentId</label>
            <input type="text" name="studentId" class="form-control" id="studentId" required>
          </div>
          <div class="mb-3">
            <label for="majorSub" class="form-label">Major</label>
            <input type="text" name="majorSub" class="form-control" id="majorSub" required>
          </div>
          <div class="mb-3">
            <label for="cgpa" class="form-label">Cgpa</label>
            <input type="number" name="cgpa" class="form-control" id="cgpa" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" required>
          </div>
          <div class="mb-3">
            <label for="street" class="form-label">Street</label>
            <input type="email" name="street" class="form-control" id="street" required>
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" name="city" class="form-control" id="city" required>
          </div>
          <div class="mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" name="state" class="form-control" id="state" required>
          </div>
          <div class="mb-3">
            <label for="zip" class="form-label">Zip</label>
            <input type="text" name="zip" class="form-control" id="zip" required>
          </div>
          <div class="mb-3">
            <label for="graduationYear" class="form-label">Graduation year</label>
            <input type="text" name="graduationYear" class="form-control" id="graduationYear" required>
          </div>
          <button  type="submit" data-bs-dismiss="modal" class="btn btn-primary">Add Student</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>

//TODO:: show student information
const showStudents = () => {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'http://localhost/rahat/api/students/students', true);
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
    var students = JSON.parse(this.responseText);
    var tableRows = '';

    students.forEach(function (student) {
      var id = student.id;
      var name = student.name;
      var age = student.age;
      var studentId = student.studentId;
      var major = student.major;
      var cgpa = student.cgpa;
      var email = student.email;
      var phone = student.phone;
      var street = student.street;
      var city = student.city;
      var state = student.state;
      var zip = student.zip;
      var graduationYear = student.graduationYear;

      tableRows += `
        <tr>
          <td class="px-2">${id}</td>
          <td class="px-2">${name}</td>
          <td class="px-2">${age}</td>
          <td class="px-2">${studentId}</td>
          <td class="px-2">${major}</td>
          <td class="px-2">${cgpa}</td>
          <td class="px-2">${email}</td>
          <td class="px-2">${phone}</td>
          <td class="px-2">${street}</td>
          <td class="px-2">${city}</td>
          <td class="px-2">${state}</td>
          <td class="px-2">${zip}</td>
          <td class="px-2">${graduationYear}</td>

          <td>
            <button class='btn btn-primary btn-sm' onclick='deletePost(${id})' id="deleteBtn">Delete</button>
          </td>
          <td>

          <button  onclick='editPost(${id})' class='btn btn-danger btn-sm'>edit</button>         
          </td>
        </tr>
      `;
    });

    document.getElementById('tableBody').innerHTML = tableRows;
  }
};

// <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Open modal for @getbootstrap</button>



  xhr.send();
};
//TODO:: Call the showStudents function to fetch and display the post data
showStudents();


const closeModal = ()=>{
  const updateStudentCloseModal = document.getElementById("updateStudentModal");
  updateStudentCloseModal.style.display = 'none';
  
  const updateStudentModal = new bootstrap.Modal(document.getElementById('updateStudentModal'));
  updateStudentModal.hide();

  console.log("closed")
}

// Get the form element
const insertStudent = document.getElementById('insertStudentForm');

// Add an event listener to the form submit event
insertStudent.addEventListener('submit', function(event) {
  event.preventDefault();
  console.log(event);
  // Get the input values from the form
  
  const name = event.target.name.value;
  const age = event.target.age.value;
  const studentId = event.target.studentId.value;
  const major = event.target.majorSub.value;
  const cgpa = event.target.cgpa.value;
  const email = event.target.email.value;
  const phone = event.target.phone.value;
  const street = event.target.street.value;
  const city = event.target.city.value;;
  const state = event.target.state.value;
  const zip =event.target.zip.value;
  const graduationYear = event.target.graduationYear.value;

  // Create an object with the student data
  const studentData = {
    name: name,
    age: age,
    studentId: studentId,
    major: major,
    cgpa: cgpa,
    email: email,
    phone: phone,
    street: street,
    city: city,
    state: state,
    zip: zip,
    graduationYear: graduationYear
  };

  // Perform an AJAX call to insert the student data
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://localhost/rahat/api/students/students/', true);
  xhr.setRequestHeader('Content-type', 'application/json');
  xhr.onload = function() {
    if (xhr.status === 201) {
      const message = JSON.parse(this.responseText);
      // Success, do something
      console.log('Student inserted successfully', message);

      // Reset the form
      insertStudentForm.reset();

      const insertConfirmationAlert = document.getElementById('insertConfirmationAlert');
      insertConfirmationAlert.style.display = 'block';

      showStudents();
    } else {
      // Error, handle it
      console.log('Error inserting student');
      document.getElementById('insertErrorAlert').style.display = 'block';
    }
  };
  xhr.onerror = function() {
    console.log('Request error');
  };
  xhr.send(JSON.stringify(studentData));
});




// Delete post
const deletePost = (studentId) => {
  const id = parseInt(studentId);
  console.log(id);

  const flag = window.confirm('Are you sure you want to delete it?');
  console.log(flag);
  if(!flag){
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('DELETE', `http://localhost/rahat/api/students/students/${id}`, true);
  xhr.onload = function () {
    if (this.status == 200) {
      showStudents();
    }
  };
  xhr.send();
};


const editPost = (studentId)=>{
  const id = parseInt(studentId);

  // Get the post data for the specified studentId
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `http://localhost/rahat/api/students/students/${id}`, true);

  xhr.onload = function () {
    if (this.status == 200) {
      var student = JSON.parse(this.responseText);
      var id = student.id;
      var name = student.name;
      var age = student.age;
      var studentId = student.studentId;
      var major = student.major;
      var cgpa = student.cgpa;
      var email = student.email;
      var phone = student.phone;
      var street = student.street;
      var city = student.city;
      var state = student.state;
      var zip = student.zip;
      var graduationYear = student.graduationYear;
    
      // Set the form values in the update post modal
      document.getElementById('updateStudentId').value = id;
      document.getElementById('name').value = name;
      document.getElementById('age').value = age;
      document.getElementById('studentId').value = studentId;
      document.getElementById('majorSub').value = major;
      document.getElementById('cgpa').value = cgpa;
      document.getElementById('email').value = email;
      document.getElementById('phone').value = phone;
      document.getElementById('street').value = street;
      document.getElementById('city').value = city;
      document.getElementById('state').value = state;
      document.getElementById('zip').value = zip;
      document.getElementById('graduationYear').value = graduationYear;
  
      // Open the update post modal
      var modal = new bootstrap.Modal(document.getElementById('updateStudentModal'),{
        backdrop:true,
        keyboard:true
      });
      modal.show();
    }
  };
  xhr.send();
}


var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {

  const updateButton = document.getElementById('update-button');
  let studentId = updateButton.getAttribute('data-student-id');
  studentId = parseInt(studentId);
  // Get the post data for the specified studentId
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `http://localhost/rahat/api/students/students/${studentId}`, true);
  xhr.onload = function () {
    if (this.status == 200) {
      var student = JSON.parse(this.responseText);

      console.log(student)
      var id = student.id;
      var name = student.name;
      var age = student.age;
      var studentId = student.studentId;
      var major = student.major;
      var cgpa = student.cgpa;
      var email = student.email;
      var phone = student.phone;
      var street = student.street;
      var city = student.city;
      var state = student.state;
      var zip = student.zip;
      var graduationYear = student.graduationYear;
    
      // Set the form values in the update post modal
      document.getElementById('updateStudentId').value = id;
      console.log(document.getElementById('name'));
      document.getElementById('name').value = name;
      document.getElementById('age').value = age;
      document.getElementById('studentId').value = studentId;
      document.getElementById('majorSub').value = major;
      document.getElementById('cgpa').value = cgpa;
      document.getElementById('email').value = email;
      document.getElementById('phone').value = phone;
      document.getElementById('street').value = street;
      document.getElementById('city').value = city;
      document.getElementById('state').value = state;
      document.getElementById('zip').value = zip;
      document.getElementById('graduationYear').value = graduationYear;

    }
  }
  xhr.send();

  console.log(updateButton,studentId);
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes

})

const sendMessage = ()=>{
  // Close the modal
  var modal = bootstrap.Modal.getInstance(exampleModal);
  modal.hide();
}


// Get the form element
const updateStudent = document.getElementById('updateStudentForm');

const submitHandler = (event)=>{
  console.log(event)
}
console.log(updateStudent);



// Add an event listener to the form submit event
updateStudent.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the updated values from the input fields
  let studentId = document.getElementById('updateStudentId').value;
  const name = event.target.name.value;
  const age = event.target.age.value;
  const major = event.target.majorSub.value;
  const cgpa = event.target.cgpa.value;
  const email = event.target.email.value;
  const phone = event.target.phone.value;
  const street = event.target.street.value;
  const city = event.target.city.value;;
  const state = event.target.state.value;
  const zip =event.target.zip.value;
  const graduationYear = event.target.graduationYear.value;
  // Perform further operations with the updated data
  // Create an object with the updated post data
  const updatedStudentData = {
    name: name,
    age: age,
    studentId: studentId,
    major: major,
    cgpa: cgpa,
    email: email,
    phone: phone,
    street: street,
    city: city,
    state: state,
    zip: zip,
    graduationYear: graduationYear
  };

  console.log(updatedStudentData);

   // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  
  // Set the request method and URL
  xhr.open('PUT', 'http://localhost/rahat/api/students/students/' + studentId, true);

  // Set the request header
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  // Define the callback function for when the request is complete
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Request was successful, handle the response
      const response = JSON.parse(xhr.responseText);

      
      var modal = bootstrap.Modal.getInstance(document.getElementById('updateStudentModal'));
      modal.hide();
      // Additional logic here
      showStudents();
    } else {
      // Request failed, handle the error
      console.error('Error:', xhr.status);
    }
  };

  // Convert the updated post data to JSON string
  const jsonData = JSON.stringify(updatedStudentData);

  // Send the request with the JSON data
  xhr.send(jsonData);

 

  // Reset the form
  updateStudentForm.reset();
  
});


</script>

<?php 
require_once("./footer.php")

?>


