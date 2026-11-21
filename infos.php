<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Informations Pratiques - Boulangerie du Village</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; line-height: 1.6; background: #fdf5e6; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1 { color: #8B4513; border-bottom: 2px solid #8B4513; padding-bottom: 10px; }
        h2 { color: #A0522D; margin-top: 25px; }
        .info-section { margin-bottom: 20px; }
        .btn-retour { display: inline-block; margin-top: 30px; padding: 10px 20px; background: #8B4513; color: white; text-decoration: none; border-radius: 5px; }
        .map-placeholder { background: #eee; height: 200px; display: flex; align-items: center; justify-content: center; border-radius: 8px; font-style: italic; color: #666; }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

<div class="container">
    <h1>📍 Informations Pratiques</h1>

    <div class="info-section">
        <h2>Où nous trouver ?</h2>
        <p><strong>Boulangerie du Village</strong><br>
        12 rue de la Farine<br>
        75000 Village-sur-Eure</p>
        <div class="map-placeholder">Plan d'accès (Zone de livraison : 10km autour du village)</div>
    </div>

    <div class="info-section">
        <h2>Horaires d'ouverture</h2>
        <ul>
            <li>Lundi - Vendredi : 07h00 - 19h00</li>
            <li>Samedi : 07h00 - 13h00</li>
            <li>Dimanche : Fermé</li>
        </ul>
    </div>

    <div class="info-section">
        <h2>Livraison & Paiement</h2>
        <p><strong>Livraison :</strong> Les commandes sont livrées chaque matin entre 8h00 et 10h00.</p>
        <p> <strong>Paiement :</strong> Pour votre sécurité, nous n'acceptons pas de paiement en ligne. Le règlement s'effectue <strong>uniquement à la livraison</strong> (Espèces ou Ticket Restaurant).</p>
    </div>

    <a href="index.php" class="btn-retour">Retour à l'accueil</a>
</div>

</body>
</html>