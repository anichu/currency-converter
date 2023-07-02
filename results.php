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
  <button type="submit" data-bs-toggle="modal"  data-bs-target="#insertUserModal" class="btn btn-primary">Add Results</button>

  
  <table class="table">
    <thead class="text-center">
      <tr>
        <th>ID</th>
        <th>STUDENTID</th>
        <th>SUBJECT</th>
        <th>MARKS</th>
        <th>GRADE</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      
    </tbody>
  </table>
</div>

<!-- Update Books Modal -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateUserModalLabel">Update book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body w-full">
        <!-- Update User Form -->
        <form  id="updateResultForm">
        <input type="hidden" id="updateResultId">
          <div class="mb-3">
            <label for="updateStudentId" class="form-label">Student ID</label>
            <input type="text" class="form-control w-full" id="updateStudentId" required>
          </div>
          <div class="mb-3">
            <label for="updateSubject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="updateSubject" required>
          </div>
          <div class="mb-3">
            <label for="updateMarks" class="form-label">Marks</label>
            <input type="text" class="form-control" id="updateMarks" required>
          </div>
          <div class="mb-3">
            <label for="updateGrade" class="form-label">Grade</label>
            <input type="text" class="form-control" id="updateGrade" required>
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
        <h5 class="modal-title" id="insertUserModalLabel">Add Results</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Insert User Form -->
        <form id="insertResultsForm">
          <!-- Hidden input field for user ID -->
          <div class="mb-3">
            <label for="insertStudentID" class="form-label">Student ID</label>
            <input type="number" class="form-control w-full" id="insertStudentID" required>
          </div>
          <div class="mb-3">
            <label for="insertSubject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="insertSubject" required>
          </div>
          <div class="mb-3">
            <label for="insertMarks" class="form-label">Marks</label>
            <input type="number" class="form-control" id="insertMarks" required>
          </div>
          <div class="mb-3">
            <label for="insertGrade" class="form-label">Grade</label>
            <input type="string" class="form-control" id="insertGrade" required>
          </div>
          <button  type="submit" data-bs-dismiss="modal" class="btn btn-primary">Add Results</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>

//TODO:: show student information
const showResults = () => {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'http://localhost/rahat/api/results/results/', true);
  var results = [];
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
      results = JSON.parse(this.responseText);
      var tableRows = '';

      results.forEach(function (result) {
        tableRows += `
        <tr class="text-black-100 text-xl">
          <td class="border border-slate">${result.id}</td>
          <td class="border border-slate">${result.student_id}</td>
          <td class="border border-slate">${result.subject}</td>
          <td class="border border-slate">${result.marks}</td>
          <td class="border border-slate">${result.grade}</td>
          <td>
            <button class='btn btn-primary btn-sm' onclick='deleteResults(${result.id})' id="deleteBtn">Delete</button>
          </td>
          <td>
            <button onclick='editResult(${result.id})' class='btn btn-danger btn-sm'>Edit</button>
          </td>
        </tr>

        `;
      });

      document.getElementById('tableBody').innerHTML = tableRows;
    }
  };

  xhr.send();
};
//TODO:: Call the showResults function to fetch and display the user data
showResults();

//  TODO:: Get the form element
const insertResultsForm = document.getElementById('insertResultsForm');

