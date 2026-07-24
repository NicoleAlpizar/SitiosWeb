<?php
include 'db.php';

// Crear becado
if (isset($_POST['add'])) {
    $sql = "INSERT INTO becados (usuario_id, expediente_id, monto, vigencia_inicio, vigencia_fin) 
            VALUES ('{$_POST['usuario_id']}', '{$_POST['expediente_id']}', '{$_POST['monto']}', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 YEAR))";
    $conn->query($sql);
    echo "✅ Becado registrado";
}

// Actualizar becado
if (isset($_POST['update'])) {
    $sql = "UPDATE becados SET 
            usuario_id='{$_POST['usuario_id']}', 
            expediente_id='{$_POST['expediente_id']}', 
            monto='{$_POST['monto']}'
            WHERE id={$_POST['id']}";
    $conn->query($sql);
    echo "✏️ Becado actualizado";
}

// Eliminar becado
if (isset($_GET['delete'])) {
    $sql = "DELETE FROM becados WHERE id={$_GET['delete']}";
    $conn->query($sql);
    echo "🗑️ Becado eliminado";
}
?>

<h2>Gestión de Becados</h2>
<form method="POST">
    Usuario ID: <input type="text" name="usuario_id"><br>
    Expediente ID: <input type="text" name="expediente_id"><br>
    Monto: <input type="text" name="monto"><br>
    <button type="submit" name="add">Registrar Becado</button>
</form>

<hr>

<?php
$result = $conn->query("SELECT * FROM becados");
while ($row = $result->fetch_assoc()) {
    echo $row['id']." - ".$row['usuario_id']." - ".$row['expediente_id']." - ".$row['monto'];
    echo " <a href='becados.php?edit=".$row['id']."'>Editar</a>";
    echo " <a href='becados.php?delete=".$row['id']."'>Eliminar</a><br>";
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM becados WHERE id=$id");
    $bec = $res->fetch_assoc();
    ?>
    <h3>Editar Becado</h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $bec['id']; ?>">
        Usuario ID: <input type="text" name="usuario_id" value="<?php echo $bec['usuario_id']; ?>"><br>
        Expediente ID: <input type="text" name="expediente_id" value="<?php echo $bec['expediente_id']; ?>"><br>
        Monto: <input type="text" name="monto" value="<?php echo $bec['monto']; ?>"><br>
        <button type="submit" name="update">Actualizar</button>
    </form>
    <?php
}
?>
