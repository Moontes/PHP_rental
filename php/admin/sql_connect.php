<?php

function OpenConnDB()
{
	$db_server = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$db_name = 'rental';

	$db_conn = new mysqli($db_server, $db_user, $db_pass, $db_name) or die("Connect failed: %s\n" . $db_conn->error);

	return $db_conn;
}

function CloseConDB($conn)
{
	$conn->close();
}
