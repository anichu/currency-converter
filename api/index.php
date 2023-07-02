<?php  
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require '../vendor/autoload.php';
require "./flight/Flight.php";
require "./flight/autoload.php";
require "./db.php";

// Generate a JWT token
function generateJWTToken($payload, $secretKey, $expiration = 3600, $algorithm = 'HS256')
{
  $payload['iat'] = time(); // Issued At
  $payload['exp'] = time() + $expiration; // Expiration Time
  $token = JWT::encode($payload, $secretKey, $algorithm);
  return "Bearer " . $token;
}


// Verify a JWT token and return the decoded payload
function verifyJWTToken($jwt, $secretKey)
{
  try {
    $tokenParts = explode(" ", $jwt);
    $token = '';
    if (count($tokenParts) === 2 && $tokenParts[0] === "Bearer") {
      $token = $tokenParts[1]; // Extract the token without the "Bearer" prefix
    } else {
      // Invalid authorization header  
      return ['message' => 'Invalid authorization header'];
    }
    $data = JWT::decode($token, new Key($secretKey, 'HS256'));
    return  $data;

  } catch (Exception $e) {
    return ['message' => 'Invalid token'];
  }
}


Flight::route('/', function(){

  // Define your secret key (should be securely stored and not exposed)
  $secretKey = 'anismolla537';
  $expireTime = time() + (24*86400);
  // Generate a sample JWT token
  $payload = array(
    "sub" => "1234567890", // Subject
    "iat" => time(), // Issued At
    "exp" => $expireTime, // Expiration Time (1 hour)
    "data" => array(
      "user_id" => 1,
      "username" => "john_doe"
    )
  );
  $jwt = generateJWTToken($payload,$secretKey,30*86400);
  // Decode and verify the JWT token
  $decoded = verifyJWTToken($jwt,$secretKey);
  Flight::json($decoded);
});

 // Get all users
Flight::route('GET /users', function(){
  $db = Flight::db();
  $stmt = $db->query(' SELECT * FROM user ');
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($users);
});



// Create a new new users
Flight::route('POST /users', function(){
  $db = Flight::db();
  $userData = Flight::request()->data;
  
  // Access the user_name property using array syntax
  $user_name = $userData['user_name'];
  $email = $userData['email'];
  $institution = $userData['institution'];
  $post_code = $userData['post_code'];

  $sql = 'INSERT INTO user (user_name, email, institution, post_code) VALUES (:user_name, :email, :institution, :post_code)';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':user_name', $user_name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':institution', $institution);
  $stmt->bindParam(':post_code', $post_code);
  $stmt->execute();

  // Get the last inserted user's ID
  $lastInsertId = $db->lastInsertId();

  // Fetch the last inserted user's data from the database
  $selectSql = 'SELECT * FROM user WHERE user_id = :user_id';
  $selectStmt = $db->prepare($selectSql);
  $selectStmt->bindParam(':user_id', $lastInsertId);
  $selectStmt->execute();
  $user = $selectStmt->fetch(PDO::FETCH_ASSOC);
  
  Flight::json($user, 201);

});

// Get data for a single user
Flight::route('GET /users/@id', function($id) {
  $db = Flight::db();

  // Prepare and execute the SELECT query
  $sql = 'SELECT * FROM user WHERE user_id = :user_id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
  $stmt->execute();

  // Fetch the user data
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    Flight::json($user);
  } else {
    Flight::halt(404, 'User not found');
  }
});

// Delete a user
Flight::route('DELETE /users/@user_id', function($user_id) {
  $db = Flight::db();

  // Prepare and execute the DELETE query
  $sql = 'DELETE FROM user WHERE user_id = :user_id';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();

  // Check if any rows were affected
  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    Flight::json(['message' => 'User deleted successfully']);
  } else {
    Flight::halt(404, 'User not found');
  }
});

