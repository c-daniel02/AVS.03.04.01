
<?php

require_once __DIR__ . "/../models/Producto.php";

$producto = new Producto();

$accion = $_POST["accion"] ?? "";

function regresar($mensaje) {
    header("Location: ../index.php?mensaje=" . urlencode($mensaje));
    exit;
}

// Registrar producto
if ($accion == "insertar") {

    $nombre = trim($_POST["nombre"]);
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $categoria = $_POST["categoria_id"];

    if (!isset($_FILES["foto"]) || $_FILES["foto"]["error"] != 0) {
        regresar("Debes seleccionar una fotografía");
    }

    $tipo = mime_content_type($_FILES["foto"]["tmp_name"]);

    $tiposPermitidos = ["image/jpeg", "image/png", "image/webp"];

    if (!in_array($tipo, $tiposPermitidos)) {
        regresar("Formato de imagen no permitido");
    }

    $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $foto = uniqid("producto_") . "." . strtolower($extension);

    $ruta = __DIR__ . "/../uploads/" . $foto;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta)) {

        $producto->insertar(
            $nombre,
            $precio,
            $stock,
            $foto,
            $categoria
        );

        regresar("Producto registrado correctamente");

    } else {
        regresar("No se pudo guardar la fotografía");
    }
}

// Actualizar producto
if ($accion == "actualizar") {

    $id = $_POST["id_producto"];
    $nombre = trim($_POST["nombre"]);
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $categoria = $_POST["categoria_id"];

    $actual = $producto->obtener($id);

    if (!$actual) {
        regresar("Producto no encontrado");
    }

    $foto = $actual["foto_p"];

    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {

        $tipo = mime_content_type($_FILES["foto"]["tmp_name"]);
        $tiposPermitidos = ["image/jpeg", "image/png", "image/webp"];

        if (!in_array($tipo, $tiposPermitidos)) {
            regresar("Formato de imagen no permitido");
        }

        $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $nuevaFoto = uniqid("producto_") . "." . strtolower($extension);

        $ruta = __DIR__ . "/../uploads/" . $nuevaFoto;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta)) {

            if (file_exists(__DIR__ . "/../uploads/" . $foto)) {
                unlink(__DIR__ . "/../uploads/" . $foto);
            }

            $foto = $nuevaFoto;
        }
    }

    $producto->actualizar(
        $id,
        $nombre,
        $precio,
        $stock,
        $foto,
        $categoria
    );

    regresar("Producto actualizado correctamente");
}

// Eliminar producto
if ($accion == "eliminar") {

    $id = $_POST["id_producto"];

    $actual = $producto->obtener($id);

    if ($actual) {

        if ($producto->eliminar($id)) {

            $ruta = __DIR__ . "/../uploads/" . $actual["foto_p"];

            if (file_exists($ruta)) {
                unlink($ruta);
            }

            regresar("Producto eliminado correctamente");
        }
    }

    regresar("No se pudo eliminar el producto");
}

regresar("Acción no válida");

?>
