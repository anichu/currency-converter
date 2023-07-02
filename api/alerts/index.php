<?php  
require "../flight/Flight.php";
require "../flight/autoload.php";
require "../db.php";


// Set a new alert for when a currency reaches a specific value
Flight::route('POST /alerts', function() {
  $db = Flight::db();
  $data = Flight::request()->data;
  $currency = $data['currency'];
  $value = $data['value'];
  $email = $data['email'];
  $query = "INSERT INTO alerts (currency, value, email) VALUES (:currency, :value, :email)";
  $stmt = $db->prepare($query);
  $stmt->bindValue(':currency', $currency, PDO::PARAM_STR);
  $stmt->bindValue(':value', $value, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  Flight::json(['message' => 'Alert created successfully']);
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

// Change the values or conditions of an existing alert
Flight::route('PUT /alerts/@id', function($id) {
  $db = Flight::db();
  $data = Flight::request()->data;
  $currency = $data['currency'] ?? null;
  $value = $data['value'] ?? null;

  // Check if none of the values are given
  if (empty($currency) && empty($value)) {
    Flight::json(['message' => 'At least one field is required for update'], 400);
    return;
  }

  $query = "UPDATE alerts SET";
  $params = [];

  if (!empty($currency)) {
    $query .= " currency = :currency,";
    $params[':currency'] = $currency;
  }
  if (!empty($value)) {
    $query .= " value = :value,";
    $params[':value'] = $value;
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