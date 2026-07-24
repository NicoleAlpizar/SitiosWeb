<?php include 'db.php'; ?>

<h2>Visitas Domiciliarias</h2>
<form method="POST">
    Estudiante ID: <input type="text" name="estudiante_id"><br>
    Fecha: <input type="date" name="fecha"><br>
    Resultado: <textarea name="resultado"></textarea><br>
    <button type="submit" name="add">Registrar Visita</button>
</form>

<?php
if (isset($_POST['add'])) {
    $sql = "INSERT INTO visita_domiciliaria (IdEstudiante, FechaVisita, Resultado) 
            VALUES ('{$_POST['estudiante_id']}', '{$_POST['fecha']}', '{$_POST['resultado']}')";
    $conn->query($sql);
    echo "✅ Visita registrada";
}

$result = $conn->query("SELECT * FROM visita_domiciliaria");
while ($row = $result->fetch_assoc()) {
    echo $row['IdVisita']." - ".$row['IdEstudiante']." - ".$row['Resultado']."<br>";
}
?>
