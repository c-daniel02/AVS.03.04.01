
<h2>Registrar producto</h2>

<form action="controllers/productoCont.php"
      method="POST"
      enctype="multipart/form-data">

    <input type="hidden" name="accion" value="insertar">

    <label>Nombre del producto:</label>
    <input type="text" name="nombre" maxlength="30" required>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" min="0" required>

    <label>Stock:</label>
    <input type="number" name="stock" min="0" required>

    <label>Categoría:</label>
    <select name="categoria_id" required>
        <option value="">Seleccionar categoría</option>

        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id_categoria'] ?>">
                <?= htmlspecialchars($categoria['descripcion']) ?>
            </option>
        <?php endforeach; ?>

    </select>

    <label>Fotografía del producto:</label>
    <input type="file" name="foto" accept="image/jpeg,image/png,image/webp" required>

    <button type="submit">Guardar producto</button>

    <a href="index.php">Cancelar</a>

</form>
