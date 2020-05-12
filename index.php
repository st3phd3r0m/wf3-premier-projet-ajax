<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier projet AJAX</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1>Premier projet AJAX</h1>
    <button>Cliquez ici</button>
    <div></div>

    <button id="displayAdress">Afficher les adresses</button>
    <div></div>

    <h1>Détails</h1>
    <div></div>

    <h1>Ajouter une adresse</h1>
    <form id="ajoutAdresse">
        <div>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom">
        </div>

        <div>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom">
        </div>

        <div>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse">
        </div>

        <div>
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville">
        </div>

        <div>
            <label for="cp">Code Postale :</label>
            <input type="text" name="cp" id="cp">
        </div>

        <div>
            <label for="telephone">Téléphone : </label>
            <input type="text" name="telephone">
        </div>

        <button>Ajouter</button>

    </form>


    <!-- Fichiers JS -->
    <script src="js/script.js"></script>
</body>

</html>