// TODO:: Add an event listener to the form submit event
insertResultsForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the input values from the form
  const studentId = document.getElementById('insertStudentID').value;
  const subject = document.getElementById('insertSubject').value;
  const marks = document.getElementById('insertMarks').value;
  const grade = document.getElementById('insertGrade').value;

  // Validate the input fields
  if (!studentId || !subject || !marks || !grade) {
    alert('Please fill all the fields');
    return;
  }

  // Convert the input values to the appropriate types
  const studentIdInt = parseInt(studentId);
  const marksFloat = parseFloat(marks);

  // Create an object with the result data
  const resultData = {
    student_id: studentIdInt,
    subject: subject,
    marks: marksFloat,
    grade: grade
  };

  // Perform an AJAX call to insert the result data
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://localhost/rahat/api/results/results/', true);
  xhr.setRequestHeader('Content-type', 'application/json');
  xhr.onload = function() {
    if (xhr.status === 201) {
      // Success, do something
      console.log('Result inserted successfully');

      // Reset the form
      insertResultsForm.reset();

      // Show the confirmation alert
      const insertConfirmationAlert = document.getElementById('insertConfirmationAlert');
      insertConfirmationAlert.style.display = 'block';

      // Refresh the result list
      showResults();
    } else {
      // Error, handle it
      console.log('Error inserting result');
      document.getElementById('insertErrorAlert').style.display = 'block';
    }
  };
  xhr.onerror = function() {
    console.log('Request error');
  };
  xhr.send(JSON.stringify(resultData));
});





// Delete user
const deleteResults = (resultId) => {
  const id = parseInt(resultId);
  console.log(id);

  const flag = window.confirm('Are you sure you want to delete it?');
  console.log(flag);
  if(!flag){
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('DELETE', `http://localhost/rahat/api/results/results/${id}`, true);
  xhr.onload = function () {
    if (this.status == 200) {
      showResults();
    }
  };
  xhr.send();
};


const editResult = (resultId) => {
  const id = parseInt(resultId);

  // Get the result data for the specified resultId
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `http://localhost/rahat/api/results/results/${id}`, true);

  xhr.onload = function() {
    if (this.status == 200) {
      var result = JSON.parse(this.responseText);
      var studentId = result.student_id;
      var subject = result.subject;
      var marks = result.marks;
      var grade = result.grade;
      var resultId = result.id;

      // Set the form values in the update result modal
      document.getElementById("updateResultId").value = resultId;
      document.getElementById('updateStudentId').value = studentId;
      document.getElementById('updateSubject').value = subject;
      document.getElementById('updateMarks').value = marks;
      document.getElementById('updateGrade').value = grade;

      // Open the update result modal
      var modal = new bootstrap.Modal(document.getElementById('updateUserModal'));
      modal.show();
    }
  };
  xhr.send();
};


// Get the form element
const updateResultForm = document.getElementById('updateResultForm');

// Add an event listener to the form submit event
// Add an event listener to the form submit event
updateResultForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the updated values from the input fields
  let resultId = document.getElementById('updateResultId').value;
  const updatedStudentId = document.getElementById('updateStudentId').value;
  const updatedSubject = document.getElementById('updateSubject').value;
  const updatedMarks = document.getElementById('updateMarks').value;
  const updatedGrade = document.getElementById('updateGrade').value;

  resultId = parseInt(resultId);

  // Perform further operations with the updated data
  // Include the resultId when sending an AJAX request to update the result data on the server

  // Create an object with the updated result data
  const updatedResultData = {
    student_id: updatedStudentId,
    subject: updatedSubject,
    marks: updatedMarks,
    grade: updatedGrade
  };

   // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  
  // Set the request method and URL
  xhr.open('PUT', 'http://localhost/rahat/api/results/results/' + resultId, true);

  // Set the request header
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  // Define the callback function for when the request is complete
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Request was successful, handle the response
      const response = JSON.parse(xhr.responseText);
      console.log(response);
      // Additional logic here
      showResults();
    } else {
      // Request failed, handle the error
      console.error('Error:', xhr.status);
    }
  };

  // Convert the updated result data to JSON string
  const jsonData = JSON.stringify(updatedResultData);

  // Send the request with the JSON data
  xhr.send(jsonData);


  const updateResultModal = new bootstrap.Modal(document.getElementById('updateUserModal'));
  updateResultModal.hide();

  // Reset the form
  updateResultForm.reset();
  
});



</script>

<?php 
require_once("./footer.php")

?>


