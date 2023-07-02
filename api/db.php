<?php  
error_reporting(E_ALL);
ini_set('display_errors', true);
// Database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'crud_1';

try {
  // Connect to the database using PDO
  $dsn = "mysql:host=$host;dbname=$database;charset=utf8";  
  $conn = new PDO($dsn, $username, $password);
  // Set PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
  // The callback will be passed the object that was constructed
  Flight::register('db', 'PDO', array($dsn,$username,$password),
  function($db){
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
);

} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

?>