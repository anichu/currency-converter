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
  <button type="submit" data-bs-toggle="modal"  data-bs-target="#insertUserModal" class="btn btn-primary">Add Book</button>

  
  <table class="table">
    <thead class="text-center">
      <tr>
        <th>ID</th>
        <th>TITLE</th>
        <th>AUTHOR</th>
        <th>PUBLICATION_YEAR</th>
        <th>GENRE</th>
        <th>PRICE</th>
        <th>QUANTITY</th>
        <th>PUBLISHER</th>
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
        <form  id="updateBookForm">
          <!-- Hidden input field for user ID -->
          <input type="hidden" id="updateBookId">
          <div class="mb-3">
            <label for="updateTitle" class="form-label">Title</label>
            <input type="text" class="form-control w-full" id="updateTitle" required>
          </div>
          <div class="mb-3">
            <label for="updateAuthor" class="form-label">Author</label>
            <input type="text" class="form-control" id="updateAuthor" required>
          </div>
          <div class="mb-3">
            <label for="updatePublicationYear" class="form-label">Publication Year</label>
            <input type="text" class="form-control" id="updatePublicationYear" required>
          </div>
          <div class="mb-3">
            <label for="updateGenre" class="form-label">Genre</label>
            <input type="string" class="form-control" id="updateGenre" required>
          </div>
          <div class="mb-3">
            <label for="updatePrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="updatePrice" required>
          </div>
          <div class="mb-3">
            <label for="updateQuantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="updateQuantity" required>
          </div>
          <div class="mb-3">
            <label for="updatePublisher" class="form-label">Publisher</label>
            <input type="text" class="form-control" id="updatePublisher" required>
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
        <h5 class="modal-title" id="insertUserModalLabel">Add Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Insert User Form -->
        <form id="insertBookForm">
          <!-- Hidden input field for user ID -->
          <div class="mb-3">
            <label for="insertTitle" class="form-label">Title</label>
            <input type="text" class="form-control w-full" id="insertTitle" required>
          </div>
          <div class="mb-3">
            <label for="insertAuthor" class="form-label">Author</label>
            <input type="text" class="form-control" id="insertAuthor" required>
          </div>
          <div class="mb-3">
            <label for="insertPublicationYear" class="form-label">Publication Year</label>
            <input type="text" class="form-control" id="insertPublicationYear" required>
          </div>
          <div class="mb-3">
            <label for="insertGenre" class="form-label">Genre</label>
            <input type="string" class="form-control" id="insertGenre" required>
          </div>
          <div class="mb-3">
            <label for="insertPrice" class="form-label">Price</label>
            <input type="number" class="form-control" id="insertPrice" required>
          </div>
          <div class="mb-3">
            <label for="insertQuantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="insertQuantity" required>
          </div>
          <div class="mb-3">
            <label for="insertPublisher" class="form-label">Publisher</label>
            <input type="text" class="form-control" id="insertPublisher" required>
          </div>
          <button  type="submit" data-bs-dismiss="modal" class="btn btn-primary">Add book</button>
        </form>
      </div>
    </div>
  </div>
</div>



<script>

//TODO:: show student information
const showBooks = () => {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'http://localhost/rahat/api/books/books/', true);
  var books = [];
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
      books = JSON.parse(this.responseText);
      var tableRows = '';

      books.forEach(function (bookData) {
        tableRows += `
        <tr class="text-black-100 text-xl">
          <td class="border border-slate">${bookData.id}</td>
          <td class="border border-slate">${bookData.title}</td>
          <td class="border border-slate">${bookData.author}</td>
          <td class="border border-slate">${bookData.publication_year}</td>
          <td class="border border-slate">${bookData.genre}</td>
          <td class="border border-slate">${bookData.price}</td>
          <td class="border border-slate">${bookData.quantity}</td>
          <td class="border border-slate">${bookData.publisher}</td>
          <td>
            <button class='btn btn-primary btn-sm' onclick='deleteBook(${bookData.id})' id="deleteBtn">Delete</button>
          </td>
          <td>
            <button onclick='editBook(${bookData.id})' class='btn btn-danger btn-sm'>Edit</button>
          </td>
        </tr>

        `;
      });

      document.getElementById('tableBody').innerHTML = tableRows;
    }
  };

  xhr.send();
};
//TODO:: Call the showBooks function to fetch and display the user data
showBooks();

//  TODO:: Get the form element
const insertBookForm = document.getElementById('insertBookForm');

