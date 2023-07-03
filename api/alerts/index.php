<?php  
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";


Flight::route('POST /alerts', function() {
  $db = Flight::db();
  $data = Flight::request()->data;
  $value = $data['value'];
  $email = $data['email'];
  $fromCurrency = $data['fromCurrency'];
  $toCurrency = $data['toCurrency'];

  if($fromCurrency == $toCurrency){
    // If a duplicate alert exists, return an error response
    Flight::json(['message'=>'Invalid exchange currency'], 409);
    return;
  }

  // Check if an alert with the same email, fromCurrency, and toCurrency already exists
  $query = "SELECT COUNT(*) as count FROM alerts WHERE email = :email AND fromCurrency = :fromCurrency AND toCurrency = :toCurrency";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':fromCurrency', $fromCurrency, PDO::PARAM_STR);
  $stmt->bindValue(':toCurrency', $toCurrency, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result['count'] > 0) {
    // If a duplicate alert exists, return an error response
    Flight::json(['message' => 'Alert with the same email, fromCurrency, and toCurrency already exists'], 400);
  } else {
    // If no duplicate alert exists, proceed with the insertion
    $query = "INSERT INTO alerts (value, email, fromCurrency, toCurrency) 
    VALUES (:value, :email, :fromCurrency, :toCurrency)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':value', $value, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':fromCurrency', $fromCurrency, PDO::PARAM_STR);
    $stmt->bindValue(':toCurrency', $toCurrency, PDO::PARAM_STR);
    $stmt->execute();

    Flight::json(['message' => 'Alert created successfully']);
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

Flight::route('PUT /alerts/@id', function($id) {
  $db = Flight::db();
  $data = Flight::request()->data;
  $value = $data['value'] ?? null;
  $fromCurrency = $data['fromCurrency'] ?? null;
  $toCurrency = $data['toCurrency'] ?? null;

  // Check if none of the values are given
  if (empty($value) && empty($fromCurrency) && empty($toCurrency)) {
    Flight::json(['message' => 'At least one field is required for update'], 400);
    return;
  }

  $query = "UPDATE alerts SET";
  $params = [];

  if (!empty($value)) {
    $query .= " value = :value,";
    $params[':value'] = $value;
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
  Flight::json(['message' => 'Alert updated successfully']);
});

Flight::route('GET /alerts/@id', function($id) {
  $db = Flight::db();
  $query = "SELECT * FROM alerts WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $alert = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if ($alert) {
    Flight::json($alert);
  } else {
    Flight::halt(404, 'Alert not found');
  }
});


// Remove an alert
Flight::route('DELETE /alerts/@id', function($id) {
  $db = Flight::db();
  $query = "DELETE FROM alerts WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  Flight::json(['message' => 'Alert deleted successfully']);
});


Flight::start();


?>