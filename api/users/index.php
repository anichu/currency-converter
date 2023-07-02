<?php  
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";


// Get all users
Flight::route('GET /users', function(){
  $db = Flight::db();
  $stmt = $db->query(' SELECT * FROM users ');
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($users);
});

Flight::route('GET /users/id/@id', function($id) {
  $db = Flight::db();
  $query = "SELECT * FROM users WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if ($user) {
    Flight::json($user);
  } else {
    Flight::json(['message' => 'User not found'], 404);
  }
});

Flight::route('GET /users/@email', function($email) {
  $db = Flight::db();
  $query = "SELECT * FROM users WHERE email = :email";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if ($user) {
    Flight::json($user);
  } else {
    Flight::halt(404, 'User not found');
  }
});



// Show all the set currency alerts
Flight::route('GET /alerts/all/@email', function($email) {
  $db = Flight::db();
  $query = "SELECT * FROM alerts WHERE email = :email";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($alerts);
});

// Update a user
Flight::route('PUT /users/@id', function($id) {
  try {
    $db = Flight::db();

    // Retrieve the user data from the request body
    $userData = json_decode(Flight::request()->getBody(), true);

    // Check if any of the fields are empty
    if (empty($userData['username']) && empty($userData['email']) && empty($userData['user_role']) && empty($userData['institution']) && empty($userData['postCode']) && empty($userData['fullName']) && empty($userData['phoneNumber']) && empty($userData['address']) && empty($userData['password'])) {
      Flight::halt(400, 'No fields provided for update');
    }

    // Build the SQL query dynamically based on the provided fields
    $sql = 'UPDATE users SET ';
    $fields = array();

    if (!empty($userData['username'])) {
      $fields[] = 'username = :username';
    }

    if (!empty($userData['email'])) {
      $fields[] = 'email = :email';
    }

    if (!empty($userData['user_role'])) {
      $fields[] = 'user_role = :user_role';
    }

    if (!empty($userData['institution'])) {
      $fields[] = 'institution = :institution';
    }

    if (!empty($userData['postCode'])) {
      $fields[] = 'postCode = :postCode';
    }

    if (!empty($userData['fullName'])) {
      $fields[] = 'fullName = :fullName';
    }

    if (!empty($userData['phoneNumber'])) {
      $fields[] = 'phoneNumber = :phoneNumber';
    }

    if (!empty($userData['address'])) {
      $fields[] = 'address = :address';
    }

    if (!empty($userData['password'])) {
      $fields[] = 'password = :password';
    }

    $sql .= implode(', ', $fields);
    $sql .= ' WHERE id = :id';

    // Prepare and execute the UPDATE query
    $stmt = $db->prepare($sql);

    if (!empty($userData['username'])) {
      $stmt->bindParam(':username', $userData['username'], PDO::PARAM_STR);
    }

    if (!empty($userData['email'])) {
      $stmt->bindParam(':email', $userData['email'], PDO::PARAM_STR);
    }

    if (!empty($userData['user_role'])) {
      $stmt->bindParam(':user_role', $userData['user_role'], PDO::PARAM_STR);
    }

    if (!empty($userData['institution'])) {
      $stmt->bindParam(':institution', $userData['institution'], PDO::PARAM_STR);
    }

    if (!empty($userData['postCode'])) {
      $stmt->bindParam(':postCode', $userData['postCode'], PDO::PARAM_STR);
    }

    if (!empty($userData['fullName'])) {
      $stmt->bindParam(':fullName', $userData['fullName'], PDO::PARAM_STR);
    }

    if (!empty($userData['phoneNumber'])) {
      $stmt->bindParam(':phoneNumber', $userData['phoneNumber'], PDO::PARAM_STR);
    }

    if (!empty($userData['address'])) {
      $stmt->bindParam(':address', $userData['address'], PDO::PARAM_STR);
    }

    if (!empty($userData['password'])) {
      $stmt->bindParam(':password', $userData['password'], PDO::PARAM_STR);
    }

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Check if any rows were affected
    $rowCount = $stmt->rowCount();

    if ($rowCount > 0) {
      Flight::json(['message' => 'User updated successfully']);
    } else {
      Flight::halt(404, 'User not found');
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






Flight::route('DELETE /users/@id', function($id) {
  $db = Flight::db();
  $query = "DELETE FROM users WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  Flight::json(['message' => 'User deleted successfully']);
});




Flight::start();


?>