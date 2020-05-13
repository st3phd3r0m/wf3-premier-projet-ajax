<?php

//On se connecte à la BDD
try {
    $db = new PDO('mysql:host=localhost;dbname=ajax', 'root', '');

    //On s'assure que les échanges avec MySQL sont encodés en UTF-8
    $db->exec('SET NAMES "utf8"');
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}

//On exécute la requete SQL
$requete = $db->query('SELECT * FROM `adresses`');

//On récupère les données
$adresses = $requete->fetchAll(PDO::FETCH_ASSOC);

//On libère la connexion à la BDD
$db = null;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau éditable des adresses</title>

    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Tableau éditable des adresses</h1>

    <div class="container p-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Code Postal</th>
                    <th scope="col">Ville</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adresses as $adresse) : ?>
                    <tr data-id="<?php echo $adresse['id']; ?>">
                        <td data-field="nom"> <?php echo $adresse['nom']; ?></td>
                        <td data-field="prenom"> <?php echo $adresse['prenom']; ?></td>
                        <td data-field="adresse"> <?php echo $adresse['adresse']; ?></td>
                        <td data-field="cp"> <?php echo $adresse['cp']; ?></td>
                        <td data-field="ville"> <?php echo $adresse['ville']; ?></td>
                        <td data-field="telephone"> <?php echo $adresse['telephone']; ?></td>
                        <td data-delete="true"><a href="#" type="button" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>




    <!-- Fichiers JS -->
    <script src="js/script2.js"></script>
</body>

</html>