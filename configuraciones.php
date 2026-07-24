<?php include 'db.php'; ?>

<h2>Configuraciones del Sistema</h2>
<form method="POST">
    Clave: <input type="text" name="clave"><br>
    Valor: <input type="text" name="valor"><br>
    Descripción: <input type="text" name="descripcion"><br>
    Categoría: <input type="text" name="categoria"><br>
    <button type="submit" name="add">Guardar Configuración</button>
</form>

<?php
if (isset($_POST['add'])) {
    $sql = "INSERT INTO configuraciones_sistema (clave, valor, descripcion, categoria) 
            VALUES ('{$_POST['clave']}', '{$_POST['valor']}', '{$_POST['descripcion']}', '{$_POST['categoria']}')";
    $conn->query($sql);
    echo "✅ Configuración guardada";
}

$result = $conn->query("SELECT * FROM configuraciones_sistema");
while ($row = $result->fetch_assoc()) {
    echo $row['id']." - ".$row['clave']." - ".$row['valor']."<br>";
}
?>
