<?php //wylogowanie
session_start(); //otwiera obecna sesje
$_SESSION = [];
session_destroy(); //zamyka sesje

header("Location: login.php");
