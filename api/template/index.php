<?php  
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";


Flight::route('GET /', function(){
  echo "template";
});

// Get all  currencies
Flight::route('GET /template/all/@email', function($email) {
  $db = Flight::db();
  $query = "SELECT * FROM template WHERE email = :email";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  Flight::json($data);
});


// Get a specific favorite currency by ID
Flight::route('GET /template/@id', function($id) {
  $db = Flight::db();
  $query = "SELECT * FROM template WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  Flight::json($data);
});

// Create a new favorite currency
Flight::route('POST /template', function() {
  $db = Flight::db();
  $data = Flight::request()->data;
  $name = $data['name'];
  $fromCurrency = $data['fromCurrency'];
  $toCurrency = $data['toCurrency'];
  $email = $data['email'];
  $query = "INSERT INTO template (name, fromCurrency, toCurrency, email) VALUES (:name, :fromCurrency, :toCurrency, :email)";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':name', $name, PDO::PARAM_STR);
  $stmt->bindValue(':fromCurrency', $fromCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':toCurrency', $toCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  Flight::json(['message' => 'template currency created successfully']);
});



// update 
Flight::route('PUT /template/@id', function($id) {
  $db = Flight::db();
  $data = Flight::request()->data;
  $name = $data['name'] ?? null;
  $fromCurrency = $data['fromCurrency'] ?? null;
  $toCurrency = $data['toCurrency'] ?? null;

  // Check if none of the values are given
  if (empty($name) && empty($fromCurrency) && empty($toCurrency)) {
    Flight::json(['message' => 'At least one field is required for update'], 400);
    return;
  }

  $query = "UPDATE template SET";
  $params = [];

  if (!empty($name)) {
    $query .= " name = :name,";
    $params[':name'] = $name;
  }
  if (!empty($fromCurrency)) {
    $query .= " fromCurrency = :fromCurrency,";
    $params[':fromCurrency'] = $fromCurrency;
  }
  if (!empty($toCurrency)) {
    $query .= " toCurrency = :toCurrency,";
    $params[':toCurrency'] = $toCurrency;
  }

  // Remove the trailing comma from the query
  $query = rtrim($query, ',');

  $query .= " WHERE id = :id";
  $params[':id'] = $id;

  $stmt = $db->prepare($query);
  foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value, PDO::PARAM_STR);
  }
  $stmt->execute();
  Flight::json(['message' => 'template currency updated successfully']);
});


// Delete a favorite currency
Flight::route('DELETE /template/@id', function($id) {
  $db = Flight::db();
  $query = "DELETE FROM template WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  Flight::json(['message' => 'template currency deleted successfully']);
});

Flight::start();


?>