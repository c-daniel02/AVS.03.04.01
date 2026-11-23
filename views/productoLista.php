
<h2>Productos registrados</h2>

<a href="index.php?vista=insertar">Agregar nuevo producto</a>

<?php if (count($productos) > 0): ?>

    <table>
        <thead>
            <tr>
                <th>Fotografía</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($productos as $p): ?>

                <tr>
                    <td>
                        <img
                            src="uploads/<?= htmlspecialchars($p['foto_p']) ?>"
                            alt="Fotografía del producto"
                            width="70"
                        >
                    </td>

                    <td><?= htmlspecialchars($p['nombre']) ?></td>

                    <td>$<?= number_format($p['precio'], 2) ?></td>

                    <td><?= htmlspecialchars($p['stock']) ?></td>

                    <td><?= htmlspecialchars($p['categoria']) ?></td>

                    <td>
                        <a href="index.php?vista=editar&id=<?= $p['id_producto'] ?>">
                            Editar
                        </a>

                        <form action="controllers/productoCont.php"
                              method="POST"
                              onsubmit="return confirm('¿Deseas eliminar este producto?');">

                            <input type="hidden" name="accion" value="eliminar">

                            <input type="hidden"
                                   name="id_producto"
                                   value="<?= $p['id_producto'] ?>">

                            <button type="submit">Eliminar</button>

                        </form>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

<?php else: ?>

    <p>No hay productos registrados.</p>

<?php endif; ?>
