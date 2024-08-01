<?php
  require "database.php";

  session_start();

  if(!isset($_SESSION["user"])) {
    header("Location: login.php");
    return;
  }

  $id = $_GET["id"];

  $content = $conn->query("SELECT * FROM notes WHERE id = {$id}");

  $statement = $conn->prepare("SELECT * FROM notes WHERE id = :id LIMIT 1");
  $statement->execute([":id" => $id]);

  if ($statement->rowCount() == 0) {
    http_response_code(404);
    echo("HTTP 404 NOT FOUND");
    return;
  }

  $note = $statement->fetch(PDO::FETCH_ASSOC);

  if ($note["user_id"] !== $_SESSION["user"]["id"]) {
    http_response_code((403));
    echo("HTTP 403 UNAUTHORIZED");
    return;
  }

  $error = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["title"]) || empty($_POST["content"])) {
      $error = "Please fill all the fiels.";

    } else {
      $statement = $conn->prepare("UPDATE notes SET title = :title, content = :content WHERE id = :id LIMIT 1");
      $statement->execute([
        ":id" => $id,
        ":title" => $_POST["title"],
        ":content" => $_POST["content"]
      ]);

      $_SESSION["flash"] = ["message" => "note {$_POST["title"]} updated."];

      header("Location: principal.php");
      return;
    }
  }

?>

<?php require "partials/header.php" ?>

<main id="formain">
  <form class="form-group" id="form" action="update.php?id= <?= $note["id"]?>" method="POST" > 
    <div class="formulario">
      <?php foreach($content as $cont): ?>
        <div class="formItem mb-3">
          <label for="title" class="form-label">Note title</label>
          <input type="text" class="inputform form-control" id="title" name="title" value="<?= $cont["title"]?>">
        </div>
      
        <div class="formItem mb-3">
          <label for="content" class="form-label">contenido</label>
          <textarea class="inputform form-control" name="content" id="content"><?= $cont["content"]?></textarea>
        </div>
      <?php endforeach ?>

      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-secondary">actualizar nota</button>
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
