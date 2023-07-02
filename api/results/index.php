<?php  
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";



Flight::route('GET /', function(){
  echo "results";
});

 // Get all results
Flight::route('GET /results', function(){
  $db = Flight::db();
  $stmt = $db->query(' SELECT * FROM results ');
  $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($students);
});


// Create a new result
Flight::route('POST /results', function(){
  try {
    $db = Flight::db();
    $resultData = Flight::request()->data;
    
    // Access the result properties using array syntax
    $studentId = $resultData["student_id"];
    $subject = $resultData["subject"];
    $marks = $resultData["marks"];
    $grade = $resultData["grade"];
    
    $sql = 'INSERT INTO results (student_id, subject, marks, grade) VALUES (:studentId, :subject, :marks, :grade)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':studentId', $studentId);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':marks', $marks);
    $stmt->bindParam(':grade', $grade);
    $stmt->execute();

    // Retrieve the inserted result
    $resultId = $db->lastInsertId();
    $selectSql = 'SELECT * FROM results WHERE id = :id';
    $selectStmt = $db->prepare($selectSql);
    $selectStmt->bindParam(':id', $resultId);
    $selectStmt->execute();
    $result = $selectStmt->fetch(PDO::FETCH_ASSOC);
  
    Flight::json($result, 201);
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
Flight::route('GET /results/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the SELECT query
  $sql = 'SELECT * FROM results WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Fetch the user data
  $result= $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    Flight::json($result);
  } else {
    Flight::halt(404, 'Result not found');
  }
});

// Delete a user
Flight::route('DELETE /results/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the DELETE query
  $sql = 'DELETE FROM results WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Check if any rows were affected
  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    Flight::json(['message' => 'Result deleted successfully']);
  } else {
    Flight::halt(404, ['message' => 'Result not found']);
  }
});



// Update a result
Flight::route('PUT /results/@id', function($id) {
  try {
    $db = Flight::db();

    // Retrieve the result data from the request body
    $resultData = json_decode(Flight::request()->getBody(), true);

    // Check if any of the fields are empty
    if (empty($resultData['student_id']) && empty($resultData['subject']) && empty($resultData['marks']) && empty($resultData['grade'])) {
      Flight::halt(400, 'No fields provided for update');
    }

    // Build the SQL query dynamically based on the provided fields
    $sql = 'UPDATE results SET ';
    $fields = array();

    if (!empty($resultData['student_id'])) {
      $fields[] = 'student_id = :student_id';
    }

    if (!empty($resultData['subject'])) {
      $fields[] = 'subject = :subject';
    }

    if (!empty($resultData['marks'])) {
      $fields[] = 'marks = :marks';
    }

    if (!empty($resultData['grade'])) {
      $fields[] = 'grade = :grade';
    }

    $sql .= implode(', ', $fields);
    $sql .= ' WHERE id = :id';

    // Prepare and execute the UPDATE query
    $stmt = $db->prepare($sql);

    if (!empty($resultData['student_id'])) {
      $stmt->bindParam(':student_id', $resultData['student_id'], PDO::PARAM_INT);
    }

    if (!empty($resultData['subject'])) {
      $stmt->bindParam(':subject', $resultData['subject'], PDO::PARAM_STR);
    }

    if (!empty($resultData['marks'])) {
      $stmt->bindParam(':marks', $resultData['marks'], PDO::PARAM_STR);
    }

    if (!empty($resultData['grade'])) {
      $stmt->bindParam(':grade', $resultData['grade'], PDO::PARAM_STR);
    }

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Check if any rows were affected
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
      Flight::json(['message' => 'Result updated successfully']);
    } else {
      Flight::halt(404, 'Result not found');
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
