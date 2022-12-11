<?php
session_start(); //otwiera aktualna sesje
$_SESSION = [];
session_destroy(); //zamyka sesje=wylogowaniee

header("Location: login.php");
