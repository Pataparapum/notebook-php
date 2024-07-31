<?php
  require "database.php";

  session_start();

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    return;
  }

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["title"]) || empty($_POST["content"])) {
      $error = "Please fill all the fiels.";

    } else {

      $statement = $conn->prepare("INSERT INTO notes(title, date, content, user_id) VALUES (:title, sysdate(), :content, {$_SESSION['user']['id']})");
      $statement->bindParam(":title", $_POST["title"]);
      $statement->bindParam(":content", $_POST["content"]);
      $statement->execute();

      $_SESSION["flash"] = ["message" => "Note {$_POST['title']} added."];

      header("Location: principal.php");
      return;
    }
  }

?>

<?php require "partials/header.php" ?>

<main id="formain">
  <form class="form-group" id="form" action="addnote.php" method="POST" > 
    <div class="formulario">

      <div class="formItem mb-3">
        <label for="title" class="form-label">Note title</label>
        <input type="text" class="inputform form-control" id="title" name="title">
      </div>

      <div class="formItem mb-3">
        <label for="content" class="form-label">contenido</label>
        <textarea class="inputform form-control" name="content" id="content"></textarea>
      </div>

      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-secondary">Crear nota</button>
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

<?php require "partials/footer.php" ?>
