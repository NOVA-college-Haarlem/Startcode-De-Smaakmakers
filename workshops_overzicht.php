<?php
require 'database.php';

$result = mysqli_query($conn, "SELECT * FROM workshops ORDER BY datum");
$workshops = mysqli_fetch_all($result, MYSQLI_ASSOC);

$paginatitel = 'Workshops beheren';
require 'header.php';
?>

<h1>Workshops beheren</h1>
<p><a href="workshop_create.php" class="knop">Nieuwe workshop</a></p>

<table class="tabel">
    <thead>
        <tr>
            <th>Titel</th>
            <th>Categorie</th>
            <th>Datum</th>
            <th>Prijs</th>
            <th>Vrije plekken</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($workshops as $workshop): ?>
            <tr>
                <td><?php echo htmlspecialchars($workshop['titel']); ?></td>
                <td><?php echo htmlspecialchars($workshop['categorie']); ?></td>
                <td><?php echo date('d-m-Y', strtotime($workshop['datum'])); ?></td>
                <td>€ <?php echo number_format($workshop['prijs'], 2, ',', '.'); ?></td>
                <td><?php echo $workshop['plekken']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'footer.php'; ?>
