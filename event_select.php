<?php
require_once 'db_connect.php';

$statement = $db->prepare('SELECT * FROM events WHERE NOT ((end <= :start) OR (start >= :end))');

$statement->bindParam(':start', $_GET['start']);
$statement->bindParam(':end', $_GET['end']);

$statement->execute();
$result = $statement->fetchAll();

class Event {}
$events = array();

foreach($result as $row) {
  $e = new Event();
  $e->id = $row['id'];
  $e->text = $row['name'];
  $e->start = $row['start'];
  $e->end = $row['end'];
  $e->note = $row['note'];
  $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);

?>
