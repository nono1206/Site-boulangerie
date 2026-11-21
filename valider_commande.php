<?php
session_start();

// 1. Connexion
$conn = new mysqli("db", "root", "root", "boulangerie_village");
$conn->set_charset('utf8mb4');

// 2. Sécurité
if (!isset($_SESSION['user_id']) || empty($_SESSION['panier'])) {
    header("Location: catalogue.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 3. Créer la commande
$stmt = $conn->prepare("INSERT INTO commande (id_utilisateur, date, statut) VALUES (?, NOW(), 'En attente')");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$id_commande = $conn->insert_id;

// 4. Boucle de sécurité (CORRIGÉE)
foreach ($_SESSION['panier'] as $id_p_session => $details) {
    $id_produit_final = (int)$id_p_session; 
    $qte = (int)$details['quantite'];
    $prix = (float)$details['prix'];
    
    // On prépare l'insertion
    $stmt_detail = $conn->prepare("INSERT INTO LigneCommande (id_commande, id_produit, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
    $stmt_detail->bind_param("iiid", $id_commande, $id_produit_final, $qte, $prix);
    
    // AU LIEU DE "DIE", ON FAIT UN "TRY/CATCH" POUR NE PAS BLOQUER
    try {
        $stmt_detail->execute();
    } catch (Exception $e) {
        // Si ce produit pose problème (ID inexistant), on l'ignore et on passe au suivant
        continue;
    }
}

// 5. Vider le panier
unset($_SESSION['panier']);
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Confirmation</title>
    <link rel="stylesheet" href="style.css">

</head>
<body style="text-align:center;padding:50px;font-family:sans-serif;">
    <h1 style="color:green;"> Commande traitée !</h1>
    <p>Commande n°<strong><?= $id_commande ?></strong></p>
    <a href="index.php">Retour accueil</a>
</body>
</html>