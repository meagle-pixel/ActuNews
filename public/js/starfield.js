// Fond "champ d'étoiles" pour la page Planétarium.
// Script autonome (pas de dépendance externe) : dessine des petits points
// blancs à des positions aléatoires sur un <canvas id="starfield"> fixe,
// plein écran, placé derrière le contenu de la page.
(function () {
  "use strict";

  const canvas = document.getElementById("starfield");
  if (!canvas) return;

  const ctx = canvas.getContext("2d");
  const NOMBRE_ETOILES = 150;

  function dessinerEtoiles() {
    // Le canvas prend toute la taille de la fenêtre.
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    // Fond noir.
    ctx.fillStyle = "#000";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Chaque étoile est juste un petit cercle blanc placé au hasard,
    // avec une transparence aléatoire pour varier leur intensité.
    for (let i = 0; i < NOMBRE_ETOILES; i++) {
      const x = Math.random() * canvas.width;
      const y = Math.random() * canvas.height;
      const rayon = Math.random() * 1.5 + 0.5;
      const opacite = Math.random() * 0.7 + 0.3;

      ctx.beginPath();
      ctx.arc(x, y, rayon, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(255, 255, 255, ${opacite})`;
      ctx.fill();
    }
  }

  // On dessine une première fois, puis on redessine si la fenêtre change
  // de taille (sinon le fond serait coupé ou laisserait un vide).
  dessinerEtoiles();
  window.addEventListener("resize", dessinerEtoiles);
})();
