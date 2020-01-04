<?php
  require_once 'db_connect.php';
  $ins = "UPDATE events SET start = :start, end = :end WHERE id = :id";

  $statement = $db->prepare($ins);
  $statement->bindParam(':start', $_POST['newStart']);
  $statement->bindParam(':end', $_POST['newEnd']);
  $statement->bindParam(':id', $_POST['id']);
  $statement->execute();

  class Result {}
  $res = new Result();
  $res->result = 'OK';
  $res->msg = 'Wydarzenie zaktualizowano pomyślnie';

  header('Content-Type: application/json');
  echo json_encode($res);
?>
