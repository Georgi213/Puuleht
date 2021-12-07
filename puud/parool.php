<?php
$parool='adminad';
$sool='vagavagatekst';
$krypt=crypt($parool,$sool);
echo $krypt;
?>