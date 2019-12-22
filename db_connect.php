<?php

$db_exists = file_exists("calendar.db.sqlite");

$db = new PDO('sqlite:calendar.db.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

if (!$db_exists) {
    //create the database
    $db->exec("CREATE TABLE IF NOT EXISTS events (
                        id INTEGER PRIMARY KEY, 
                        name TEXT, 
                        start DATETIME, 
                        end DATETIME,
                        note VARCHAR(30))");

    $msgs = array(
                    array('name' => 'Event 1',
                        'start' => '2019-12-01T00:00:00',
                        'end' => '2019-12-31T05:00:00',
                        'note' => 'N')
                );

    $ins = "INSERT INTO events (name, start, end, note) VALUES (:name, :start, :end, :note)";
    $statement = $db->prepare($ins);
 
    $statement->bindParam(':name', $name);
    $statement->bindParam(':start', $start);
    $statement->bindParam(':end', $end);
    $statement->bindParam(':note', $note);
 
    foreach ($msgs as $m) {
      $name = $m['name'];
      $start = $m['start'];
      $end = $m['end'];
      $note = $m['note'];
      $statement->execute();
    }
}

?>
