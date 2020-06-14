<?php
$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$database = "Asministration";

$db = new PDO("mysql:host=$host;port=$port",
               $username,
               $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// other init
date_default_timezone_set("Asia/Kolkata");
session_start();

$db->exec("CREATE DATABASE IF NOT EXISTS `$database`");
$db->exec("use `$database`");

function tableExists($dbh, $id)
{
    $results = $dbh->query("SHOW TABLES LIKE '$id'");
    if(!$results) {
        return false;
    }
    if($results->rowCount() > 0) {
        return true;
    }
    return false;
}

$exists = tableExists($db, "admins");

if (!$exists) {
    //create the database
    $db->exec("CREATE TABLE admins (
    admin_id   INTEGER       PRIMARY KEY AUTO_INCREMENT NOT NULL,
    admin_name VARCHAR (100) NOT NULL
    );");

    $db->exec("CREATE TABLE appointment (
    appointment_id              INTEGER       PRIMARY KEY AUTO_INCREMENT NOT NULL,
    appointment_start           DATETIME      NOT NULL,
    appointment_end             DATETIME      NOT NULL,
    appointment_user_name    VARCHAR (100),
    appointment_status          VARCHAR (100) DEFAULT 'free' NOT NULL,
    appointment_user_session VARCHAR (100),
    admin_id                   INTEGER       NOT NULL
    );");

    $items = array(
        array('name' => 'Admin 1'),
        array('name' => 'Admin 2'),
        array('name' => 'Admin 3'),
        array('name' => 'Admin 4'),
        array('name' => 'Admin 5'),
    );
    $insert = "INSERT INTO admins (admin_name) VALUES (:name)";
    $stmt = $db->prepare($insert);
    $stmt->bindParam(':name', $name);
    foreach ($items as $m) {
      $name = $m['name'];
      $stmt->execute();
    }

}
