<?php 

function showCustomerReservation() {

    include '../../admin/sql_connect.php';
    $conn = OpenConnDB();

    session_start();

    if (isset($GET)) {

        $customerID = $_SESSION["customerID"];
        
        customerReservation($conn,$customerID);

    }
}