<?php
$conn = mysqli_connect('localhost','data_web','data_web','web_database');
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Récupérer les données du formulaire
$ID_utilisateur = $_POST['ID_utilisateur'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$Mot_de_passe = $_POST['Mot_de_passe'];
$type_utilisateur = $_POST['type_utilisateur'];

// Étape 3 : Valider et nettoyer les données (pour la sécurité, par exemple utiliser mysqli_real_escape_string)
$ID_utilisateur = mysqli_real_escape_string($conn, $ID_utilisateur);
$nom = mysqli_real_escape_string($conn, $nom);
$prenom = mysqli_real_escape_string($conn, $prenom);
$email = mysqli_real_escape_string($conn, $email);
$Mot_de_passe = mysqli_real_escape_string($conn, $Mot_de_passe);
$type_utilisateur = mysqli_real_escape_string($conn, $type_utilisateur);


// Requête SQL pour récupérer les utilisateurs
$sql = "INSERT INTO utilisateur (ID_utilisateur,Nom, Prénom, Email, Mot_de_passe , type_utilisateur) VALUES ('$ID_utilisateur','$nom', '$prenom', '$email', '$Mot_de_passe','$type_utilisateur')";
if (mysqli_query($conn, $sql)) {
    // Étape 5 : Vérifier si l'opération d'insertion a réussi
    echo "Inscription réussie !";

    
    // Exécution de la requête SQL
    //$result = mysqli_query($conn, $sql);
    // Requête SQL pour récupérer les utilisateurs
    $sql_select = 'SELECT * FROM utilisateur';
    // Exécution de la requête SQL
    $result = mysqli_query($conn, $sql_select);

// Vérification si la requête a réussi
if ($result) {
    echo '<table class="utilisateurs-table">';
    // Entête du tableau
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '<th>Email</th>';
    echo '<th>Mot de passe</th>';
    echo '<th>Type Utilisateur</th>';
    echo '</tr>';

// Affichage des données
    while ($ligne = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $ligne['ID_utilisateur'] . '</td>';
        echo '<td>' . $ligne['Nom'] . '</td>';
        echo '<td>' . $ligne['Prénom'] . '</td>';
        echo '<td>' . $ligne['Email'] . '</td>';
        echo '<td>' . $ligne['Mot_de_passe'] . '</td>';
        echo '<td>' . $ligne['type_utilisateur'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
}
} else {
    // Gérer les erreurs
    echo "Erreur lors de l'inscription : " . mysqli_error($conn);
}

// Fermeture de la connexion
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription réussie</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

<div class="container">
    <div class="message">
        <h2>Inscription réussie !</h2>
        <p>Votre inscription a été enregistrée avec succès.</p>
        <p>Vous pouvez maintenant vous connecter avec vos identifiants.</p>
        <a href="connexion.html" class="button">Se connecter</a>
    </div>
</div>

</body>
</html>

