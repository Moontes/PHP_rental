<?php 
    
    include '../../admin/sql_connect.php';
    $conn = OpenConnDB();

    if(isset($_POST["submit"])) {
        $customerName = $_POST["name"];
        $customerSurname = $_POST["surname"];
        $customerPhone = $_POST["phone"];
        $customerEmail = $_POST["email"];
        $customerPassword = $_POST["password"];
        $customerPassword_repeat = $_POST["password_repeat"];

        require_once 'functions.php';

        if(emptyFieldsRegister($customerName, $customerSurname, $customerEmail, $customerPhone, $customerPassword, $customerPassword_repeat) !== false) {
            header("location: ../../user/register.php?error=empty_fields");
            exit();
        }

        if(invalidPhone($customerPhone) !== false) {
            header("location: ../../user/register.php?error=invalid_phoneNumber");
            exit();
        }

        if(invalidEmail($customerEmail) !== false) {
            header("location: ../../user/register.php?error=invalid_email");
            exit();
        }

        if(passwordMatch($customerPassword, $customerPassword_repeat) !== false) {
            header("location: ../../user/register.php?error=passwords_are_different");
            exit();
        }
        
        if(customerExist($conn, $customerEmail, $customerPhone) !== false) {
            header("location: ../../user/register.php?error=account_already_exist");
            exit();
        }

        createUser($conn, $customerName, $customerSurname, $customerEmail, $customerPhone, $customerPassword);

    }

    else {
        header("location: ../user/register.php");
        exit();
    }

    