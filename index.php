<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "models/Producto.php";

$producto = new Producto();

$vista = $_GET["vista"] ?? "lista";

$productos = $producto->listar();
$categorias = $producto->listarCategorias();

$mensaje = $_GET["mensaje"] ?? "";

$productoEditar = null;

if ($vista == "editar" && isset($_GET["id"])) {
    $productoEditar = $producto->obtener($_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de productos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

    <header>
        <h1>Gestión de productos</h1>

        <nav>
            <a href="index.php">Productos</a>
            <a href="index.php?vista=insertar">Agregar producto</a>
        </nav>
    </header>

    <main>

        <?php if ($mensaje != ""): ?>
            <p class="mensaje">
                <?= htmlspecialchars($mensaje) ?>
            </p>
        <?php endif; ?>

        <?php

        if ($vista == "insertar") {

            include "views/productoInsertar.php";

        } elseif ($vista == "editar" && $productoEditar) {

            include "views/productoEditar.php";

        } else {

            include "views/productoLista.php";

        }

        ?>

    </main>

    <footer>
        <p>Práctica AVS.03.04.01 :D</p>
    </footer>

</body>

</html>
