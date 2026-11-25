// Klik op "Schrijf je in" bij een workshop: kies die workshop in het formulier

//DRY: DONT REPEAT YOURSELF
function formatPrijs(prijs) {
  return `€ ${prijs.toFixed(2).replace(".", ",")}`;
}

const binnenkort = [
  "Dim sum maken",
  "Franse patisserie",
  "Mexicaanse streetfood",
  "Pizza's bakken",
];

//loop door de array binnenkort om zo een lijst te maken met de binnen-kort-workshops
binnenkort.forEach(function (titel) {
  const li = document.createElement("li");
  li.textContent = titel;
  document.querySelector("#binnenkort").appendChild(li);
  li.classList.add("binnenkort-item");
});

//de huidige workshops in een array
const currentWorkshops = [
  "Verse pasta maken",
  "Sushi voor beginners",
  "Brood bakken",
  "Vegetarisch kerstdiner",
  "Thaise curry's",
  "Taarten en gebak",
  "Vegan borrelhapjes",
];

//loop door de huidige workshops en toon ze in een dropdown in het formulier
currentWorkshops.forEach(function (titel, index) {
  const option = document.createElement("option");
  option.textContent = titel;
  option.value = index + 1;
  document.querySelector("#workshop").appendChild(option);
});

//schrijf de gekozen workshop naar het scherm in een Nederlandse zin.
function kiesWorkshop(workshop) {
  document.querySelector("#workshop").value = workshop.id;
  document.querySelector("#gekozen").textContent =
    `Je hebt gekozen: ${workshop.titel} op ${workshop.datum} (${formatPrijs(workshop.prijs)} p.p.).`;
}

//functie om een kaart te maken. Dynamisch en afhankelij van het object workshop
function maakCard(workshop) {
  let plekkenTekst = `Nog ${workshop.plekken} plekken`;
  if (workshop.plekken === 0) {
    plekkenTekst = "Vol!";
  }

  return `
                <article class="card">
                    <h3>${workshop.titel}</h3>
                    <p class="categorie">${workshop.categorie}</p>
                    <p>${workshop.datum}</p>
                    <p class="prijs">${formatPrijs(workshop.prijs)}</p>
                    <p>${plekkenTekst}</p>
                    <a href="#inschrijven" class="knop">Schrijf je in</a>
                </article>
            `;
}

//Toon de huidige workshops als card op het scherm en maak van elke knop een klikbare link
function toonWorkshops(lijst) {
  const container = document.querySelector(".cards");
  container.innerHTML = "";

  lijst.forEach(function (workshop) {
    container.innerHTML += maakCard(workshop);
  });

  // Pas NA het maken van alle cards de knoppen koppelen
  container.querySelectorAll(".card a").forEach(function (knop, index) {
    knop.addEventListener("click", function () {
      kiesWorkshop(lijst[index]);
    });
  });
}

let workshops = [];

//haal alle workshops op vanuit de data/workshops.json file
async function laadWorkshops() {
  const response = await fetch("data/workshops.json");
  workshops = await response.json();
  toonWorkshops(workshops);
}

laadWorkshops();
