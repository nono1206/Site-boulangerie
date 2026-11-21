<?php 

// On vérifie si le formulaire a été soumis (méthode POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

// Paramètres de connexion à la base de données

$servername ="db";
$username ="root";
$password ="root";
$dbname ="boulangerie_village";

// Création de la connexion à la base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Définition de l'encodage des caractères (accents, etc.)
$conn->set_charset('utf8mb4');

// Vérification si la connexion a échoué
if ($conn->connect_error) {
    die("Echec de la connexion :" . $conn->connect_error);
}

// Récupération et sécurisation des données du formulaire
// real_escape_string protège contre les injections SQL

$nom =$conn->real_escape_string(string: $_POST['nom']);
$prenom =$conn->real_escape_string(string: $_POST['prenom']);
$mail =$conn->real_escape_string(string: $_POST['mail']);
$mdp =$conn->real_escape_string(string: $_POST['mdp']);
$numero =$conn->real_escape_string(string: $_POST['numero']);
$username =$conn->real_escape_string(string: $_POST['username']);


// Bonus : vérification que le numéro contient uniquement des chiffres

if (!preg_match('/^[0-9]+$/', $numero)) {
    die("Erreur : le numero doit contenir uniquement des chiffres.");
}
if(!empty($_POST['mdp']))
    {
        $mdp = hash("sha256",$_POST['mdp']);
    }
// Construction de la requête SQL d'insertion

$sql ="INSERT INTO utilisateurs (nom, prenom , mail, mdp ,username , numero) VALUES ('$nom','$prenom','$mail','$mdp','$username','$numero')";

// Exécution de la requête et affichage du résultat

if ($conn->query($sql) === TRUE) {
    echo "Inscription faite avec succès";
}else {
    echo "Erreur de connexion" .$sql ."<br>" .$conn->error;
}

// Fermeture de la connexion

$conn->close();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
    body {
        font-family: Arial, sans-serif;
        max-width: 600px;
        margin: 50px auto;
        background-color: #f2f2f2;
    }

    h2 {
        color: #4CAF50;
        text-align: center;
    }

    form {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
    }

    input[type="text"], input[type="date"] {
        width: 100%;
        padding: 8px;
        margin: 5px 0 15px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    th {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
    }

    td {
        padding: 8px;
        border: 1px solid #ccc;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
        <title>Inscription</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php include 'header.php'; ?>
        <h2>Saisie des données personnelles</h2>
<form action="<?php echo $_SERVER['PHP_SELF'];?>"method="POST">
    Nom :<input type="text" name="nom" required><br>
    Prénom :<input type="text" name="prenom" required><br>
    mail :<input type="text" name="mail" required><br>
    mdp:<input type="password" name="mdp" id="mdp"required><br>
    username :<input type="text" name="username" required><br>
    numero :<input type="text" name="numero" required><br>
    <input type="submit" value="S'inscrire">







</form>
</body>
</html>