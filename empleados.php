<?php include 'db.php'; ?>

<h2>Gestión de Empleados</h2>
<form method="POST">
    Nombre: <input type="text" name="nombre"><br>
    Correo: <input type="email" name="correo"><br>
    Puesto: <input type="text" name="puesto"><br>
    <button type="submit" name="add">Registrar Empleado</button>
</form>

<?php
if (isset($_POST['add'])) {
    $sql = "INSERT INTO empleados (Nombre, Correo, Puesto) 
            VALUES ('{$_POST['nombre']}', '{$_POST['correo']}', '{$_POST['puesto']}')";
    $conn->query($sql);
    echo "✅ Empleado registrado";
}

$result = $conn->query("SELECT * FROM empleados");
while ($row = $result->fetch_assoc()) {
    echo $row['IdEmpleado']." - ".$row['Nombre']." - ".$row['Puesto']."<br>";
}
?>
