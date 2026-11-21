<?php
session_start();
$_SESSION['panier'] = [];
echo "<h1> Panier vidé ! <a href='catalogue.php'>→ Boutique</a></h1>";
?>
