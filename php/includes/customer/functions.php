<?php


function emptyFieldsRegister($customerName, $customerSurname, $customerEmail, $customerTel, $customerPassword, $customerPassword_repeat)
{
    if (
        empty($customerName) ||
        empty($customerSurname) ||
        empty($customerEmail) ||
        empty($customerTel) ||
        empty($customerPassword) ||
        empty($customerPassword_repeat)
    ) {
        return true;
    }

    return false;
}

function invalidPhone($customerPhone)
{

    $pattern = "/^(?:(?:(?:(?:\+|00)\d{2})?[ -]?(?:(?:\(0?\d{2}\))|(?:0?\d{2})))?[ -]?(?:\d{3}[- ]?\d{2}[- ]?\d{2}|\d{2}[- ]?\d{2}[- ]?\d{3}|\d{7})|(?:(?:(?:\+|00)\d{2})?[ -]?\d{3}[ -]?\d{3}[ -]?\d{3}))$/";
    $isPhoneValid = preg_match($pattern, $customerPhone);

    if ($isPhoneValid == 0) {
        return true;
    }

    return false;
}

function invalidEmail($customerEmail)
{

    if (!filter_var($customerEmail, FILTER_VALIDATE_EMAIL)) {
        return true;
    }

    return false;
}

function passwordMatch($customerPassword, $customerPassword_repeat)
{
    //($customerPassword !== $customerPassword_repeat) ? $result = true : $result = false;
    if ($customerPassword !== $customerPassword_repeat) {
        return true;
    }

    return false;
}

function customerExist($conn, $customerEmail, $customerPhone)
{
    $sql = "SELECT * FROM customers WHERE customerEmail = ? OR customerPhone = ?;";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../../user/register.php?error=statement_failed");
        exit();
    }

    mysqli_stmt_bind_param($statement, "ss", $customerEmail, $customerPhone);
    mysqli_stmt_execute($statement);

    $data = mysqli_stmt_get_result($statement);

    if ($res = mysqli_fetch_assoc($data)) {
        return $res;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($statement);
}

function createUser($conn, $customerName, $customerSurname, $customerEmail, $customerPhone, $customerPassword)
{
    $sql =
        "INSERT INTO customers 
        (customerName, customerSurname, customerEmail, customerPhone, customerPassword) 
        VALUES (?, ?, ?, ?, ?);
        ";

    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../../user/register.php?error=statement_failed");
        exit();
    }

    $hashedPassword = password_hash($customerPassword, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, "sssss", $customerName, $customerSurname, $customerEmail, $customerPhone, $hashedPassword);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../../user/register.php?register_success");
    exit();
}


function emptyFieldsLogin($customerLogin, $password)
{

    if (empty($customerLogin) || empty($password)) {
        return true;
    }

    return false;
}

function customerLogin($conn, $customerLogin, $password)
{
    $customerExist = customerExist($conn, $customerLogin, $customerLogin);

    if ($customerExist === false) {
        header("location: ../../user/login.php?error=invalid_credentials");
        exit();
    }

    $hashedPassword = $customerExist["customerPassword"];
    $checkPasswordMatch = password_verify($password, $hashedPassword);


    if ($checkPasswordMatch === false) {
        header("location: ../../user/login.php?error=invalid_credentials");
        exit();
    } else if ($checkPasswordMatch === true) {
        session_start();
        $_SESSION["customerID"] = $customerExist["customerID"];
        $_SESSION["customerName"] = $customerExist["customerName"];
        header("location: ../../user/dashboard.php");
        exit();
    }
}


function customerReservation($conn, $customerID)
{
    //$sql = "SELECT * FROM reservations WHERE customer_id = ?;";
    $reservation_querry = "SELECT items.name, items.photo_url, reservations.from_date, reservations.to_date, reservations.cost FROM reservations INNER JOIN items ON reservations.item_id = items.id INNER JOIN customers ON customers.customerID = reservations.customer_id WHERE customers.customerID = ?;";
    //$sql2 = "SELECT items.name, items.photo_url, reservations.cost, reservations.to_date FROM reservations WHERE customers.customer_id = ? INNER JOIN items ON reservations.item_id = items.id INNER JOIN customers ON customers.customerID = reservations.customer_id;";

    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $reservation_querry)) {
        header("location: ../../user/dashboard.php?error=statement_failed");
        exit();
    }

    mysqli_stmt_bind_param($statement, "i", $customerID);
    mysqli_stmt_execute($statement);

    $reservations = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);
    return $reservations;
    exit();
}
