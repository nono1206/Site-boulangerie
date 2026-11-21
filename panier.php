<?php
session_start();

// 1. PROTECTION : Si pas connecté, on dégage vers la connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

// 2. SUPPRIMER UN ARTICLE
if (isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $id_art = $_GET['id'];
    unset($_SESSION['panier'][$id_art]);
    header("Location: panier.php");
    exit();
}

$total_general = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier - Boulangerie</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 8px; max-width: 800px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #8B4513; color: white; }
        .total { font-size: 1.2em; font-weight: bold; margin-top: 20px; text-align: right; }
        .btn-valider { background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; float: right; }
    </style>
</head>
<body>

<div class="container">
    <h1>🛒 Votre Panier</h1>

    <?php if (empty($_SESSION['panier'])): ?>
        <p>Votre panier est vide. <a href="catalogue.php">Retour au catalogue</a></p>
    <?php else: ?>
        <table>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($_SESSION['panier'] as $id => $item): 
                $sous_total = $item['prix'] * $item['quantite'];
                $total_general += $sous_total;
            ?>
            <tr>
                <td><?= htmlspecialchars($item['nom']) ?></td>
                <td><?= $item['prix'] ?> €</td>
                <td><?= $item['quantite'] ?></td>
                <td><?= $sous_total ?> €</td>
                <td><a href="panier.php?action=supprimer&id=<?= $id ?>" style="color:red;">Supprimer</a></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="total">Total : <?= $total_general ?> €</div>
        <p style="color: #666;">* Le paiement s'effectue à la livraison.</p>
        
        <a href="catalogue.php">⬅ Continuer mes achats</a>
        <a href="valider_commande.php" class="btn-valider">Confirmer la commande</a>
    <?php endif; ?>
</div>

</body>
</html>