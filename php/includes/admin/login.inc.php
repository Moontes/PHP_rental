<?php 
    
    include '../../admin/sql_connect.php';
    $conn = OpenConnDB();

    if (isset($_POST["submit"])) {

        $adminLogin = $_POST["admin_login"];
        $password = $_POST['password'];

        require_once 'functions.php';

        if(emptyFieldsLogin($adminLogin, $password) !== false) {
            header("location: ../../admin/login.php?error=empty_fields");
            exit();
        }

        adminLogin($conn, $adminLogin, $password);
    }
    else {
        header("location: ../../admin/login.php");
        exit();
    }

    CloseConDB($conn);