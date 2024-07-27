<?php

$host = "localhost";
$database = "note_lite";
$user = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
} catch (PDOException $e) {
  die("PDO Connection Error: " . $e->getMessage());
};
