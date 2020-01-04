<?php
  require_once 'db_connect.php';
  $ins = "DELETE FROM events WHERE id = :id";

  $statement = $db->prepare($ins);
  $statement->bindParam(':id', $_POST['id']);
  $statement->execute();

  class Result {}
  $res = new Result();
  $res->result = 'OK';
  $res->message = 'Usunięcie wydarzenia powiodło się';

  header('Content-Type: application/json');
  echo json_encode($res);
?>
