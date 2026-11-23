
<h2>Actualizar producto</h2>

<?php if ($productoEditar): ?>

<form action="controllers/productoCont.php"
      method="POST"
      enctype="multipart/form-data">

    <input type="hidden" name="accion" value="actualizar">

    <input type="hidden"
           name="id_producto"
           value="<?= $productoEditar['id_producto'] ?>">

    <label>Nombre del producto:</label>
    <input type="text"
           name="nombre"
           maxlength="30"
           value="<?= htmlspecialchars($productoEditar['nombre']) ?>"
           required>

    <label>Precio:</label>
    <input type="number"
           name="precio"
           step="0.01"
           min="0"
           value="<?= $productoEditar['precio'] ?>"
           required>

    <label>Stock:</label>
    <input type="number"
           name="stock"
           min="0"
           value="<?= $productoEditar['stock'] ?>"
           required>

    <label>Categoría:</label>
    <select name="categoria_id" required>

        <?php foreach ($categorias as $categoria): ?>

            <option
                value="<?= $categoria['id_categoria'] ?>"
                <?= $categoria['id_categoria'] == $productoEditar['categoria_id'] ? 'selected' : '' ?>>

                <?= htmlspecialchars($categoria['descripcion']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <label>Fotografía actual:</label>

    <p>
        <img
            src="uploads/<?= htmlspecialchars($productoEditar['foto_p']) ?>"
            width="100"
            alt="Fotografía actual"
        >
    </p>

    <label>Seleccionar nueva fotografía (opcional):</label>
    <input type="file"
           name="foto"
           accept="image/jpeg,image/png,image/webp">

    <button type="submit">Guardar cambios</button>

    <a href="index.php">Cancelar</a>

</form>

<?php else: ?>

    <p>Producto no encontrado.</p>
    <a href="index.php">Volver al listado</a>

<?php endif; ?>
