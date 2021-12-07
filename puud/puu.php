<?php
session_start();
require('conf1.php');

if(!isset($_SESSION['tuvastamine'])){
    header('Location: loginAB.php');
    exit();
}
global $yhendus;
//lisamine INSERT INTO
if(isset($_REQUEST['mudel'])){
    $kask=$yhendus->prepare('INSERT INTO automudel(mudel, mark) 
VALUES(?, ?)');
// "s" - string
// $_REQUEST['loomanimi'] - запрос в текстовом ящике
    $kask->bind_param('ss',$_REQUEST['mudel'], $_REQUEST['mark']);
    $kask->execute();

// изменяет адресную строку
    //$_SERVER[PHP_SELF] - до имени файла
    //header("Location: $_SERVER['PHP_SELF']");
}
// puu kasutamine
if(isset ($_REQUEST['kustuta'])){
    $kask=$yhendus->prepare("DELETE FROM automudel WHERE id=?");
    $kask-> bind_param("i", $_REQUEST['kustuta']);
    $kask-> execute();
}
//puu muutmine
if(isset ($_REQUEST['muuda'])) {
    $kask=$yhendus->prepare("UPDATE automudel SET mudel=?, mark=?, where id=?");
    $kask-> bind_param("ssi",$_REQUEST["nimi"],$_REQUEST[""]);
    $kask-> execute();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>Autoleht</title>
</head>
<body>
<div>
    <p><?=$_SESSION['kasutaja']?> on sisse logitud   </p>
    <form action="logout.php" method="post">
        <input type="submit" value="logi välja" name="logout">
    </form>
</div>
</html>
<div class="leftcolumn">
    <h2>Autod</h2>
    <?php
    global $yhendus;
    $kask=$yhendus->prepare("SELECT ID, mudel from automudel");
    $kask->bind_result($id, $nimi);
    $kask->execute();
    echo "<ul>";
    while($kask->fetch()){
        echo "<li><a href='$_SERVER[PHP_SELF]?id=$id'>".$nimi."</a></li>";
    }
    echo "</ul>";
    echo "<a href='$_SERVER[PHP_SELF]?lisa=jah'>Lisa...</a>";
    if(isset($_REQUEST['lisa'])){
    ?>
    <form action="" method="post">
        <input type="hidden" name="mudelvorm" value="jah">
        <label for="mudel">AutoMudel</label>
        <br>
        <input type="text" name="mudel" id="puunimi">
        <label for="mark">Automark</label>
        <textarea name="mark" id="mark"></textarea>
        <br>
        <input type="submit" value="Lisa">
    </form>
    <?php
    }
    ?>
</div>
<div class="rightcolumn">
    <h3>Auto</h3>
    <?php
    global $yhendus;
    if(isset($_REQUEST['id'])){
    $kask=$yhendus->prepare("SELECT ID, mudel, mark from automudel WHERE ID=?");
    $kask->bind_param("i",$_REQUEST['id']);
    $kask->bind_result($id, $nimi, $pilt);
    $kask->execute();



    if($kask->fetch()){
        if(isset($_REQUEST['muutmine']) && $_SESSION['onAdmin']==1){
            echo '
        <form action="$_REQUEST[PHP_SELF]">
        <input type="hidden" name="muuda" value="$id">
            <h2>Puu andmete muutmine</h2>
        Puunimi:
        <input type="text" name="nimi" value="$nimi">
        <br>
        Pilt(peab olema pildilingi aadress):
        <textarea name="pilt" value="$pilt" cols="20"></textarea>
        <br>
        <input type="submit" value="Muuda">
        </form>
        ';
        } else{




        echo "<strong>".$nimi."</strong>";
        echo "<br>";
        if($_SESSION['onAdmin']==1) {
            echo "<a href='$_SERVER[PHP_SELF]?kustuta=$id'>Kustuta</a>";
            echo "<br>";
            echo "<a href='$_SERVER[PHP_SELF]?id=$id&muutmine=jah'>Muuta</a>";
        }}} else{
        echo "Viga";
    }
}
    $yhendus->close();
    ?>
</div>

</body>
