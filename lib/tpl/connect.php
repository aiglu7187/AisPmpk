<?php

/*
session_start();


if(!empty($_POST['enter']))
{


 $host = 'localhost';
    $db   = 'base';
    $user = 'pmpk_user';
    $pass = 'pmpkus_999';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt) or die('hren');


$crypt_passw = hash('whirlpool', $_POST['passw']);

  $stmt = $pdo->prepare('SELECT id_users, login, password, profession, role FROM users WHERE login = ? AND password = ? LIMIT 1') or die('wrong con q');

  $stmt->execute([$_POST['login'], $crypt_passw]) or die('wrong con q2');
  $row = $stmt->fetch(PDO::FETCH_LAZY);
    
        $_SESSION['id'] = $row[0];
        $_SESSION['role'] = $row[4];
        $_SESSION['prof'] = $row[3];

  $stmt = $pdo->prepare('UPDATE users SET login_hash = ? WHERE id_users = ?') or die('wrong con q');
  
  $hash_login = hash('whirlpool', microtime().$crypt_passw);
  
  $stmt->execute([$hash_login, $_SESSION['id']]) or die('wrong con q3');
  
  $_SESSION['hash'] = $hash_login;

}



if(empty($_SESSION['id']) or
   empty($_SESSION['hash']))
{

include('auth.html');
   die();
}
*/

$link = mysqli_connect("localhost","pmpk_user","pmpkus_999","base") or die("Ошибка " . mysqli_error($link));
mysqli_set_charset($link, "utf8");





?>
