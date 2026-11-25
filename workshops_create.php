<?php

require 'database.php';

$categorieen = ['Italiaans', 'Aziatisch', 'Bakken', 'Vegetarisch'];

$fouten    = [];
$titel     = '';
$categorie = '';
$datum     = '';
$prijs     = '';
$plekken   = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){  
    $titel     = trim($_POST['titel'] ?? ''); //null coalencing operator
    $categorie = $_POST['categorie'] ?? '';
    $datum     = $_POST['datum'] ?? '';
    $prijs     = $_POST['prijs'] ?? '';
    $plekken   = $_POST['plekken'] ?? '';

    if (strlen($titel) < 3 || strlen($titel) > 100) {
        $fouten['titel'] = 'De titel moet tussen de 3 en 100 tekens lang zijn.';
    }

    //validatie op categories
    if(!in_array($categorie, $categorieen) ){
        $fouten['categorie'] = 'De categorie moet wel in de array/database staan';
    }

    $datumObject = DateTime::createFromFormat('Y-m-d', $datum);
    if (!$datumObject || $datumObject->format('Y-m-d') !== $datum) {
        $fouten['datum'] = 'Vul een geldige datum in.';
    } elseif ($datum < date('Y-m-d')) {
        $fouten['datum'] = 'De datum mag niet in het verleden liggen.';
    }

    if(!is_numeric($prijs) || $prijs < 0 || $prijs > 500){ //hier mogen comma-getallen
        $fouten['prijs'] = "Vul een getal in tussen de 0 en 500";
    }

    if(!ctype_digit($plekken) || $plekken >=1 || $plekken >=20){ //alleen integers
        $fouten['plekken'] = "Vul een geheel getal in!";
    }

    if (count($fouten) === 0) {
        mysqli_execute_query(
            $conn,
            "INSERT INTO workshops (titel, categorie, datum, prijs, plekken) VALUES (?, ?, ?, ?, ?)",
            [$titel, $categorie, $datum, $prijs, $plekken]
        );

        header('Location: workshops_overzicht.php');
        exit;
    }

    
}





$paginatitel = 'Nieuwe workshop';
require 'header.php';
?>

<h1>Nieuwe workshop</h1>

<form method="post" class="formulier">
    <div class="veld">
        <label for="titel">Titel</label>
        <input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($titel); ?>" required>
        <?php if (isset($fouten['titel'])): ?>
            <p class="fout"><?php echo $fouten['titel']; ?></p>
        <?php endif; ?>

    </div>

    <div class="veld">
        <label for="categorie">Categorie</label>
        <select id="categorie" name="categorie" required>
            <option value="">-- Kies een categorie --</option>
            <option value="Italiaans">Italiaans</option>
            <option value="Aziatisch">Aziatisch</option>
            <option value="Bakken">Bakken</option>
            <option value="Vegetarisch">Vegetarisch</option>
        </select>
    </div>

    <div class="veld">
        <label for="datum">Datum</label>
        <input type="date" id="datum" name="datum" required>
    </div>

    <div class="veld">
        <label for="prijs">Prijs per persoon (€)</label>
        <input type="number" id="prijs" name="prijs" step="0.01" min="0" required>
    </div>

    <div class="veld">
        <label for="plekken">Aantal plekken</label>
        <input type="number" id="plekken" name="plekken" min="1" required>
    </div>

    <button type="submit" class="verstuur">Workshop opslaan</button>
</form>

<?php require 'footer.php'; ?>
