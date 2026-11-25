<?php


if($_SERVER['REQUEST_METHOD'] === 'POST'){  

    require 'database.php';

    //url parameters uitlezen dan $_GET

    $voornaam = '';

    if(!empty($_POST['voornaam'])){
        $voornaam = trim($_POST['voornaam']); //Geranimo
    }



}

$paginatitel = 'Nieuwe workshop';
require 'header.php';
?>

<h1>Registreren</h1>

<form method="post" class="formulier">
    <div class="veld">
        <label for="voornaam">Voornaam</label>
        <input type="text" name="voornaam" id="voornaam" autocomplete="given-name">
    </div>
    <div class="veld">
        <label for="achternaam">Achternaam</label>
        <input type="text" name="achternaam" id="achternaam">
    </div>
    <div class="veld">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div class="veld">
        <label for="wachtwoord">Wachtwoord</label>
        <input type="password" name="wachtwoord" id="wachtwoord">
    </div>
    <div class="veld">
        <label for="wachtwoord_herhaal">Wachtwoor Herhaal</label>
        <input type="password" name="wachtwoord_herhaal" id="wachtwoord_herhaal">
    </div>
    <button type="submit" class="verstuur">Registreer!</button>
</form>

<?php require 'footer.php'; ?>
