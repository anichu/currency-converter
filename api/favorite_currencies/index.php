<?php  
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";


Flight::route('GET /', function(){
  echo "favorite currencies";
});

// Get all favorite currencies for a specific email
Flight::route('GET /favorite_currencies/all/@email', function($email) {
  $db = Flight::db();
  $query = "SELECT * FROM favorite_currencies WHERE email = :email";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($data);
});


// Get a specific favorite currency by ID
Flight::route('GET /favorite_currencies/@id', function($id) {
  $db = Flight::db();
  $query = "SELECT * FROM favorite_currencies WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  Flight::json($data);
});

// Create a new favorite currency
Flight::route('POST /favorite_currencies', function() {
  $db = Flight::db();
  $data = Flight::request()->data;
  $fromCurrency = $data['fromCurrency'];
  $toCurrency = $data['toCurrency'];
  $email = $data['email']; // Added line for email field
  $query = "INSERT INTO favorite_currencies (fromCurrency, toCurrency, email) VALUES (:fromCurrency, :toCurrency, :email)";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':fromCurrency', $fromCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':toCurrency', $toCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR); // Added line for email field
  $stmt->execute();
  Flight::json(['message' => 'Favorite currency created successfully']);
});


// Update an existing favorite currency
Flight::route('PUT /favorite_currencies/@id', function($id) {
  $db = Flight::db();
  $data = Flight::request()->data;
  $fromCurrency = $data['fromCurrency'];
  $toCurrency = $data['toCurrency'];
  $query = "UPDATE favorite_currencies SET fromCurrency = :fromCurrency, toCurrency = :toCurrency WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':fromCurrency', $fromCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':toCurrency', $toCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  Flight::json(['message' => 'Favorite currency updated successfully']);
});

// Delete a favorite currency
Flight::route('DELETE /favorite_currencies/@id', function($id) {
  $db = Flight::db();
  $query = "DELETE FROM favorite_currencies WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  Flight::json(['message' => 'Favorite currency deleted successfully']);
});

Flight::start();


?>