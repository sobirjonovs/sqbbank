<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "database/DatabaseInterface.php";
require_once "database/Database.php";
require_once "database/Currency.php";

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode([
        'message' => "Other method is not supported"
    ]);
} else {
    $currency = new \Database\Currency();
    if (in_array('valute', array_flip($_GET)) && in_array('from', array_flip($_GET)) && in_array('to', array_flip($_GET))) {
        $sql = "SELECT * FROM currencies WHERE (valuteID = ?) AND (`date` BETWEEN ? AND ?) ORDER BY `date` ASC";
        $stmt = $currency->prepare($sql);
        $stmt->execute([$_GET['valute'], $_GET['from'], $_GET['to']]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
        echo json_encode(['Parameters is exceed']);
    }
}
