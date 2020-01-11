<?php

mail('radas666@gmail.com', 'Day Planner Pro', $_POST['msg']);

header('Content-Type: application/json');
echo json_encode($_POST['msg']);

?>