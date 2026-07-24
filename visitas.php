<?php
include 'db.php';

// Crear visita
if (isset($_POST['add'])) {
    $sql = "INSERT INTO visita_domiciliaria (IdEstudiante, FechaVisita, Resultado) 
            VALUES ('{$_POST['estudiante_id']}', '{$_POST['fecha']}', '{$_POST['resultado']}')";
    $conn->query($sql);
    echo "✅ Visita registrada";
}

// Actualizar visita
if (isset($_POST['update'])) {
    $sql = "UPDATE visita_domiciliaria SET 
            IdEstudiante='{$_POST['estudiante_id']}', 
            FechaVisita='{$_POST['fecha']}', 
            Resultado='{$_POST['resultado']}'
            WHERE IdVisita={$_POST['id']}";
    $conn->query($sql);
    echo "✏️ Visita actualizada";
}

// Eliminar visita
if (isset($_GET['delete'])) {
    $sql = "DELETE FROM visita_domiciliaria WHERE IdVisita={$_GET['delete']}";
    $conn->query($sql);
    echo "🗑️ Visita eliminada";
}
?>

<h2>Visitas Domiciliarias</h2>
<form method="POST">
    Estudiante ID: <input type="text" name="estudiante_id"><br>
    Fecha: <input type="date" name="fecha"><br>
    Resultado: <textarea name="resultado"></textarea><br>
    <button type="submit" name="add">Registrar Visita</button>
</form>

<hr>

<?php
$result = $conn->query("SELECT * FROM visita_domiciliaria");
while ($row = $result->fetch_assoc()) {
    echo $row['IdVisita']." - ".$row['IdEstudiante']." - ".$row['FechaVisita']." - ".$row['Resultado'];
    echo " <a href='visitas.php?edit=".$row['IdVisita']."'>Editar</a>";
    echo " <a href='visitas.php?delete=".$row['IdVisita']."'>Eliminar</a><br>";
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = $conn->query("SELECT * FROM visita_domiciliaria WHERE IdVisita=$id");
    $vis = $res->fetch_assoc();
    ?>
    <h3>Editar Visita</h3>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $vis['IdVisita']; ?>">
        Estudiante ID: <input type="text" name="estudiante_id" value="<?php echo $vis['IdEstudiante']; ?>"><br>
        Fecha: <input type="date" name="fecha" value="<?php echo $vis['FechaVisita']; ?>"><br>
        Resultado: <textarea name="resultado"><?php echo $vis['Resultado']; ?></textarea><br>
        <button type="submit" name="update">Actualizar</button>
    </form>
    <?php
}
?>
