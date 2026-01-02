<?php

// Source - https://stackoverflow.com/q
// Posted by Abs, modified by community. See post 'Timeline' for change history
// Retrieved 2026-01-03, License - CC BY-SA 4.0

error_reporting(E_ALL);
ini_set('display_errors', 1);

$env = parse_ini_string(file_get_contents(__DIR__.'/.env'));
$SERVER = $env['HOSTNAME'];
$USER = $env['USERNAME'];
$PSWD = $env['PASSWORD'];
$DB = $env['DBNAME'];

$con = mysqli_connect($SERVER, $USER, $PSWD, $DB);


?>