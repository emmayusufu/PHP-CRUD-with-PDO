<?php

$host = '127.0.0.1';
$dbname = 'products_crud';
$user = 'root';
$password = '';
$port = 3306;
$dsn = "mysql:host=$host;port=$port;dbname=$dbname";

$pdo = new PDO($dsn, 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
