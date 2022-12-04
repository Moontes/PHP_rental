<?php

function adminExist($conn, $adminName, $adminEmail)
{
    $sql = "SELECT * FROM admins WHERE adminName = ? OR adminEmail = ?;";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../../admin/login.php?error=statement_failed");
        exit();
    }

    mysqli_stmt_bind_param($statement, "ss", $adminName, $adminEmail);
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

function emptyFieldsLogin($adminLogin, $password)
{

    if (empty($adminLogin) || empty($password)) {
        return true;
    }

    return false;
}

function adminLogin($conn, $adminLogin, $password)
{
    $adminExist = adminExist($conn, $adminLogin, $adminLogin);

    if ($adminExist === false) {
        header("location: ../../admin/login.php?error=invalid_credentials");
        exit();
    }


    $hashedPassword = $adminExist["adminPassword"];
    $checkPasswordMatch = password_verify($password, $hashedPassword);

    echo $hashedPassword . '<br>';
    echo password_hash($password, PASSWORD_DEFAULT);



    if ($checkPasswordMatch === false) {
        header("location: ../../admin/login.php?error=invalid_credentials");
        exit();
    } else if ($checkPasswordMatch === true) {
        session_start();
        $_SESSION["adminId"] = $adminExist["adminId"];
        header("location: ../../admin/dashboard.php");
        exit();
    }
}
