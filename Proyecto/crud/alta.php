<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de productos</title>
</head>

<body>
    <h2>Registrar los productos</h2>
    <form action="altaAgregar.php" method="post">
        <p>ID</p>
        <input type="number" name="idPelicula" id="idPelicula">
        <p>Nombre</p>
        <input type="text" name="nombre" id="nombre">
        <p>Genero</p>
        <input type="text" name="idGenero" id="idGenero">
        <p>Estudio</p>
        <input type="text" name="idEstudio" id="idEstudio">
        <p>Stock</p>
        <input type="number" name="idStock" id="idStock">
        <p>Precio</p>
        <input type="number" name="precio" id="precio"> 
        <input type="submit" value="Añadir">


    </form>

    <p>Desea hacer cambios en algun producto? <a href="cambioProducto.php">Click aqui</a></p>
    <p>o quieres eliminar un producto?, entonces da clic <a href="eliminaProducto.php">AQUI</a></p>
    
</body>