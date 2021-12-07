<?php
//login vorm koodis kirjutatuda kasutajanimega ja parooliga
session_start();
if(isset($_SESSION['tuvastamine'])){
    header('Location:puu.php');
    exit();
}
if(!empty($_POST['login'])&& !empty($_POST['pass'])){
    $login=$_POST['login'];
    $pass=$_POST['pass'];
    if($login=='admin'&& $pass=='1234'){
        $_SESSION['tuvastamine']='niilihtne';
        header('Location:puu.php');
    }
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h1>Login vorm</h1>
<form action="" method="post">
    <input type="text" name="login" placeholder="kasusataja nimi">
    <br>
    Parool:
    <input type="password" name="pass">
    <br>
    <input type="submit" value="Logi sisse">
</form>
</html>


<?php