// Update a user
Flight::route('PUT /users/@user_id', function($user_id) {
  $db = Flight::db();

  // Retrieve the user data from the request body
  $userData = json_decode(Flight::request()->getBody());

  // Check if any of the fields are empty
  if (empty($userData->user_name) && empty($userData->email) && empty($userData->institution) && empty($userData->post_code)) {
    Flight::halt(400, 'No fields provided for update');
  }

  // Build the SQL query dynamically based on the provided fields
  $sql = 'UPDATE user SET ';
  $fields = array();

  if (!empty($userData->user_name)) {
    $fields[] = 'user_name = :user_name';
  }

  if (!empty($userData->email)) {
    $fields[] = 'email = :email';
  }

  if (!empty($userData->institution)) {
    $fields[] = 'institution = :institution';
  }

  if (!empty($userData->post_code)) {
    $fields[] = 'post_code = :post_code';
  }

  $sql .= implode(', ', $fields);
  $sql .= ' WHERE user_id = :user_id';

  // Prepare and execute the UPDATE query
  $stmt = $db->prepare($sql);

  if (!empty($userData->user_name)) {
    $stmt->bindParam(':user_name', $userData->user_name, PDO::PARAM_STR);
  }

  if (!empty($userData->email)) {
    $stmt->bindParam(':email', $userData->email, PDO::PARAM_STR);
  }

  if (!empty($userData->institution)) {
    $stmt->bindParam(':institution', $userData->institution, PDO::PARAM_STR);
  }

  if (!empty($userData->post_code)) {
    $stmt->bindParam(':post_code', $userData->post_code, PDO::PARAM_STR);
  }

  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute();

  // Check if any rows were affected
  $rowCount = $stmt->rowCount();

  if ($rowCount > 0) {
    Flight::json(['message' => 'User updated successfully']);
  } else {
    Flight::halt(404, 'User not found');
  }
});

// Register api
Flight::route('POST /register', function(){
  $db = Flight::db();
  $userData = Flight::request()->data;
  
  // Retrieve user data from the request
  $username = $userData['username'];
  $fullName = $userData['fullName'];
  $password = $userData['password']; // Assuming the password is not hashed yet
  $address = $userData['address'];
  $institution = $userData['institution'];
  $postCode = $userData['postCode'];
  $email = $userData['email'];
  $phoneNumber = $userData['phoneNumber'];
  
  // Hash the password using a secure hashing algorithm (e.g., bcrypt)
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Validate the email address
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    Flight::json(array('message' => 'Invalid email address'), 400);
    return;
  }

  // Check if the email already exists in the database
  $sql = 'SELECT COUNT(*) as count FROM users WHERE email = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $emailCount = $result['count'];

  if ($emailCount > 0) {
    Flight::json(array('message' => 'Email already exists'), 409);
    return;
  }

  // Check password length
  if (strlen($password) < 4) {
    Flight::json(array('message' => 'Password should be at least 4 characters long'), 400);
    return;
  }
  
  // Insert the user data into the database
  $sql = 'INSERT INTO users(username, fullName, password, address, institution, postCode, email, phoneNumber) VALUES (:username, :fullName, :password, :address, :institution, :postCode, :email, :phoneNumber)';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':fullName', $fullName);
  $stmt->bindParam(':password', $hashedPassword);
  $stmt->bindParam(':address', $address);
  $stmt->bindParam(':institution', $institution);
  $stmt->bindParam(':postCode', $postCode);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':phoneNumber', $phoneNumber);
  $stmt->execute();
  $payload=array('username' => $username, 'email' => $email);
  $secretKey = 'anismolla537';
  $token = generateJWTToken($payload,$secretKey,30*86400);
  // Return a success message
  Flight::json(array('message' => 'User created successfully','token'=>$token), 201);
});

// Login API
Flight::route('POST /login', function(){
  $db = Flight::db();
  $loginData = Flight::request()->data;
  
  // Retrieve login data from the request
  $email = $loginData['email'];
  $password = $loginData['password'];

  // Validate the email address
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    Flight::json(array('message' => 'Invalid email address'), 400);
    return;
  }

  // Retrieve the user from the database based on the email
  $sql = 'SELECT * FROM users WHERE email = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if the user exists
  if (!$user) {
    Flight::json(array('message' => 'Invalid email or password'), 401);
    return;
  }

  // Verify the password
  if (!password_verify($password, $user['password'])) {
    Flight::json(array('message' => 'Invalid email or password'), 401);
    return;
  }

  // Generate JWT token for authentication
  $payload = array('username' => $user['username'], 'email' => $user['email']);
  $secretKey = 'anismolla537';
  $token = generateJWTToken($payload, $secretKey, 30 * 86400); // Token valid for 30 days

  // Return the token as a response
  Flight::json(array('token' => $token), 200);
});


Flight::route('POST /verify-jwt',function(){
  $db = Flight::db();
  $userData = Flight::request()->data;
  $token = $userData['token'];  
  $secretKey = 'anismolla537';
  $responseData = verifyJWTToken($token,$secretKey);
  Flight::json($responseData,200);
});


Flight::start(); // Start the Flight framework

?>
