# ActuNews

*[English version available here](README.md)*

ActuNews est un site d'actualités consacré à l'astronomie et à l'exploration spatiale, réalisé comme projet fil rouge de ma formation DWWM. L'objectif était de pratiquer un stack complet en partant de zéro : un petit MVC en PHP fait à la main, une base de données MySQL que j'ai conçue moi même, et une interface qui va un peu plus loin qu'une simple liste d'articles, avec une page planétarium interactive.

![Page planétarium d'ActuNews](public/images/screenplanet.jpg)

## Ce que le site propose

Côté public, on peut parcourir les articles publiés, les filtrer par catégorie, et ouvrir une page de détail avec la date, l'auteur et le contenu complet. Il y a un système d'inscription et de connexion basé sur les sessions PHP, et une page « Planétarium » plus expérimentale : un fond étoilé animé en Canvas, une bande de planètes qu'on peut faire défiler et cliquer, une petite fiche qui affiche le type, le diamètre, la masse, la distance au Soleil et le nombre de lunes de chaque planète, une frise qui représente les distances au Soleil à l'échelle, et un bandeau d'anecdotes. Le site est responsive, avec un menu burger qui prend le relais sous 1120px de large.

Une fois connecté en tant qu'admin ou auteur, on accède à un espace d'administration pour créer, modifier et supprimer des articles, uploader une image pour chacun, et leur associer des catégories via une relation many to many. Les admins peuvent en plus gérer les rôles des utilisateurs.

## Comment c'est construit

Il n'y a pas de framework, c'est un petit MVC que j'ai construit moi même : `App\Controllers`, `App\Models`, `App\Views` et `App\Core` (qui regroupe la connexion à la base, le moteur de rendu des vues, la gestion de l'authentification et l'upload d'images). Les identifiants de connexion à la base vivent dans un fichier `.env` chargé avec `vlucas/phpdotenv`, et toutes les requêtes passent par PDO avec des requêtes préparées. Côté front, c'est du JavaScript natif, essentiellement l'API Canvas pour le fond étoilé et de la manipulation du DOM pour le planétarium et les filtres par catégorie, sans framework JS.

**Stack :** PHP 8, MySQL / PDO, Composer, JavaScript natif (API Canvas), HTML5 / CSS3 (Grid, Flexbox), Git.

## Base de données

Le schéma comprend huit tables : `users`, `categories`, `articles`, `article_categories` (la table de liaison entre articles et catégories), `commentary`, `forms`, `planets` et `systems`. Le schéma complet se trouve dans `SQL/bdd.sql`, et `SQL/articles_demo.sql` permet d'ajouter une dizaine d'articles de démonstration si on veut que le site ne soit pas vide au premier lancement.

## Installation en local

Il faut PHP 8, MySQL et Composer. Clone le dépôt, lance `composer install`, puis copie `.env.example` en `.env` et renseigne l'hôte, le nom, l'utilisateur et le mot de passe de ta base. Importe `SQL/bdd.sql` dans MySQL pour créer le schéma, et éventuellement `SQL/articles_demo.sql` pour ajouter des articles de démonstration. Place le projet dans la racine web de ton serveur local (j'utilise XAMPP) et ouvre `public/index.php` dans le navigateur.

## À propos de moi

Je suis Maxime Paulin, développeur web fraîchement titulaire du titre DWWM, et je poursuis actuellement une formation CDA (Concepteur Développeur d'Applications) à l'école CESI. Je suis à la recherche d'une alternance pour l'année prochaine.

[LinkedIn](https://www.linkedin.com/in/maxime-paulin-968ab1266/) · [GitHub](https://github.com/meagle-pixel)
