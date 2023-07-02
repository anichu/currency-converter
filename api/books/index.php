<?php  
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";



Flight::route('GET /', function(){
  echo "books";
});

 // Get all books
Flight::route('GET /books', function(){
  $db = Flight::db();
  $stmt = $db->query(' SELECT * FROM books ');
  $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($students);
});


// Create a new book
Flight::route('POST /books', function(){
  try {
    $db = Flight::db();
    $bookData = Flight::request()->data;
    
    // Access the book properties using array syntax
    $id = $bookData["id"];
    $title = $bookData["title"];
    $author = $bookData["author"];
    $publicationYear = $bookData["publication_year"];
    $genre = $bookData["genre"];
    $price = $bookData["price"];
    $quantity = $bookData["quantity"];
    $publisher = $bookData["publisher"];
    
    $sql = 'INSERT INTO books (id, title, author, publication_year, genre, price, quantity, publisher) VALUES (:id, :title, :author, :publicationYear, :genre, :price, :quantity, :publisher)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':publicationYear', $publicationYear);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':publisher', $publisher);
    $stmt->execute();

    // Retrieve the inserted book
    $bookId = $db->lastInsertId();
    $selectSql = 'SELECT * FROM books WHERE id = :id';
    $selectStmt = $db->prepare($selectSql);
    $selectStmt->bindParam(':id', $bookId);
    $selectStmt->execute();
    $book = $selectStmt->fetch(PDO::FETCH_ASSOC);
  
    Flight::json($book, 201);
  } catch (PDOException $e) {
    // Handle database-related errors
    // You can log or display the error message
    Flight::json(['error' => $e->getMessage()], 500);
  } catch (Exception $e) {
    // Handle other types of exceptions
    // You can log or display the error message
    Flight::json(['error' => $e->getMessage()], 500);
  }
});




// Get data for a single user
Flight::route('GET /books/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the SELECT query
  $sql = 'SELECT * FROM books WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Fetch the user data
  $book= $stmt->fetch(PDO::FETCH_ASSOC);

  if ($book) {
    Flight::json($book);
  } else {
    Flight::halt(404, 'book not found');
  }
});

// Delete a user
Flight::route('DELETE /books/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the DELETE query
  $sql = 'DELETE FROM books WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Check if any rows were affected
  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    Flight::json(['message' => 'Book deleted successfully']);
  } else {
    Flight::halt(404, ['message' => 'Book not found']);
  }
});



// Update a book
Flight::route('PUT /books/@id', function($id) {
  try {
    $db = Flight::db();

    // Retrieve the book data from the request body
    $bookData = json_decode(Flight::request()->getBody(), true);

    // Check if any of the fields are empty
    if (empty($bookData['title']) && empty($bookData['author']) && empty($bookData['publication_year']) && empty($bookData['genre']) && empty($bookData['price']) && empty($bookData['quantity']) && empty($bookData['publisher'])) {
      Flight::halt(400, 'No fields provided for update');
    }

    // Build the SQL query dynamically based on the provided fields
    $sql = 'UPDATE books SET ';
    $fields = array();

    if (!empty($bookData['title'])) {
      $fields[] = 'title = :title';
    }

    if (!empty($bookData['author'])) {
      $fields[] = 'author = :author';
    }

    if (!empty($bookData['publication_year'])) {
      $fields[] = 'publication_year = :publicationYear';
    }

    if (!empty($bookData['genre'])) {
      $fields[] = 'genre = :genre';
    }

    if (!empty($bookData['price'])) {
      $fields[] = 'price = :price';
    }

    if (!empty($bookData['quantity'])) {
      $fields[] = 'quantity = :quantity';
    }

    if (!empty($bookData['publisher'])) {
      $fields[] = 'publisher = :publisher';
    }

    $sql .= implode(', ', $fields);
    $sql .= ' WHERE id = :id';

    // Prepare and execute the UPDATE query
    $stmt = $db->prepare($sql);

    if (!empty($bookData['title'])) {
      $stmt->bindParam(':title', $bookData['title'], PDO::PARAM_STR);
    }

    if (!empty($bookData['author'])) {
      $stmt->bindParam(':author', $bookData['author'], PDO::PARAM_STR);
    }

    if (!empty($bookData['publication_year'])) {
      $stmt->bindParam(':publicationYear', $bookData['publication_year'], PDO::PARAM_INT);
    }

    if (!empty($bookData['genre'])) {
      $stmt->bindParam(':genre', $bookData['genre'], PDO::PARAM_STR);
    }

    if (!empty($bookData['price'])) {
      $stmt->bindParam(':price', $bookData['price'], PDO::PARAM_STR);
    }

    if (!empty($bookData['quantity'])) {
      $stmt->bindParam(':quantity', $bookData['quantity'], PDO::PARAM_INT);
    }

    if (!empty($bookData['publisher'])) {
      $stmt->bindParam(':publisher', $bookData['publisher'], PDO::PARAM_STR);
    }

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Check if any rows were affected
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
      Flight::json(['message' => 'Book updated successfully']);
    } else {
      Flight::halt(404, ['message' => 'Book not found']);
    }
  } catch (PDOException $e) {
    // Handle database-related errors
    // You can log or display the error message
    Flight::json(['error' => $e->getMessage()], 500);
  } catch (Exception $e) {
    // Handle other types of exceptions
    // You can log or display the error message
    Flight::json(['error' => $e->getMessage()], 500);
  }
});




Flight::start(); // Start the Flight framework

?>