// TODO:: Add an event listener to the form submit event
insertBookForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the input values from the form
  const title = document.getElementById('insertTitle').value;
  const author = document.getElementById('insertAuthor').value;
  const publicationYear = document.getElementById('insertPublicationYear').value;
  const genre = document.getElementById('insertGenre').value;
  const price = document.getElementById('insertPrice').value;
  const quantity = document.getElementById('insertQuantity').value;
  const publisher = document.getElementById('insertPublisher').value;

  // Validate the input fields
  if (!title || !author || !publicationYear || !genre || !price || !quantity || !publisher) {
    alert('Please fill all the fields');
    return;
  }

  // Convert the input values to the appropriate types
  const publicationYearInt = parseInt(publicationYear);
  const priceFloat = parseFloat(price);
  const quantityInt = parseInt(quantity);

  // Create an object with the book data
  const bookData = {
    title: title,
    author: author,
    publication_year: publicationYearInt,
    genre: genre,
    price: priceFloat,
    quantity: quantityInt,
    publisher: publisher
  };

  // Perform an AJAX call to insert the book data
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://localhost/rahat/api/books/books/', true);
  xhr.setRequestHeader('Content-type', 'application/json');
  xhr.onload = function() {
    if (xhr.status === 201) {
      // Success, do something
      console.log('Book inserted successfully');

      // Reset the form
      insertBookForm.reset();

      // Show the confirmation alert
      const insertConfirmationAlert = document.getElementById('insertConfirmationAlert');
      insertConfirmationAlert.style.display = 'block';

      // Refresh the book list
      showBooks();
    } else {
      // Error, handle it
      console.log('Error inserting book');
      document.getElementById('insertErrorAlert').style.display = 'block';
    }
  };
  xhr.onerror = function() {
    console.log('Request error');
  };
  xhr.send(JSON.stringify(bookData));
});




// Delete user
const deleteBook = (bookId) => {
  const id = parseInt(bookId);
  console.log(id);

  const flag = window.confirm('Are you sure you want to delete it?');
  console.log(flag);
  if(!flag){
    return;
  }

  var xhr = new XMLHttpRequest();
  xhr.open('DELETE', `http://localhost/rahat/api/books/books/${id}`, true);
  xhr.onload = function () {
    if (this.status == 200) {
      showBooks();
    }
  };
  xhr.send();
};


const editBook = (bookId) => {
  const id = parseInt(bookId);

  // Get the book data for the specified bookId
  var xhr = new XMLHttpRequest();
  xhr.open('GET', `http://localhost/rahat/api/books/books/${id}`, true);

  xhr.onload = function () {
    if (this.status == 200) {
      var book = JSON.parse(this.responseText);
      var title = book.title;
      var author = book.author;
      var publicationYear = book.publication_year;
      var genre = book.genre;
      var price = book.price;
      var quantity = book.quantity;
      var publisher = book.publisher;

      // Set the form values in the update book modal
      document.getElementById("updateBookId").value = id; 
      document.getElementById('updateTitle').value = title;
      document.getElementById('updateAuthor').value = author;
      document.getElementById('updatePublicationYear').value = publicationYear;
      document.getElementById('updateGenre').value = genre;
      document.getElementById('updatePrice').value = price;
      document.getElementById('updateQuantity').value = quantity;
      document.getElementById('updatePublisher').value = publisher;

      // Open the update book modal
      var modal = new bootstrap.Modal(document.getElementById('updateUserModal'));
      modal.show();
    }
  };
  xhr.send();
}


// Get the form element
const updateBookForm = document.getElementById('updateBookForm');

// Add an event listener to the form submit event
updateBookForm.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting

  // Get the updated values from the input fields
  let bookId = document.getElementById('updateBookId').value;
  const updatedTitle = document.getElementById('updateTitle').value;
  const updatedAuthor = document.getElementById('updateAuthor').value;
  const updatedPublicationYear = document.getElementById('updatePublicationYear').value;
  const updatedGenre = document.getElementById('updateGenre').value;
  const updatedPrice = document.getElementById('updatePrice').value;
  const updatedQuantity = document.getElementById('updateQuantity').value;
  const updatedPublisher = document.getElementById('updatePublisher').value;

  bookId = parseInt(bookId);
  const updatedBookData = {
    title: updatedTitle,
    author: updatedAuthor,
    publication_year: updatedPublicationYear,
    genre: updatedGenre,
    price: updatedPrice,
    quantity: updatedQuantity,
    publisher: updatedPublisher
  };

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  
  // Set the request method and URL
  xhr.open('PUT', 'http://localhost/rahat/api/books/books/' + bookId, true);

  // Set the request header
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  // Define the callback function for when the request is complete
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Request was successful, handle the response
      const response = JSON.parse(xhr.responseText);
      console.log(response);
      // Additional logic here
      showBooks();
    } else {
      // Request failed, handle the error
      console.error('Error:', xhr.status);
    }
  };

  // Convert the updated book data to JSON string
  const jsonData = JSON.stringify(updatedBookData);

  // Send the request with the JSON data
  xhr.send(jsonData);

  const updateBookModal = new bootstrap.Modal(document.getElementById('updateUserModal'));
  updateBookModal.hide();

  // Reset the form
  updateBookForm.reset();
});



</script>

<?php 
require_once("./footer.php")

?>


