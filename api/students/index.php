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

 // Get all students
Flight::route('GET /students', function(){
  $db = Flight::db();
  $stmt = $db->query(' SELECT * FROM students ');
  $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($students);
});


// Create a new student
Flight::route('POST /students', function(){
  try {
    $db = Flight::db();
    $studentData = Flight::request()->data;
    
    // Access the student properties using array syntax
    $id = $studentData["id"];
    $name = $studentData["name"];
    $age = $studentData["age"];
    $studentId = $studentData["studentId"];
    $major = $studentData["major"];
    $cgpa = $studentData["cgpa"];
    $email = $studentData["email"];
    $phone = $studentData["phone"];
    $street = $studentData["street"];
    $city = $studentData["city"];
    $state = $studentData["state"];
    $zip = $studentData["zip"];
    $graduationYear = $studentData["graduationYear"];

    $sql = 'INSERT INTO students (id, name, age, studentId, major, cgpa, email, phone, street, city, state, zip, graduationYear) VALUES (:id, :name, :age, :studentId, :major, :cgpa, :email, :phone, :street, :city, :state, :zip, :graduationYear)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':studentId', $studentId);
    $stmt->bindParam(':major', $major);
    $stmt->bindParam(':cgpa', $cgpa);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':zip', $zip);
    $stmt->bindParam(':graduationYear', $graduationYear);
    $stmt->execute();

    // Retrieve the inserted student
    $studentId = $db->lastInsertId();
    $selectSql = 'SELECT * FROM students WHERE id = :id';
    $selectStmt = $db->prepare($selectSql);
    $selectStmt->bindParam(':id', $studentId);
    $selectStmt->execute();
    $student = $selectStmt->fetch(PDO::FETCH_ASSOC);
  
    Flight::json($student, 201);
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
Flight::route('GET /students/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the SELECT query
  $sql = 'SELECT * FROM students WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Fetch the user data
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    Flight::json($user);
  } else {
    Flight::halt(404, 'student not found');
  }
});

// Delete a user
Flight::route('DELETE /students/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the DELETE query
  $sql = 'DELETE FROM students WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Check if any rows were affected
  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    Flight::json(['message' => 'Student deleted successfully']);
  } else {
    Flight::halt(404, ['message' => 'Student not found']);
  }
});



// Update a student
Flight::route('PUT /students/@id', function($id) {
  try {
    $db = Flight::db();

    // Retrieve the student data from the request body
    $studentData = json_decode(Flight::request()->getBody(), true);

    // Check if any of the fields are empty
    if (empty($studentData['name']) && empty($studentData['age']) && empty($studentData['studentId']) && empty($studentData['major']) && empty($studentData['cgpa']) && empty($studentData['email']) && empty($studentData['phone']) && empty($studentData['street']) && empty($studentData['city']) && empty($studentData['state']) && empty($studentData['zip']) && empty($studentData['graduationYear'])) {
      Flight::halt(400, 'No fields provided for update');
    }

    // Build the SQL query dynamically based on the provided fields
    $sql = 'UPDATE students SET ';
    $fields = array();

    if (!empty($studentData['name'])) {
      $fields[] = 'name = :name';
    }

    if (!empty($studentData['age'])) {
      $fields[] = 'age = :age';
    }

    if (!empty($studentData['studentId'])) {
      $fields[] = 'studentId = :studentId';
    }

    if (!empty($studentData['major'])) {
      $fields[] = 'major = :major';
    }

    if (!empty($studentData['cgpa'])) {
      $fields[] = 'cgpa = :cgpa';
    }

    if (!empty($studentData['email'])) {
      $fields[] = 'email = :email';
    }

    if (!empty($studentData['phone'])) {
      $fields[] = 'phone = :phone';
    }

    if (!empty($studentData['street'])) {
      $fields[] = 'street = :street';
    }

    if (!empty($studentData['city'])) {
      $fields[] = 'city = :city';
    }

    if (!empty($studentData['state'])) {
      $fields[] = 'state = :state';
    }

    if (!empty($studentData['zip'])) {
      $fields[] = 'zip = :zip';
    }

    if (!empty($studentData['graduationYear'])) {
      $fields[] = 'graduationYear = :graduationYear';
    }

    $sql .= implode(', ', $fields);
    $sql .= ' WHERE id = :id';

    // Prepare and execute the UPDATE query
    $stmt = $db->prepare($sql);

    if (!empty($studentData['name'])) {
      $stmt->bindParam(':name', $studentData['name'], PDO::PARAM_STR);
    }

    if (!empty($studentData['age'])) {
      $stmt->bindParam(':age', $studentData['age'], PDO::PARAM_INT);
    }

    if (!empty($studentData['studentId'])) {
      $stmt->bindParam(':studentId', $studentData['studentId'], PDO::PARAM_STR);
    }

    if (!empty($studentData['major'])) {
      $stmt->bindParam(':major', $studentData['major'], PDO::PARAM_STR);
    }

    if (!empty($studentData['cgpa'])) {
      $stmt->bindParam(':cgpa', $studentData['cgpa'], PDO::PARAM_STR);
    }

    if (!empty($studentData['email'])) {
      $stmt->bindParam(':email', $studentData['email'], PDO::PARAM_STR);
    }

    if (!empty($studentData['phone'])) {
      $stmt->bindParam(':phone', $studentData['phone'], PDO::PARAM_STR);
    }

    if (!empty($studentData['street'])) {
      $stmt->bindParam(':street', $studentData['street'], PDO::PARAM_STR);
    }

    if (!empty($studentData['city'])) {
      $stmt->bindParam(':city', $studentData['city'], PDO::PARAM_STR);
    }

    if (!empty($studentData['state'])) {
      $stmt->bindParam(':state', $studentData['state'], PDO::PARAM_STR);
    }

    if (!empty($studentData['zip'])) {
      $stmt->bindParam(':zip', $studentData['zip'], PDO::PARAM_STR);
    }

    if (!empty($studentData['graduationYear'])) {
      $stmt->bindParam(':graduationYear', $studentData['graduationYear'], PDO::PARAM_INT);
    }

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Check if any rows were affected
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
      Flight::json(['message' => 'Student updated successfully']);
    } else {
      Flight::halt(404, ['message' => 'Student not found']);
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
