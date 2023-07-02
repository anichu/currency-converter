<?php  
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";


Flight::route('GET /', function(){
  echo "conversion";
});

// Get all favorite currencies
Flight::route('GET /conversion/all/@email', function($email) {
  $db = Flight::db();
  $query = "SELECT * FROM conversion WHERE email = :email";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR); // Change PDO::PARAM_INT to PDO::PARAM_STR
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($data);
});


// Get a specific favorite currency by ID
Flight::route('GET /conversion/@id', function($id) {
  $db = Flight::db();
  $query = "SELECT * FROM conversion WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  Flight::json($data);
});

// Create a new favorite currency
Flight::route('POST /conversion', function() {
  $db = Flight::db();
  $data = Flight::request()->data;
  $fromCurrency = $data['fromCurrency'];
  $toCurrency = $data['toCurrency'];
  $email = $data['email'];
  $query = "INSERT INTO conversion (email,fromCurrency, toCurrency) VALUES (:email,:fromCurrency, :toCurrency)";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':fromCurrency', $fromCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':toCurrency', $toCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  Flight::json(['message' => 'Conversion currency created successfully']);
});

// Update an existing favorite currency
Flight::route('PUT /conversion/@id', function($id) {
  $db = Flight::db();
  $data = Flight::request()->data;
  $fromCurrency = $data['fromCurrency'];
  $toCurrency = $data['toCurrency'];
  $query = "UPDATE conversion SET fromCurrency = :fromCurrency, toCurrency = :toCurrency WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':fromCurrency', $fromCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':toCurrency', $toCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  Flight::json(['message' => 'Favorite currency updated successfully']);
});

// Delete a favorite currency
Flight::route('DELETE /conversion/@id', function($id) {
  $db = Flight::db();
  $query = "DELETE FROM conversion WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  Flight::json(['message' => 'Favorite currency deleted successfully']);
});

Flight::start();


?>