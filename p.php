<!DOCTYPE html>
<html>
<head>
  <title>Navbar Example</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Converter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="crud.php">Users</a>
        </li>
        <?php
          // Retrieve the user tracking data from the cookie
          $userData = isset($_COOKIE['crud-user']) ? json_decode($_COOKIE['crud-user'], true) : [];
          $token = isset($userData['token']) ? $userData['token'] : '';

          if (!$token) {
            echo '
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
              </li>';
          } else {
            echo '
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>';
          }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <div class="navbar-avatar"></div>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</header>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
