<?php  
ob_start(); // Start output buffering
require('./header.php');

if (isset($_GET['logout'])) {
  // Perform logout actions here
  // For example, you can clear session data, destroy the session, or redirect to a logout page
  // Set the cookie expiration date to the past
  $cookieExpiration = time() - 3600; // Subtract 1 hour (or any desired time) from the current time
  // Set the cookie with the past expiration date
  setcookie('crud-user', '', $cookieExpiration, '/');
  header("Location: index.php");
  // Redirect to a logout page
}

?>


<div class="my-3">
  <form action="logout.php" method="get">
    <button type="submit" name="logout" class="btn btn-primary btn-sm">logout</button>
  </form>
</div>

<?php  

require('./footer.php');

?>