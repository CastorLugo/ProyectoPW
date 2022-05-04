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

    try{
        $db="INSERT INTO `pelicula`(`idPelicula`, `nombre`, `idGenero`, `idEstudio`, `idStock`, `precio`) VALUES ( '$IDPELICULA', '$PELICULA', '$IDGENERO', '$IDESTUDIO', '$IDSTOCK', '$PRECIO');";
    $query= "SELECT * FROM producto";
        mysqli_query($db, "SELECT * FROM producto");
        mysqli_query($conexion, $sql);
        mysqli_close($conexion);
    } catch(Exception $C){

        echo "Ocurrio un error $C";
        
    }
    
?>