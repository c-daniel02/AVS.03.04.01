
<?php

require_once __DIR__ . "/../config/conexion.php";

class Producto {

    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->conectar();
    }

    // Consultar todos los productos
    public function listar() {

        $sql = "SELECT p.*, c.descripcion AS categoria
                FROM productos p
                INNER JOIN categorias c
                ON p.categoria_id = c.id_categoria";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    // Registrar un producto
    public function insertar($nombre, $precio, $stock, $foto, $categoria) {

        $sql = "INSERT INTO productos
                (nombre, precio, stock, foto_p, categoria_id)
                VALUES (?, ?, ?, ?, ?)";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            $nombre,
            $precio,
            $stock,
            $foto,
            $categoria
        ]);
    }

    // Buscar un producto por su ID
    public function obtener($id) {

        $sql = "SELECT * FROM productos
                WHERE id_producto = ?";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute([$id]);

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un producto
    public function actualizar($id, $nombre, $precio, $stock, $foto, $categoria) {

        $sql = "UPDATE productos SET
                nombre = ?,
                precio = ?,
                stock = ?,
                foto_p = ?,
                categoria_id = ?
                WHERE id_producto = ?";

        $consulta = $this->conexion->prepare($sql);

        return $consulta->execute([
            $nombre,
            $precio,
            $stock,
            $foto,
            $categoria,
            $id
        ]);
    }

    // Eliminar un producto
    public function eliminar($id) {

        $sql = "DELETE FROM productos
                WHERE id_producto = ?";

        $consulta = $this->conexion->prepare($sql);
        return $consulta->execute([$id]);
    }

    
    // Consultar las categorías disponibles
    public function listarCategorias() {

        $sql = "SELECT * FROM categorias ORDER BY descripcion";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

}
