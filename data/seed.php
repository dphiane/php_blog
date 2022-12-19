<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$filename=__DIR__ ."/articles.json";
$data=file_get_contents($filename);
$articles=json_decode($data,true)??[];

$dns = $_ENV['DNS'];
$user = $_ENV['DB_USER'];
$pwd =$_ENV['DB_PWD'];

$pdo = new PDO($dns, $user, $pwd);

$statement = $pdo->prepare('
  INSERT INTO article (
    title,
    category,
    content,
    image
  ) VALUES (
    :title,
    :category,
    :content,
    :image
)');

foreach ($articles as $article) {
    $statement->bindValue(':title', $article['title']);
    $statement->bindValue(':category', $article['category']);
    $statement->bindValue(':content', $article['content']);
    $statement->bindValue(':image', $article['image']);
    $statement->execute();
}