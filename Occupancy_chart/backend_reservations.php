<?php
require_once '_db.php';

$start = $_GET['start'];
$end = $_GET['end'];

$stmt = $db->prepare("SELECT * FROM reservations WHERE 1");
// $stmt->bindParam(':start', $start);
// $stmt->bindParam(':end', $end);
$stmt->execute();
$result = $stmt->fetchAll();

class Event {}
$events = array();

date_default_timezone_set("UTC");
$now = new DateTime("now");
$today = $now->setTime(0, 0, 0);

foreach($result as $row) {
    $e = new Event();
    $e->id = $row['id'];
    $e->text = $row['name'];
    $e->start = $row['start'];
    $e->end = $row['end'];
    $e->resource = $row['room_id'];
    $e->bubbleHtml = "Reservation details: <br/>".$e->text;
    
    // additional properties
    $e->status = $row['status'];
    $e->login_details_id = $row['login_details_id'];
    $events[] = $e;
}

header('Content-Type: application/json');
echo json_encode($events);
?>
