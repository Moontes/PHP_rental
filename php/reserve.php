<?php

session_start();

if (!empty($_POST)) {
    $customerID = $_SESSION["customerID"];
    $item_id = $_POST['item'];
    $termin = $_POST['date'];
    $days = $_POST['days'];
    $hours = $_POST['hours'];

    echo $_SESSION["customerID"];

    $today = date('Y-m-d');
    $end_date = date('Y-m-d', strtotime($today . '+ 13 days'));
    if ($termin < $today || $termin > $end_date) {
        die('Niepoprawna data!');
    }
    if ($days < 1 || $days > 13) {
        die('Niepoprawna liczba dni!');
    }
    if ($hours < 0 || $hours > 23) {
        die('niepoprawna liczba godzin!');
    }

    require('functions.php');
    reservation($customerID, $item_id, $termin, $days, $hours);
}
