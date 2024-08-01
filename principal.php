<?php
  require "database.php";

  session_start();

  if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    return;
  }

  $notes = $conn->query("SELECT * FROM notes WHERE user_id = {$_SESSION['user']['id']}");
?>

<?php require "partials/header.php" ?>

<main>
  <div class="container-fluid">}
    <div class="row">

      <?php if($notes->rowCount() == 0): ?>
        <div class="col-md-4 mx-auto">
          <div class="card card-body text-center">
            <p>No notes saved yet</p>
            <a href="addnote.php">Add One!</a>
          </div>
        </div>
      <?php endif ?>

      <?php foreach($notes as $note): ?>
        <div class="col-md-4 mb-3">
          <div class="card text-center" style="background-color: #D6D58E;">
            <div class="card-body">
              <h5 class="card-title"><?= $note["title"] ?></h5>
              <h6 class="card-subtitle mb-2 text-body-secondary"><?= $note["date"]?></h6>
              <p class="card-text"><?= $note["content"] ?></p>
              <a href="update.php?id=<?= $note["id"]?>" class="btn btn-secondary mb-2">Modificar nota</a>
              <a href="delete.php?id=<?= $note["id"]?>" class="btn btn-danger mb-2">Borrar nota</a>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>

<?php require "partials/footer.php" ?>
