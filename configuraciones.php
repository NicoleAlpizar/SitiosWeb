<?php
include 'db.php';

// Crear configuración
if (isset($_POST['add'])) {
    $sql = "INSERT INTO configuraciones_sistema (clave, valor, descripcion, categoria) 
            VALUES ('{$_POST['clave']}', '{$_POST['valor']}', '{$_POST['descripcion']}', '{$_POST['categoria']}')";
    $conn->query($sql);
    echo "✅ Configuración guardada";
}

// Actualizar configuración
if (isset($_POST['update'])) {
    $sql = "UPDATE configuraciones_sistema SET 
            clave='{$_POST['clave']}', 
            valor='{$_POST['valor']}', 
            descripcion='{$_POST['descripcion']}', 
            categoria='{$_POST['categoria']}'
            WHERE id={$_POST['id']}";
    $conn->query($sql);
    echo "✏️ Configuración actualizada";
}

// Eliminar configuración
if (isset($_GET['delete'])) {
    $sql = "DELETE FROM configuraciones_sistema WHERE id={$_GET['delete']}";
    $conn->query($sql);
    echo "🗑️ Configuración eliminada";
}
?>

<h2>Configuraciones del Sistema</h2>
<form method="POST">
    Clave: <input type="text" name="clave"><br>
    Valor: <input type="text" name="valor"><br>
    Descripción: <input type="text" name="descripcion"><br>
    Categoría: <input type="text" name="categoria"><br>
    <button type="submit" name="add">Guardar Configuración</button>
</form>

<hr>

<?php
$result = $conn->query("SELECT * FROM configuraciones_sistema");
while ($row = $result->fetch_assoc()) {
    echo $row['id']." - ".$row['clave']." - ".$row['valor']." - ".$row['descripcion']." - ".$row['categoria'];
    echo " <a href='configuraciones.php?edit=".$row['id']."'>Editar</a>";
    echo " <a href='configuraciones.php?delete=".$row['id']."'>Eliminar</a><br>";
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM configuraciones_sistema WHERE id=$id");
    $conf = $res->fetch_assoc();
    ?>
    <h3>Editar Configuración</h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $conf['id']; ?>">
        Clave: <input type="text" name="clave" value="<?php echo $conf['clave']; ?>"><br>
        Valor: <input type="text" name="valor" value="<?php echo $conf['valor']; ?>"><br>
        Descripción: <input type="text" name="descripcion" value="<?php echo $conf['descripcion']; ?>"><br>
        Categoría: <input type="text" name="categoria" value="<?php echo $conf['categoria']; ?>"><br>
        <button type="submit" name="update">Actualizar</button>
    </form>
    <?php
}
