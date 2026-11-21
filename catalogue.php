<?php 
// Désactivation de l'affichage des erreurs pour éviter de montrer les chemins du serveur
error_reporting(0);
ini_set('display_errors', 0);

session_start();

// Connexion à la base de données
$servername = "db"; 
$username = "root"; 
$password = "root"; 
$dbname = "boulangerie_village";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die("Erreur de connexion.");
}

$sql = "SELECT * FROM produit";
$result = $conn->query($sql);

// Initialisation du compteur d'images pour la boucle
$compteur_img = 1;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catalogue - Boulangerie du Village</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 20px; background-color: #fdf5e6; }
        h1 { color: #8B4513; text-align: center; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; margin: 20px auto; background: white; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background-color: #8B4513; color: white; }
        .img-catalogue { width: 90px; height: 70px; object-fit: cover; border-radius: 5px; border: 1px solid #eee; }
        .btn-ajouter { background-color: #28a745; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 4px; font-weight: bold; }
        .btn-ajouter:hover { background-color: #218838; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #8B4513; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <h1>🥐 Notre Catalogue Artisanal</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Aperçu</th>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <img src="images/image<?= $compteur_img ?>.jpg" class="img-catalogue" alt="Produit">
                        <?php 
                            $compteur_img++; 
                            if ($compteur_img > 5) $compteur_img = 1; // On repart à la photo 1 après la 5
                        ?>
                    </td>
                    
                    <td><strong><?= htmlspecialchars($row['nom']) ?></strong></td>
                    <td><?= number_format($row['prix'], 2) ?> €</td>
                    <td>
                        <form method="POST" action="ajouter_panier.php">
                            <input type="hidden" name="id_produit" value="<?= $row['id_produit'] ?>">
                            <input type="number" name="quantite" value="1" min="1" style="width:45px; padding: 5px;">
                            <button type="submit" class="btn-ajouter" name="ajouter_panier">Ajouter</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center;">Aucun produit disponible pour le moment.</p>
    <?php endif; ?>
    
    <a href="index.php" class="back-link">← Retour à l'accueil</a>
    
    <?php $conn->close(); ?>
</body>
</html>