<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cinetecolis</title>
    <link rel="stylesheet" href="css/Normalize.css">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.0/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Krub:400,700" rel="stylesheet">
    <link href="css/Styile.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleno.css">
</head>
<body>

    <header class="header">
        <h1 class="titulo"> CineCastix<span> El cine al alcance </span></h1>
    </header>

    <div class=" nav-bg">
        <nav class="navegacion-principal contenedor">
            <div><a href="index.php">Inicio </a></div>
            <div><a href="nosotros.html">Nosotros </a></div>
            <div><a href="peliculas.html">Peliculas </a></div>
            <div><a href="login.php">Iniciar Sesion </a></div>
            <div><a href="#">Carrito </a></div>
        </nav>
    </div>
    </html>   

   
    <?php
    session_start();

    //IMPORTAR LA CONEXION
    require 'includes/database.php';
    $db = conectarDB();
    $idCliente = $_SESSION['idCliente'];

    //CONSULTAS PARA MOSTRAR EN PANTALLA
    if($_SESSION['idCliente']){
        $query = " SELECT carrito.idCliente as idCliente, carritoProducto.idCarrito as idCarrito, carritoProducto.idPelicula as idPelicula, pelicula.nombre as titulo, estudio.nombre as estudio, pelicula.precio as precio, carritoProducto.cantidad as cantidad FROM carritoProducto INNER JOIN carrito ON  carrito.idCarrito = carritoProducto.idCarrito INNER JOIN pelicula ON pelicula.idPelicula = carritoProducto.idPelicula INNER JOIN estudio ON estudio.idEstudio = pelicula.idEstudio WHERE carrito.idCliente = $id_cliente ";

        $resultado = mysqli_query($db, $query);

        $consultaTotal = " SELECT SUM(pelicula.precio * carritoProducto.cantidad) as subtotal FROM carritoProducto INNER JOIN carrito ON  carrito.idCarrito = carritoProducto.idCarrito INNER JOIN pelicula ON pelicula.idPelicula = carritoProducto.idPelicula WHERE idCliente = $id_cliente ";
        
        $resultadoSuma = mysqli_query($db, $consultaTotal);
        $suma = mysqli_fetch_assoc($resultadoSuma);
        $subtotal = $suma['subtotal']; 
    }

    //ELIMINAR PRODUCTO
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        
        $idPelicula = $_POST['idPelicula'];
        $idPelicula = filter_var($idPelicula, FILTER_VALIDATE_INT);
        $idCarrito = $_POST['idCarrito'];
        $idCarrito = filter_var($idCarrito, FILTER_VALIDATE_INT);

        if($idPelicula){
            $eliminarProducto = " DELETE FROM carritoProducto WHERE idPelicula = ${idPelicula} AND idCarrito = ${idCarrito} ";
            $resultadoElim = mysqli_query($db, $eliminarProducto);
        }
        if($resultadoElim){
            header('Location: /carrito.php');
        }
    }

    //INCLUYE UN TEMPLATE
    require 'includes/funciones.php';
   
?>
    <main class="contenedor">

        <?php if($_SESSION['nombre']): ?>
        <h1> ¡Hola <?php echo $_SESSION['nombre']; ?>!</h1>
        <?php endif; ?>
        
        <?php if(!$_SESSION['nombre']): ?>
            <h3>No has iniciado sesión</h3>
            <a href="login.php"><h1>Logueate aquí</h1></a>
            <h1>O</h1> <a href="registro.php"><h1>Registrate aquí</h1></a>
        <?php endif; ?>
        
        <?php if($subtotal): ?>
            <div class="carrito">
                <?php while( $producto = mysqli_fetch_assoc($resultado) ): 
                    $id_carrito = $producto['idCarrito'];?>
                <div class="carrito__producto">
                    
                   <!-- <a href="#">
                        <img class="carrito__imagen" src="/portadas/<?php echo $producto['imagen']; ?>" >
                    </a>-->

                    <div class="carrito__info">
                        <a href="#">
                            <p class="carrito__info--titulo"><?php echo $producto['titulo']; ?></p>
                        </a>
                        <p class="carrito__info--estudio">por <?php echo $producto['estudio']; ?></p>
                        <p class="carrito__info--precio">$ <?php echo $producto['precio']; ?></p>
                        <a class="carrito__info--UD">Cantidad: <?php echo $producto['cantidad']; ?></a>

                        <form method="POST">
                            <input type="hidden" name="idPelicula" value="<?php echo $producto['idPelicula']; ?>">
                            <input type="hidden" name="idCarrito" value="<?php echo $producto['idCarrito']; ?>">
                            <input type="submit" value="Eliminar" class="reset carrito__info--UD"></input>
                        </form>

                    </div>
                </div>
                <?php endwhile; ?>

                <div class="carrito__total">
                    <h2 class="carrito__subtotal">Subtotal: $<?php echo $subtotal; ?> MXN</h2>
                    <a href="/check-out.php?id=<?php echo $idCarrito; ?>" class="boton">Proceder al Pago</a>
                </div>
                        
            </div>
            <?php endif; ?>

            <?php if(!$subtotal): ?>
                <h1 class="carrito__vacio">No Has Agregado nada al Carrito</h1>
            <?php endif; ?>
    </main>

<?php

    //CERRAR LA CONEXIÓN
    mysqli_close($db);

?>
