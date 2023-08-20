<?php

if(isset($_GET['id'])){

  try{
    $dsn = 'mysql:dbname=ju77gc3juk2vmicb;host=ao9moanwus0rjiex.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306;charset=utf8mb4';
    $user = 'qbrs2xf1erynr15v';
    $password = 'u4fk7ldeijqon15p';

$pdo = new PDO($dsn, $user, $password);

$sql = 'DELETE FROM books WHERE id = :id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

$stmt->execute();

$count = $stmt->rowCount();
$message = "{$count}件を<span style='color:red'>削除</span>しました。";


header("Location: read.php?message={$message}");

  } catch (PDOexception $e){
    exit($e->getMessage());
  }
} else {
  NULL;
}