<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Boulangerie du Village</title>
    <style>
        /* Styles Généraux */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fdf5e6; /* Couleur crème/farine */
            color: #5d4037; /* Marron foncé pour le texte */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        /* Conteneur principal */
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-top: 8px solid #8B4513; /* Rappel couleur pain cuit */
            max-width: 500px;
            width: 90%;
        }

        h1 {
            color: #8B4513;
            font-size: 2.5em;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        h2 {
            font-weight: 300;
            color: #A0522D;
            margin-bottom: 30px;
        }

        /* Style des liens transformés en boutons */
        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: white;
            background-color: #D2B48C; /* Couleur croûte de pain */
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
            display: block;
        }

        a:hover {
            background-color: #8B4513;
            transform: translateY(-2px);
        }

        /* Lien de déconnexion spécifique */
        .logout {
            background-color: transparent;
            color: #8B4513;
            border: 1px solid #8B4513;
            margin-top: 10px;
        }

        .logout:hover {
            background-color: #fce4ec;
            color: #d81b60;
            border-color: #d81b60;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<h1>Boulangerie du Village</h1>

<?php if (isset($_SESSION['username'])): ?>
    <h2> Bonjour <?= $_SESSION['username'] ?> !</h2>
    <p><a href="catalogue.php">Catalogue</a> | <a href="panier.php">Panier</a></p>
    <p><a href="deconnexion.php">Déconnexion</a></p>

<?php else: ?>
    <p><a href="connexion.php">Se connecter</a> | <a href="inscription.php">S'inscrire</a></p>
<?php endif; ?>
</body>
</html>
