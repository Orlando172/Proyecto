<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Productos</title>
    <link rel="stylesheet" href="../Public/Css/producto.css">
    <script>
        function seleccionarProducto(idProducto, nombre, cantidad, sede) {
            document.getElementById('product-id').value = idProducto;
            document.getElementById('nombre_P').value = nombre;
            document.getElementById('cantidad_P').value = cantidad;
            document.getElementById('sede').value = sede;
        }

        function confirmarEliminar() {
            return confirm('¿Estás seguro de que deseas eliminar este producto?');
        }
    </script>
</head>
<body>
    <header>
        <h1>Gestión de Productos</h1>
    </header>
    <main>
        <!-- Formulario para agregar productos -->
        <form action="../Controlador/crud.php" method="POST" class="product-form">
            <input type="hidden" id="product-id" name="ID_P">
            <label for="nombre_P">Nombre:</label>
            <input type="text" id="nombre_P" name="nombre_P" required>
            <br>
            <label for="cantidad_P">Cantidad:</label>
            <input type="number" id="cantidad_P" name="cantidad_P" required>
            <br>
            <label for="sede">Sede:</label>
            <input type="text" id="sede" name="sede" required>
            <br>
            <input type="hidden" name="accion" value="crear">
            <input type="submit" value="Agregar Producto">
        </form>

        <!-- Lista de productos -->
        <h2>Lista de Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Sede</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../Controlador/crud.php";
                $productos = obtenerProductos();
                foreach ($productos as $producto) {
                    echo "<tr onclick=\"seleccionarProducto(" . $producto['ID_P'] . ", '" . htmlspecialchars($producto['nombre_P'], ENT_QUOTES, 'UTF-8') . "', " . $producto['cantidad_P'] . ", '" . htmlspecialchars($producto['Sede'], ENT_QUOTES, 'UTF-8') . "')\">";
                    echo "<td>" . htmlspecialchars($producto['nombre_P'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($producto['cantidad_P'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($producto['Sede'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>
                    <form action='../Controlador/crud.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='ID_P' value='" . $producto['ID_P'] . "'>
                    <input type='hidden' name='nombre_P' value='" . $producto['nombre_P'] . "'>
                    <input type='hidden' name='cantidad_P' value='" . $producto['cantidad_P'] . "'>
                    <input type='hidden' name='Sede' value='" . $producto['Sede'] . "'>
                    <button type='submit' name='accion' value='actualizar'>Actualizar</button>
                </form>
                    </form>
                            <form action='../Controlador/crud.php' method='POST' style='display:inline-block;' onsubmit='return confirmarEliminar()'>
                                <input type='hidden' name='ID_P' value='" . $producto['ID_P'] . "'>
                                <button type='submit' name='accion' value='eliminar'>Eliminar</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="menu.php" class="button">Volver al Menú</a>
    </main>
</body>
</html>
