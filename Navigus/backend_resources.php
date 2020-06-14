<?php
require_once '_db.php';

$scheduler_admins = $db->query('SELECT * FROM admins ORDER BY admin_name');

class Resource {}

$result = array();

foreach($scheduler_admins as $admin) {
  $r = new Resource();
  $r->id = $admin['admin_id'];
  $r->name = $admin['admin_name'];
  $result[] = $r;
}

header('Content-Type: application/json');
echo json_encode($result);

?>
