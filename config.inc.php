<?php

// $con = new mysqli("localhost", "root@localhost", "Hidaya@2023", "ambulance");

// // Check connection
// if ($con->connect_error) {

//     die("Connection failed: " . $con->connect_error);
// }
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

/* Authentication type and info */
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = 'myPassword';
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['AllowNoPassword'] = true;
$cfg['Lang'] = '';
