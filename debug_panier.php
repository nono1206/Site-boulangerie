<?php
session_start();
echo "<h2> PRODUITS DANS TON PANIER :</h2>";
if (isset($_SESSION['panier'])) {
    echo "<pre>";
    foreach ($_SESSION['panier'] as $id => $produit) {
        echo "ID PRODUIT : $id<br>";
    }
    echo "</pre>";
    echo "<a href='reset_panier.php'>Vider panier</a>";
} else {
    echo "Panier vide";
}
?>
