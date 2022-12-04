<?php 
    
    include '../../admin/sql_connect.php';
    $conn = OpenConnDB();

    if (isset($_POST["submit"])) {

        $customerLogin = $_POST["customer_login"];
        $password = $_POST['password'];

        require_once 'functions.php';

        if(emptyFieldsLogin($customerLogin, $password) !== false) {
            header("location: ../../user/login.php?error=empty_fields");
            exit();
        }

        customerLogin($conn, $customerLogin, $password);
    }
    else {
        header("location: ../../user/login.php");
        exit();
    }

    CloseConDB($conn);