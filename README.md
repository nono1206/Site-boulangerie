 DOCUMENTATION TECHNIQUE : BOULANGERIE DU VILLAGE
1. Présentation du Projet
Ce site web a été conçu pour la "Boulangerie du Village" afin de permettre aux clients de consulter les produits et de passer des commandes en ligne. Le système gère l'inscription des utilisateurs, un catalogue dynamique, un panier d'achat et une interface administrateur pour le suivi des livraisons.
2. Architecture et Technologies 
	Environnement : Docker (Virtualisation du serveur et de la base de données).
	Backend : PHP 8.x pour la logique métier et la gestion des sessions.
	Frontend : HTML5, CSS3 et JavaScript pour une interface responsive et thématique.
	Base de données : MySQL  pour le stockage sécurisé.
3. Guide d'Installation 
Pour faire fonctionner le projet localement :
1.	Lancer l'application Docker Desktop.
2.	Ouvrir un terminal dans le dossier racine du projet.
3.	Exécuter la commande suivante :
docker compose up -d 
4.	Importer le fichier fourni boulangerie_village.sql dans la base de données via l'interface de gestion (ex: PHPMyAdmin).
5.	Accéder au site via l'adresse : http://localhost.
4. Sécurité Implémentée 
	Protection SQL : Utilisation systématique de real_escape_string et de requêtes préparées ($stmt->prepare) pour bloquer les injections SQL.
	Mots de passe : Hachage sécurisé des mots de passe en SHA-256 avant stockage en base de données.
	Sessions : Gestion des paniers et des accès via session_start() pour isoler les données de chaque utilisateur.


