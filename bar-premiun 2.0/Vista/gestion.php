<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Pedidos</title>
    <link rel="stylesheet" href="../Public/Css/GestionPedidos.css">
</head>
<body>
    <header>   
        <div class="avatar-container">
            <img src="../Public/Imagenes/admin.png" alt="Avatar" class="avatar">
            <a href="login.php" class="logout">Cerrar Sesión</a>
        </div>
    </header>
    <main>
        <div class="center-section">
            <h2>Gestión de Pedidos</h2>
            <form action="../Controlador/conGe.php" method="POST">
                <label for="mesa">Mesa:</label>
                <select id="mesa" name="mesa">
                    <option value="mesa1">Mesa 1</option>
                    <option value="mesa2">Mesa 2</option>
                    <option value="mesa3">Mesa 3</option>
                </select>

                <label for="producto">Producto:</label>
                <select id="producto" name="producto" required>
                    <option value="">Seleccione un producto</option>
                    <?php
                    // Obtener la conexión a la base de datos
                    require_once '../Conexion/conexion.php';

                    // Consulta para obtener los productos
                    $sql = "SELECT ID_P, nombre_P FROM producto";
                    $resultado = $conexion->query($sql);

                    // Iterar sobre los resultados y agregar cada producto como una opción
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            $idProducto = $fila["ID_P"];
                            $nombreProducto = $fila["nombre_P"];
                            echo "<option value='$idProducto'>$nombreProducto</option>";
                        }
                    } else {
                        echo "<option value=''>No hay productos disponibles</option>";
                    }
                    ?>
                </select>

                <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" required>
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" min="0.01" step="0.01" required>

                <button type="submit" name="accion" value="agregar">Agregar</button>
                <button type="submit" name="accion" value="delete">Eliminar</button>
                <button type="submit" name="accion" value="update">Actualizar</button>
                
            </form>
        </div>
    <!-- Filas de pedidos aquí -->
    <h2>Lista de Pedidos</h2>
        <table id="tablaPedidos">
            <thead>
                <tr>
                    <th>Mesa</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../Controlador/conGe.php");
                // Aquí puedes incluir el código PHP para obtener y mostrar la lista de pedidos
                $pedidos = obtenerListaPedidos($conexion);
                foreach ($pedidos as $pedido) {
                    echo "<tr class='filaPedido' onclick='seleccionarPedido(this)'>";
                    echo "<td>" . htmlspecialchars($pedido['mesa'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($pedido['producto'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>" . htmlspecialchars($pedido['cantidad'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>$" . htmlspecialchars($pedido['precio'], ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>$" . htmlspecialchars(number_format($pedido['cantidad'] * $pedido['precio'], 2), ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function seleccionarPedido(fila) {
            var mesa = fila.cells[0].innerText;
            var producto = fila.cells[1].innerText;
            var cantidad = fila.cells[2].innerText;
            var precio = fila.cells[3].innerText.substring(1); // Elimina el símbolo de dólar
            document.getElementById('mesa').value = mesa;
            document.getElementById('producto').value = producto;
            document.getElementById('cantidad').value = cantidad;
            document.getElementById('precio').value = precio;
        }
    </script>
</body>
</html>
