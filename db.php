<?php
include "vendor/autoload.php";
$connectionParams = array(
    'dbname' => 'plus91_proj',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'pdo_mysql',
);

$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);


?>