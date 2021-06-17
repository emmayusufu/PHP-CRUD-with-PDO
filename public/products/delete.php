<?php
/** @var $pdo PDO */
require_once "../../database.php";

$id = isset($_POST['id']) ? $_POST['id'] : null;

if(!$id){
    header('Location index.php');
}

$statement = $pdo->prepare('DELETE FROM products WHERE id = :id');
$statement->bindValue(':id',$id);
$statement->execute();

header('Location: index.php');