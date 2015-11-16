<?php

$mysql_host = "localhost";
$database_name = "wp_original_2";
$database_user = "root";
$user_password = "xfopuoxb";
$connection = @mysql_connect ($mysql_host,$database_user, $user_password) or die ("Cannot make the connection");
$db = @mysql_select_db ($database_name,$connection) or die ("Cannot connect to database");
