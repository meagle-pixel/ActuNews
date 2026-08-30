// ********** MENU BURGER **********
const burgerBtn = document.getElementById("burger-toggle");
const siteMenu = document.getElementById("site-menu");

if (burgerBtn && siteMenu) {
  burgerBtn.addEventListener("click", function () {
    const estOuvert = siteMenu.classList.toggle("is-open");
    burgerBtn.classList.toggle("is-open", estOuvert);
    burgerBtn.setAttribute("aria-expanded", estOuvert ? "true" : "false");
  });

  // Referme le menu si on clique sur un lien à l'intérieur.
  siteMenu.querySelectorAll("a").forEach(function (lien) {
    lien.addEventListener("click", function () {
      siteMenu.classList.remove("is-open");
      burgerBtn.classList.remove("is-open");
      burgerBtn.setAttribute("aria-expanded", "false");
    });
  });
}

// ********** FORMULAIRE **********
const form = document.querySelector("form");

if (
  form &&
  !form.classList.contains("form-connexion") &&
  document.getElementById("lastName")
) {
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const lastName = document.getElementById("lastName").value.trim();
    const firstName = document.getElementById("firstName").value.trim();
    const email = document.getElementById("email").value.trim();
    const mobile = document.getElementById("mobile").value.trim();
    const message = document.getElementById("textarea").value.trim();
    const password = document.getElementById("password").value.trim();
    const password2 = document.getElementById("password2").value.trim();

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const mobilePattern = /^[0-9]{10}$/;
    const passwordPattern =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]).{8,}$/;

    let isValid = true;

    if (!lastName) {
      document.getElementById("lastName").classList.add("error");
      isValid = false;
    }

    if (!firstName) {
      document.getElementById("firstName").classList.add("error");
      isValid = false;
    }

    if (!email) {
      document.getElementById("email").classList.add("error");
      isValid = false;
    }

    if (!mobile) {
      document.getElementById("mobile").classList.add("error");
      isValid = false;
    }

    if (!password) {
      document.getElementById("password").classList.add("error");
      isValid = false;
    }

    if (!password2) {
      document.getElementById("password2").classList.add("error");
      isValid = false;
    }

    if (!isValid) {
      showErrorOrSuccess("Veuillez remplir tous les champs obligatoires !");
      return;
    }

    if (!emailPattern.test(email)) {
      document.getElementById("email").classList.add("error");
      showErrorOrSuccess("Veuillez entrer une adresse mail valide");
      return;
    }

    if (mobile && !mobilePattern.test(mobile)) {
      document.getElementById("mobile").classList.add("error");
      showErrorOrSuccess(
        "Votre numéro de téléphone doit contenir des chiffres (1,2,3...)",
      );
      return;
    }

    if (!passwordPattern.test(password)) {
      document.getElementById("password").classList.add("error");
      showErrorOrSuccess(
        "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.",
      );
      return;
    }

    if (password !== password2) {
      document.getElementById("password2").classList.add("error");
      showErrorOrSuccess("Les mots de passe ne correspondent pas !");
      return;
    }

    form.submit();
  });

  // Pour enlever le border bottom rouge
  const inputs = document.querySelectorAll("input, textarea");

  inputs.forEach((input) => {
    input.addEventListener("input", () => {
      input.classList.remove("error");
    });
  });
}

// Mon message d'erreur/succés

function showErrorOrSuccess(msg, type = "error") {
  const formMessage = document.getElementById("form-message");
  const formText = document.getElementById("formText");
  const formIcon = document.getElementById("form-icon");

  // Vérifiez que ces éléments existent aussi
  if (!formMessage || !formText || !formIcon) return;
  formText.textContent = msg;
  formMessage.classList.remove("error", "success");
  formMessage.classList.add(type);

  if (type === "success") {
    formIcon.src = "images/succes.png";
    formIcon.alt = "logo succés";
  } else {
    formIcon.src = "images/traverser.png";
    formIcon.alt = "logo erreur";
  }

  formMessage.style.display = "flex";

  setTimeout(() => {
    formMessage.style.display = "none";
  }, 5000);
}

