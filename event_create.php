<?php
require_once 'db_connect.php';

$ins = "INSERT INTO events (name, start, end, note) VALUES (:name, :start, :end, :note)";

$statement = $db->prepare($ins);

$statement->bindParam(':start', $_POST['start']);
$statement->bindParam(':end', $_POST['end']);
$statement->bindParam(':name', $_POST['name']);
$statement->bindParam(':note', $_POST['note']);

$statement->execute();

class Result {}

$res = new Result();
$res->result = 'OK';
$res->msg = 'Wydarzenie zostało dodane pomyślnie, id: '.$db->lastInsertId();

?>
