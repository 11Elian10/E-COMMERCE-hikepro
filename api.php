<?php
// Conexión a la base de datos
include 'db.php';

// Verifica el método de la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener todos los productos
    obtenerProductos();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Determina la acción a realizar en función del parámetro 'accion' en la solicitud POST
    $accion = $_POST['accion'];

    switch ($accion) {
        case 'agregar':
            agregarProducto();
            break;
        case 'editar':
            editarProducto();
            break;
        case 'eliminar':
            eliminarProducto();
            break;
        default:
            echo json_encode(['error' => 'Acción no válida']);
    }
} else {
    echo json_encode(['error' => 'Método HTTP no soportado']);
}

// Función para obtener todos los productos
function obtenerProductos() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM productos");
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($productos);
}

// Función para agregar un producto
function agregarProducto() {
    global $pdo;

    // Recibe los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Manejo de la imagen
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'imagenes/';
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $rutaArchivo = $directorio . $nombreArchivo;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
            $imagen = $nombreArchivo;
        }
    }

    // Inserta el producto en la base de datos
    $stmt = $pdo->prepare("INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$nombre, $descripcion, $precio, $imagen])) {
        echo json_encode(['mensaje' => 'Producto agregado con éxito']);
    } else {
        echo json_encode(['error' => 'Error al agregar el producto']);
    }
}

// Función para editar un producto
function editarProducto() {
    global $pdo;

    // Recibe los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    
    // Manejo de la imagen
    $imagen = $_POST['imagen_actual'];
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'imagenes/';
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $rutaArchivo = $directorio . $nombreArchivo;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
            $imagen = $nombreArchivo;
        }
    }

    // Actualiza el producto en la base de datos
    $stmt = $pdo->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?");
    if ($stmt->execute([$nombre, $descripcion, $precio, $imagen, $id])) {
        echo json_encode(['mensaje' => 'Producto actualizado con éxito']);
    } else {
        echo json_encode(['error' => 'Error al actualizar el producto']);
    }
}

// Función para eliminar un producto
function eliminarProducto() {
    global $pdo;

    // Recibe el ID del producto a eliminar
    $id = $_POST['id'];

    // Elimina el producto de la base de datos
    $stmt = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo json_encode(['mensaje' => 'Producto eliminado con éxito']);
    } else {
        echo json_encode(['error' => 'Error al eliminar el producto']);
    }
}
?>