// PAGE 4 SYSTEME SOLAIRE

const url = `./js/data/planetes.json`;
const containerS = document.getElementById("planetes-system");
const info = document.getElementById("info-planete");
const filtre = document.getElementById("filtre-planetes");
const scrollLeftBtn = document.getElementById("scroll-left");
const scrollRightBtn = document.getElementById("scroll-right");
let planetesData = []; //  Variable globale qui va stocker TOUTES les planètes (vide au début, elle sera remplie après le fetch)

if (containerS && filtre) {
  // Défilement de la piste de planètes : molette verticale convertie en
  // scroll horizontal, et flèches de navigation (on peut aussi toujours
  // faire glisser directement la barre de défilement orange en bas).
  containerS.addEventListener(
    "wheel",
    (e) => {
      if (Math.abs(e.deltaY) <= Math.abs(e.deltaX)) return;

      // Ne capture la molette que si la piste peut encore défiler dans ce
      // sens : sinon on laisse le scroll vertical normal de la page passer
      // (sans ça, la souris posée sur la piste bloquait le scroll de la
      // page une fois arrivé au bout, empêchant de voir le contenu en dessous).
      const maxScroll = containerS.scrollWidth - containerS.clientWidth;
      const atStart = containerS.scrollLeft <= 0;
      const atEnd = containerS.scrollLeft >= maxScroll - 1;
      if ((e.deltaY < 0 && atStart) || (e.deltaY > 0 && atEnd)) return;

      e.preventDefault();
      containerS.scrollLeft += e.deltaY;
    },
    { passive: false },
  );

  function scrollByCard(direction) {
    const card = containerS.querySelector(".art");
    const gap = 40;
    const amount = card ? card.getBoundingClientRect().width + gap : 210;
    containerS.scrollBy({ left: direction * amount, behavior: "smooth" });
  }

  scrollLeftBtn?.addEventListener("click", () => scrollByCard(-1));
  scrollRightBtn?.addEventListener("click", () => scrollByCard(1));

  // Ouvre la modale avec l'image et les infos de la planète cliquée
  function openPlanetModal(p) {
    info.innerHTML = `
      <div class="planet-modal__overlay" id="planet-modal-overlay"></div>
      <div class="planet-modal__content" role="dialog" aria-modal="true">
        <button id="close-info" class="planet-modal__close" aria-label="Fermer">&times;</button>
        <img src="${p.img}" alt="${p.nom}" class="planet-modal__img" style="--planet-zoom: ${p.zoom || 1};">
        <div class="planet-modal__info">
          <h2>${p.nom}</h2>
          <p><strong>Type :</strong> ${p.type}</p>
          <p>Diamètre : ${p.diametre_km.toLocaleString("fr-FR")} km</p>
          <p>Masse : ${p.masse_kg} kg</p>
          <p>Distance Soleil : ${p.distance_au_soleil_km.toLocaleString(
            "fr-FR",
          )} km</p>
          <p>Lune(s) : ${p.lunes}</p>
        </div>
      </div>
    `;

    document.getElementById("close-info").addEventListener("click", closePlanetModal);
    document.getElementById("planet-modal-overlay").addEventListener("click", closePlanetModal);
  }

  // Ferme la modale (il suffit de vider le conteneur, voir #info-planete:empty en CSS)
  function closePlanetModal() {
    info.innerHTML = "";
  }

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closePlanetModal();
  });

  //  Fonction qui prend en paramètre une liste de planètes à afficher (peut être toutes les planètes ou seulement les filtrées)
  function renderPlanetes(planetesAAfficher) {
    containerS.innerHTML = "";

    planetesAAfficher.forEach((p) => {
      const article = document.createElement("article");
      article.classList.add("art");
      article.innerHTML = `
      <div class="planet-img">
        <img src="${p.img}" alt="${p.nom}" style="--planet-zoom: ${p.zoom || 1};">
      </div>
      <p class="nom-planete">${p.nom}</p>
    `;

      // Gestion du clic pour les détails : ouvre la modale
      article.addEventListener("click", () => openPlanetModal(p));

      containerS.appendChild(article);
    });
  }

  // GESTION DU FILTRE

  filtre.addEventListener("change", (e) => {
    let filteredList;
    if (e.target.value === "all") {
      filteredList = planetesData;
    } else if (e.target.value === "lunes") {
      filteredList = planetesData.filter((p) => p.lunes > 0);
    } else if (e.target.value === "tellurique") {
      filteredList = planetesData.filter((p) => p.type === "Tellurique");
    } else if (e.target.value === "gazeuse") {
      filteredList = planetesData.filter((p) => p.type === "Géante gazeuse");
    } else if (e.target.value === "glace") {
      filteredList = planetesData.filter((p) => p.type === "Géante de glace");
    }

    renderPlanetes(filteredList);
  });

  // Frise d'échelle : place les planètes le long d'une ligne, régulièrement
  // espacées dans leur ordre (de Mercure à Neptune). Ce n'est pas à la vraie
  // échelle des distances (Neptune est en réalité ~78 fois plus loin que
  // Mercure, ça écraserait tout à droite), mais ça reste simple à lire.
  function renderEchelleSysteme(planetes) {
    const track = document.getElementById("solar-scale-track");
    if (!track) return;

    planetes.forEach((p, i) => {
      const pos = 4 + (i / (planetes.length - 1)) * 92; // % le long de la frise

      const marker = document.createElement("div");
      marker.className = "scale-marker" + (i % 2 === 1 ? " alt" : "");
      marker.style.setProperty("--pos", `${pos}%`);
      marker.style.background = p.couleur || "var(--color-primary)";
      marker.style.color = p.couleur || "var(--color-primary)";
      marker.style.boxShadow = `0 0 8px 2px ${p.couleur || "rgba(255,255,255,0.4)"}`;

      const ua = (p.distance_au_soleil_km / 149600000).toFixed(2).replace(".", ",");
      marker.innerHTML = `<span class="scale-label">${p.nom}<small>${ua} UA</small></span>`;

      track.appendChild(marker);
    });
  }

  // Bandeau "Le saviez-vous ?" : un fait par planète, tiré de planetes.json.
  function renderFunFacts(planetes) {
    const grid = document.getElementById("fun-facts-grid");
    if (!grid) return;

    planetes.forEach((p) => {
      if (!p.fait) return;

      const card = document.createElement("div");
      card.className = "fact-card";
      card.innerHTML = `
        <span class="fact-card__dot" style="background:${p.couleur || "var(--color-primary)"}; color:${p.couleur || "var(--color-primary)"}"></span>
        <h3>${p.nom}</h3>
        <p>${p.fait}</p>
      `;
      grid.appendChild(card);
    });
  }

  async function chargerDonnees() {
    try {
      const response = await fetch(url);
      const data = await response.json();
      planetesData = data.planetes; // On remplit notre variable globale

      renderPlanetes(planetesData); // Premier affichage (toutes les planètes)
      renderEchelleSysteme(planetesData); // Toujours les 8 planètes, indépendant du filtre
      renderFunFacts(planetesData);
    } catch (error) {
      console.error("Erreur lors du chargement :", error);
    }
  }
  chargerDonnees();
}

// Page "Nos articles"

// DOMcontentLoaded garantit que le code ne s'exécute qu'une fois que toute la page est chargée.

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#create_article textarea').forEach(textarea => {
        // Déclenche le redimensionnement au chargement
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';

        // Et à chaque frappe
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
});
// Permet de modifier automatiquement le textarea, de sorte à ce qu'on puisse voir tout le texte saisi.
