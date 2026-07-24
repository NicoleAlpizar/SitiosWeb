<?php include 'db.php'; ?>

<h2>Gestión de Becados</h2>
<form method="POST">
    Usuario ID: <input type="text" name="usuario_id"><br>
    Expediente ID: <input type="text" name="expediente_id"><br>
    Monto: <input type="text" name="monto"><br>
    <button type="submit" name="add">Registrar Becado</button>
</form>

<?php
if (isset($_POST['add'])) {
    $sql = "INSERT INTO becados (usuario_id, expediente_id, monto, vigencia_inicio, vigencia_fin) 
            VALUES ('{$_POST['usuario_id']}', '{$_POST['expediente_id']}', '{$_POST['monto']}', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 1 YEAR))";
    $conn->query($sql);
    echo "✅ Becado registrado";
}

$result = $conn->query("SELECT * FROM becados");
while ($row = $result->fetch_assoc()) {
    echo $row['id']." - ".$row['usuario_id']." - ".$row['monto']."<br>";
}
?>
