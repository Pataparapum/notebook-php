<?php
  require "database.php";

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["password"])) {
      $error = "Please fill all the fileds.";
    } else if (!str_contains($_POST["email"], "@")) {
      $error = "Email format is incorrect.";
    } else {
      $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
      $statement->bindParam(":email", $_POST["email"]);
      $statement->execute();

      if ($statement->rowCount() > 0) {
        $error = "This email is taken.";
      } else {
        $conn
          ->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)")
          ->execute([
            ":name" => $_POST["name"],
            ":email" => $_POST["email"],
            ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT)
          ]);

          $statement = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
          $statement->bindParam(":email", $_POST["email"]);
          $statement->execute();

          $user = $statement->fetch(PDO::FETCH_ASSOC);

          session_start();
          $_SESSION["user"]= $user;

          header("location: principal.php");
      }
    }
  }
?>

<?php include('partials/header.php')?>

<main id="formain">
  <form class="form-group" id="form" action="register.php" method="POST" > 
    <div class="formulario">

      <div class="formItem mb-3">
        <label for="name" class="form-label">User name</label>
        <input type="text" class="inputform form-control" id="name" name="name">
      </div>

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

    </div>
  </form>




<?php include('partials/footer.php')?>
