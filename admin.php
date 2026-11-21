<?php
session_start();
$servername="db"; $username="root"; $password="root"; $dbname="boulangerie_village";
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset('utf8mb4');

// 1. TRAITEMENT : MODIFIER STATUT COMMANDE
if (isset($_POST['modifier_statut'])){
    $id_commande = $_POST['id'];
    $nouveau_statut = $_POST['statut'];
    $stmt = $conn->prepare("UPDATE commande SET statut = ? WHERE id_commande = ?");
    $stmt->bind_param("si", $nouveau_statut, $id_commande);
    $stmt->execute();
    header("Location: admin.php"); exit();
}

// 2. TRAITEMENT : AJOUTER UN PRODUIT AU CATALOGUE
if (isset($_POST['ajouter_produit'])){
    $nom = $_POST['nom'];
    $desc = $_POST['description'];
    $prix = $_POST['prix'];
    $cat = $_POST['id_categorie'];
    $photo = "default.jpg"; // Par défaut pour aller vite

    $stmt = $conn->prepare("INSERT INTO produit (nom, description, prix, id_categorie, photo) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $nom, $desc, $prix, $cat, $photo);
    $stmt->execute();
    header("Location: admin.php"); exit();
}

$commandes = $conn->query("SELECT * FROM commande ORDER BY id_commande DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Boulangerie</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f4f4; }
        .section { background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #8B4513; color: white; }
        .form-ajout input, .form-ajout textarea { display: block; margin-bottom: 10px; width: 100%; padding: 8px; }
        h2 { color: #8B4513; border-bottom: 2px solid #8B4513; padding-bottom: 5px; }
    </style>
</head>
<body>

    <h1>Espace Administrateur</h1>

    <div class="section">
        <h2>🍞 Ajouter un produit au catalogue</h2>
        <form method="POST" class="form-ajout">
            <input type="text" name="nom" placeholder="Nom du produit (ex: Baguette Tradition)" required>
            <textarea name="description" placeholder="Description..."></textarea>
            <input type="number" step="0.01" name="prix" placeholder="Prix (ex: 1.20)" required>
            <input type="number" name="id_categorie" placeholder="ID Catégorie (1=Pain, 2=Viennoiserie...)" required>
            <button type="submit" name="ajouter_produit" style="background:#28a745; color:white; padding:10px; border:none; cursor:pointer;">Ajouter au catalogue</button>
        </form>
    </div>

    <div class="section">
        <h2>📦 Gestion des Commandes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Client</th>
                <th>Statut</th>
            </tr>
            <?php while($row = $commandes->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_commande'] ?></td> 
                <td><?= $row['date'] ?></td>
                <td><?= $row['id_utilisateur'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $row['id_commande'] ?>">
                        <select name="statut" onchange="this.form.submit()">
                            <option value="En attente" <?= $row['statut'] == 'En attente' ? 'selected' : '' ?>>En attente</option>
                            <option value="Prête" <?= $row['statut'] == 'Prête' ? 'selected' : '' ?>>Prête</option>
                            <option value="Livrée" <?= $row['statut'] == 'Livrée' ? 'selected' : '' ?>>Livrée</option>
                        </select>
                        <input type="hidden" name="modifier_statut" value="1">
                    </form>
                </td>
            </tr>
            <?php endwhile; ?> 
        </table>
    </div>

</body>
</html>