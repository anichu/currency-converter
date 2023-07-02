<?php  
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require '../../vendor/autoload.php';
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";



Flight::route('GET /', function(){
  echo "anis";
});

 // Get all posts
Flight::route('GET /posts', function(){
  $db = Flight::db();
  $stmt = $db->query(' SELECT * FROM posts ');
  $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($posts);
});


// Create a new post
Flight::route('POST /posts', function(){
  try {
    $db = Flight::db();
    $userData = Flight::request()->data;
    
    // Access the title and content properties using array syntax
    $title = $userData['title'];
    $content = $userData['content'];
  
    $sql = 'INSERT INTO Posts (title, content) VALUES (:title, :content)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->execute();

    // Retrieve the inserted post
    $postId = $db->lastInsertId();
    $selectSql = 'SELECT * FROM Posts WHERE id = :id';
    $selectStmt = $db->prepare($selectSql);
    $selectStmt->bindParam(':id', $postId);
    $selectStmt->execute();
    $post = $selectStmt->fetch(PDO::FETCH_ASSOC);
  
    Flight::json($post, 201);
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
Flight::route('GET /posts/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the SELECT query
  $sql = 'SELECT * FROM posts WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Fetch the user data
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    Flight::json($user);
  } else {
    Flight::halt(404, 'Post not found');
  }
});

// Delete a user
Flight::route('DELETE /posts/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the DELETE query
  $sql = 'DELETE FROM posts WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Check if any rows were affected
  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    Flight::json(['message' => 'post deleted successfully']);
  } else {
    Flight::halt(404, ['message' => 'Post not found']);
  }
});

// Update a user
Flight::route('PUT /posts/@id', function($id) {
  $db = Flight::db();

  // Retrieve the user data from the request body
  $postData = json_decode(Flight::request()->getBody());

  // Check if any of the fields are empty
  if (empty($postData->title) && empty($postData->content) && empty($postData->institution) && empty($postData->post_code)) {
    Flight::halt(400, 'No fields provided for update');
  }

  // Build the SQL query dynamically based on the provided fields
  $sql = 'UPDATE posts SET ';
  $fields = array();

  if (!empty($postData->title)) {
    $fields[] = 'title = :title';
  }

  if (!empty($postData->content)) {
    $fields[] = 'content = :content';
  }



  $sql .= implode(', ', $fields);
  $sql .= ' WHERE id = :id';

  // Prepare and execute the UPDATE query
  $stmt = $db->prepare($sql);

  if (!empty($postData->title)) {
    $stmt->bindParam(':title', $postData->title, PDO::PARAM_STR);
  }

  if (!empty($postData->content)) {
    $stmt->bindParam(':content', $postData->content, PDO::PARAM_STR);
  }

  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Check if any rows were affected
  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    Flight::json(['message' => 'Post updated successfully']);
  } else {
    Flight::halt(404, ['message' => 'Post not found']);
  }
});



Flight::start(); // Start the Flight framework

?>
