<?php
session_start();
$cantidad=$_POST["cantidad"];

if($cantidad > 0)
{
    $_SESSION["cant"]+=$cantidad;
    echo "<br>Articulos comprados ."$_SESSION["cant"];

}

include "comprar.html"
// Se lo robamos a ana lily
?>

