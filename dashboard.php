<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit();
}

include('db.php');

// Consulta para mostrar productos
$productos_sql = "SELECT * FROM productos";
$productos_result = $conn->query($productos_sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HikePro Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles2.css">
</head>
<body>
    <div class="wrapper">
        <!-- Barra lateral -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>HikePro Shop</h3>
            </div>
            <ul class="list-unstyled components">
                <p>Bienvenido, <?php echo $_SESSION['admin']; ?></p>
                <li>
                    <br>
                <center>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Gestión de Productos</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="productos.php">Ver Productos</a>
                        </li>
                        <li>
                            <a href="añadir_producto.php">Añadir Producto</a>
                        </li>
                    </ul>
                    </center>
                </li>
                <br>
                <br>
                <center>
                <li>
                    <a href="pedido.php">Pedidos</a>
                </li>
                </center>
                <br>
                <br>
                <center>
                <li>
                    <a href="#">Inventario</a>
                </li>
                <br>
                <br>
                <center>
                <li>
                    <a href="logout.php">Regresar</a>
                </li>
                </center>
            </ul>
        </nav>

        <!-- Contenido de la página -->
        <div id="content">
            <!-- Encabezado -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menú</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>

            <!-- Gestión de productos -->
            <div class="container">
                <h3>Gestión de Productos</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>URL Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($producto = $productos_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $producto['id_producto']; ?></td>
                                <td><?php echo $producto['nombre']; ?></td>
                                <td><?php echo $producto['precio']; ?></td>
                                <td><?php echo $producto['stock']; ?></td>
                                <td><?php echo $producto['imagen']; ?></td>
                                <td>
                                    <a href="editar_producto.php?id=<?php echo $producto['id_producto']; ?>" class="btn btn-warning">Editar</a>
                                    <a href="eliminar_producto.php?id=<?php echo $producto['id_producto']; ?>" class="btn btn-danger">Eliminar</a>
                                    <a href="productos.php?id=<?php echo $producto['id_producto']; ?>" class="btn btn-send" style="background: lightgreen;">Enviar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Formulario para agregar productos -->
                <h4>Agregar Producto</h4>
                <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen del Producto</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" required>
                    </div>
                    <button type="submit" class="btn btn-success">Agregar Producto</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>