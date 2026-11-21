# 🥖 Boulangerie du Village

Site web e-commerce pour une boulangerie : les clients consultent le catalogue, créent un compte et passent commande. Une interface administrateur permet de suivre les livraisons.

## Fonctionnalités
- Inscription et connexion des utilisateurs
- Catalogue de produits dynamique
- Panier d'achat et validation de commande
- Interface administrateur (suivi des livraisons)

## Technologies
PHP 8 · MySQL · HTML5 · CSS3 · JavaScript · Docker · phpMyAdmin


## Installation
1. Lancer Docker Desktop
2. Dans le dossier du projet : `docker compose up -d`
3. Importer `boulangerie_village.sql` via phpMyAdmin
4. Ouvrir http://localhost

## Base de données
Modèle conceptuel et logique : voir `MCD-MLD.docx`.

## Sécurité
- Requêtes préparées contre les injections SQL
- Sessions PHP pour isoler les paniers
- Mots de passe hachés en SHA-256 (amélioration prévue : `password_hash()` / bcrypt)

## Ce que j'ai appris
Conteneurisation avec Docker, modélisation d'une base de données, gestion de sessions en PHP.

## Auteur
Nosayba El Jebli
