<?php


if($_SERVER['REQUEST_METHOD'] === 'POST'){  

    require 'database.php';

    //url parameters uitlezen dan $_GET

    $fouten = [];
    $voornaam = '';
    $achternaam = '';
    $email = '';
    $password = '';

    if(empty($_POST['voornaam'])){
         $fouten['voornaam'] = 'Je voornaam moet ingevuld worden';
    }
    

    if(empty($_POST['achternaam'])){
        $fouten['achternaam'] = 'Je achternaam moet ingevuld worden';
    }

    if(empty($_POST['email'])){
        $fouten['email'] = 'Je email moet ingevuld worden';
    }
    

    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $email = trim($_POST['email']);
        
        $result = mysqli_execute_query($conn, "SELECT email FROM gebruikers WHERE email = ?", [$email]);
        if (mysqli_num_rows($result) > 0) {
            $fouten['email'] = 'Er bestaat al gebruiker met dit emailadres';
        }
    }

    if(empty($_POST['wachtwoord']) || strlen($_POST['wachtwoord']) < 12){
        $fouten['wachtwoord'] =  'Het wachtwoord mag niet leeg zijn en minimaal 12 karakters';
        
    }

    if($_POST['wachtwoord'] != $_POST['wachtwoord_herhaal']){
        $fouten['wachtwoord_ongelijk'] = "De wachtwoorden komen niet overeen met elkaar"; 
    }

    if(count($fouten) === 0){
        $voornaam = trim($_POST['voornaam']); //Geranimo
        $achternaam = trim($_POST['achternaam']); //Koning
        $hash = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
        
        mysqli_execute_query(
            $conn,
            "INSERT INTO gebruikers (voornaam, achternaam, email, wachtwoord) VALUES (?, ?, ?, ?)",
            [$voornaam, $achternaam, $email, $hash]
            );

        header('Location: registreren.php?gelukt=1');
        exit;
            
    }









}

$paginatitel = 'Nieuwe workshop';
require 'header.php';


?>
<?php if (isset($_GET['gelukt'])): ?>
    <p>Je account is aangemaakt!</p>
<?php endif; ?>

<ul>
    <?php 
if(isset($fouten) && count($fouten) > 0){
    foreach($fouten as $fout){
        echo '<li>'. $fout . '</li>';
    }
}
    ?>
</ul>

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
