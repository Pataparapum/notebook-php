<?php
  require "database.php";

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["email"]) || empty($_POST["password"])) {
      $error = "Please fill all the filds.";
    } else if (!str_contains($_POST["email"], "@")) {
      $error = "Email format is incorrect.";

    } else {
      $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
      $statement->bindParam(":email", $_POST["email"]);
      $statement->execute();

      if ($statement->rowCount() == 0) {
        $error = "Invalid credentials.";

      } else {
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($_POST["password"], $user["password"])) {
          $error = "Invalid credentials.";

        } else {
          session_start();

          unset($user["password"]);

          $_SESSION["user"] = $user;

          header("Location: principal.php");
        }
      }
    }
  }
?>

<?php require "partials/header.php" ?>

<main id="formain">
  <form class="form-group" id="form" action="login.php" method="POST" > 
    <div class="formulario">

      <div class="formItem mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="inputform form-control" id="email" name="email">
      </div>

      <div class="formItem mb-3">
        <label for="password" class="form-label">Create a password</label>
        <input type="password" class="inputform form-control" id="password" name="password">
      </div>

      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-secondary">Submit</button>
      </div>

      <?php if($error != null): ?>
        <div class="col-md-6 offset-md-4">
          <p>
            <?= $error ?>
          </p>
        </div>
      <?php endif ?>


<?php require "partials/footer.php" ?>
