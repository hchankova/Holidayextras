<?php
//Connection Database
function getConnection() {
    $dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
    $dbname = "holidayextras";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}