<?php
$serverinimi='d105611.mysql.zonevs.eu';
$kasutajanimi='d105611_blinov';
$parool='50409250860man';
$andmebaasinimi='d105611_georgi';
$yhendus=new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaasinimi);
$yhendus->set_charset("UTF-8");
/*
CREATE TABLE loomad(id int primary key AUTO_INCREMENT,
nimi varchar(50),
kirjeldus text);
insert INTO loomad(nimi, kirjeldus)
VALUES ('Zebra','Polosatoe zivotnoe');

SELECT * FROM loomad*/
?>

