<?php

use Dotenv\Dotenv;
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dns = $_ENV['DNS'];
$user = $_ENV['DB_USER'];
$pwd = $_ENV['DB_PWD'];

try{
    $pdo = new PDO($dns, $user, $pwd,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC
    ]);
}catch(PDOException $e){
    echo "ERROR : " . $e->getMessage();
}
return $pdo;

