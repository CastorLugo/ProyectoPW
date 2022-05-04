<?php

require '../includes/database.php';
    $db = conectarDB();
    session_start();

    $IDPELICULA=$_POST['idPelicula'];
    $PELICULA=$_POST['nombre'];
    $IDGENERO=$_POST['idGenero'];
    $IDESTUDIO=$_POST['idEstudio'];
    $IDSTOCK=$_POST['idStock'];
    $PRECIO=$_POST['precio'];
    include 'alta.php';
    echo '<br>';

    try{
        
        $query="INSERT INTO pelicula(idPelicula,nombre,idGenero,idEstudio,idStock,precio) VALUES ( '$IDPELICULA', '$PELICULA','$IDGENERO', '$IDESTUDIO',  '$IDSTOCK', '$PRECIO');";
    
        mysqli_query($db, "SELECT * FROM pelicula");
    //   mysqli_query($db, "set FOREIGN_KEY_CHECKS = 0;");
        mysqli_query($db, $query);
        mysqli_close($db);
    } catch(Exception $C){

        echo "Ocurrio un error $C";
        
    }
    
    require '../includes/funciones.php';
?>