<?php
session_start();
ini_set('display_errors', 0); // Cache les chemins d'erreurs PHP [cite: 35]

$servername = "db"; 
$username = "root"; 
$password = "root"; 
$dbname = "boulangerie_village";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $mdp = $_POST['mot_de_pas_saisi'];

    // Utilisation de requêtes préparées (Critère de sécurité n°44) [cite: 44]
    $stmt = $conn->prepare("SELECT id_utilisateur, mot_de_passe, role FROM utilisateur WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Vérification sécurisée du mot de passe 
        if (password_verify($mdp, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id_utilisateur'];
            $_SESSION['role'] = $user['role']; // Pour la page admin [cite: 20]
            header("Location: index.php");
            exit();
        } else {
            $erreur = "Identifiants invalides.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Boulangerie du Village</title>
    <link rel="stylesheet" href="style.css"> <style>
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-container h1 { color: #8B4513; margin-bottom: 20px; }
        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-connexion {
            background: #8B4513;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
        }
        .btn-connexion:hover { background: #5d4037; }
        .error { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

<div class="login-container">
    <h1>🍞 Connexion</h1>
    
    <?php if(isset($erreur)) echo "<p class='error'>$erreur</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Votre Email" required>
        <input type="password" name="mot_de_pas_saisi" placeholder="Votre Mot de passe" required>
        <button type="submit" class="btn-connexion">Se connecter</button>
    </form>
    
    <p style="margin-top:20px;">
        Pas encore de compte ? <a href="inscription.php" style="color:#8B4513;">S'inscrire ici</a>
    </p>
</div>

</body>
</html>