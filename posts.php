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
  <button type="submit" data-bs-toggle="modal"  data-bs-target="#insertpostModal" class="btn btn-primary">Add post</button>

  
  <table class="table">
    <thead class="text-center">
      <tr>
        <th>ID</th>
        <th>title</th>
        <th>Content</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody id="tableBody">

    </tbody>
  </table>
</div>

<!-- Update post Modal -->
<div class="modal fade" id="updatepostModal" tabindex="-1" aria-labelledby="updatepostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatepostModalLabel">Update Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body w-full">
        <!-- Update post Form -->
        <form  id="updatepostForm">
          <!-- Hidden input field for post ID -->
          <input type="hidden" id="updatepostId">
          <div class="mb-3">
            <label for="updatepostTitle" class="form-label">Title</label>
            <input type="text" class="form-control" id="updatepostTitle" required>
          </div>
          <div class="mb-3">
            <label for="updatepostContent" class="form-label">Content</label>
            <input type="text" class="form-control" id="updatepostContent" required>
          </div>
          <button type="submit" data-bs-target="#updatepostModal" data-bs-dismiss="modal" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Insert post Modal -->
<div class="modal fade" id="insertpostModal" tabindex="-1" aria-labelledby="insertpostModalLabel"  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="insertpostModalLabel">Add post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Insert post Form -->
        <form method="post" action="" id="insertpostForm">
          <div class="mb-3">
            <label for="insertUserName" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="insertUserName" required>
          </div>
          <div class="mb-3">
            <label for="insertUser" class="form-label">Content</label>
            <input type="text" name="content" class="form-control" id="insertUser" required>
          </div>
          <button  type="submit" data-bs-dismiss="modal" class="btn btn-primary">Add Post</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>

//TODO:: show student information
const showPosts = () => {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'http://localhost/rahat/api/posts/posts', true);
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
      posts = JSON.parse(this.responseText);
      var tableRows = '';

      posts.forEach(function (post) {
        var postId = post.id;
        var postName = post.title;
        var email = post.content;

        tableRows += `
          <tr class="text-black-100 text-xl">
            <td class="border border-slate " id="btnId">${postId}</td>
            <td class="border border-slate ">${postName}</td>
            <td class="border border-slate ">${email}</td>
            <td>
            <button class='btn btn-primary btn-sm' onclick='deletePost(${postId})' id="deleteBtn">Delete</button>
            </td>
            <td>
            <button  onclick='editPost(${postId})' class='btn btn-danger btn-sm'>edit</button>
            </td>
          </tr>
        `;
      });

      document.getElementById('tableBody').innerHTML = tableRows;
    }
  };

  xhr.send();
};
//TODO:: Call the showPosts function to fetch and display the post data
showPosts();

//  TODO:: Get the form element
const insertpostForm = document.getElementById('insertpostForm');

//TODO:: Add an event listener to the form submit event
insertpostForm.addEventListener('submit', function(event) {
  event.preventDefault();

  // Create an object with the post data
  const postData = {
    title:event.target.title.value,
    content:event.target.content.value,
  };

  // Perform an AJAX call to insert the post data
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://localhost/rahat/api/posts/posts/', true);
  xhr.setRequestHeader('Content-type', 'application/json');
  xhr.onload = function() {
    if (xhr.status === 201) {

      const message = JSON.parse(this.responseText)
      // Success, do something
      console.log('post inserted successfully',message);

      // Reset the form
      insertpostForm.reset();

      const insertConfirmationAlert = document.getElementById('insertConfirmationAlert');
      insertConfirmationAlert.style.display = 'block';

      showPosts();

    } else {
      // Error, handle it
      console.log('Error inserting post');
      document.getElementById('insertErrorAlert').style.display = 'block';
    }
  };
  xhr.onerror = function() {
    console.log('Request error');
  };
  xhr.send(JSON.stringify(postData));
});



// Delete post
const deletePost = (postId) => {
  const id = parseInt(postId);
  console.log(id);

  const flag = window.confirm('Are you sure you want to delete it?');
  console.log(flag);
  if(!flag){
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('DELETE', `http://localhost/rahat/api/posts/posts/${id}`, true);
  xhr.onload = function () {
    if (this.status == 200) {
      showPosts();
    }
  };
  xhr.send();
};


const editPost = (postId)=>{
  const id = parseInt(postId);

  // Get the post data for the specified postId
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `http://localhost/rahat/api/posts/posts/${id}`, true);

  xhr.onload = function () {
    if (this.status == 200) {
      var student = JSON.parse(this.responseText);
      var title = student.title;
      var content = student.content;
    
      // Set the form values in the update post modal
      document.getElementById("updatepostId").value = postId; 
      document.getElementById('updatepostTitle').value = title;
      document.getElementById('updatepostContent').value = content;
  
      // Open the update post modal
      var modal = new bootstrap.Modal(document.getElementById('updatepostModal'));
      modal.show();
    }
  };
  xhr.send();
}

// Get the form element
const updatepostForm = document.getElementById('updatepostForm');

// Add an event listener to the form submit event
updatepostForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the updated values from the input fields
  let postId = document.getElementById('updatepostId').value;
  const updatedpostName = document.getElementById('updatepostTitle').value;
  const updatedpostEmail = document.getElementById('updatepostContent').value;


  // Perform further operations with the updated data
  // Include the postId when sending an AJAX request to update the post data on the server

  // Create an object with the updated post data
  const updatedpostData = {
    title: updatedpostName,
    content: updatedpostEmail,
    
  };

   // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  
  // Set the request method and URL
  xhr.open('PUT', 'http://localhost/rahat/api/posts/posts/' + postId, true);

  // Set the request header
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  // Define the callback function for when the request is complete
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Request was successful, handle the response
      const response = JSON.parse(xhr.responseText);
      console.log(response);
      // Additional logic here
      showPosts();
    } else {
      // Request failed, handle the error
      console.error('Error:', xhr.status);
    }
  };

  // Convert the updated post data to JSON string
  const jsonData = JSON.stringify(updatedpostData);

  // Send the request with the JSON data
  xhr.send(jsonData);


  const updatepostModal = new bootstrap.Modal(document.getElementById('updatepostModal'));
  updatepostModal.hide();

  // Reset the form
  updatepostForm.reset();
  
});


</script>

<?php 
require_once("./footer.php")

?>


