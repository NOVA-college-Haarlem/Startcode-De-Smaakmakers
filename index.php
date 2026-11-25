<?php 

$paginatitel = 'De Smaakmakers - Kookworkshops';
require 'header.php';

?>
    <main>
        <section class="hero">
            <h1>Leer koken als een chef</h1>
            <p>Kookworkshops in kleine groepen - voor iedereen die van eten houdt</p>
            <a href="#workshops" class="knop">Bekijk workshops</a>
        </section>

        <section class="container">
            <div id="uitgelicht"></div>
            <h2>Binnenkort</h2>
            <ul id="binnenkort">

            </ul>
        </section>

        <section id="workshops" class="container">
            <h2>Onze workshops</h2>

            <div class="cards">

            </div>
        </section>

        <section id="inschrijven" class="container">
            <h2>Inschrijven</h2>
            <p id="gekozen"></p>

            <form action="verwerk.php" method="post">

                <label for="naam">Naam</label>
                <input type="text" id="naam" name="naam" placeholder="Naam" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="E-mailadres" required>

                <label for="telefoon">Telefoon (optioneel)</label>
                <input type="tel" id="telefoon" name="telefoon" placeholder="bijv. 0612345678">

                <label for="workshop">Workshop</label>
                <select name="workshop" id="workshop">
                    <option value="">-- Kies een workshop --</option>
                </select>

                <label for="aantal">Aantal personen</label>
                <input type="number" name="aantal" id="aantal" value="1" min="1" max="4" required>

                <label for="opmerkingen">Opmerkingen</label>
                <textarea name="opmerking" id="opmerkingen" placeholder="Allergieën of opmerkingen"></textarea>

                <label>Ik ga akkoord met de voorwaarden
                    <input type="checkbox" name="akkoord" id="akkoord" required>
                </label>

                <input type="hidden" name="prijs" id="prijs" value="0">

                <button type="submit">Verstuur</button>
            </form>
        </section>
    </main>

    <footer id="contact">
        <div class="container">
            <p>De Smaakmakers - Pannenlaan 12, Haarlem</p>
            <p>info@desmaakmakers.nl</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>