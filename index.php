<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier projet AJAX</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container p-5">


        <h1>Premier projet AJAX</h1>
        <button>Cliquez ici</button>
        <div></div>

        <button id="displayAdress">Afficher les adresses</button>
        <div></div>

        <h1>Détails</h1>
        <div></div>

        <h1>Ajouter une adresse</h1>
        <form id="ajoutAdresse">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" class="form-control">
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" class="form-control">
            </div class="form-group">

            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" name="adresse" id="adresse" class="form-control">
            </div>

            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" class="form-control">
            </div class="form-group">

            <div class="form-group">
                <label for="cp">Code Postale :</label>
                <input type="text" name="cp" id="cp" class="form-control">
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone : </label>
                <input type="text" name="telephone" class="form-control">
            </div>

            <button class="btn btn-primary">Ajouter</button>

        </form>
        <a href="tableau.php" type="button" class="btn btn-success">Aller à la liste</a>
    </div>

    <!-- Fichiers JS -->
    <script src="js/script.js"></script>
</body>

</html>