<?php

require_once 'fonctions.php';

//Ce fichier met à jour une corrdonnées d'un contact

//On verifie la methode utilsée par le client
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        //On récupère et on nettoie les donnéees
        $id = strip_tags($_GET['id']);

        //Avec DELETE, il n'est pas néssécaire de vérifier que l'id se trouve dans la bdd
        $db = connexionBDD();

        //On exécute la requete SQL (on est déjà connecté sur la BDD)
        $sql = 'DELETE FROM `adresses` WHERE id = :id;';
        $requete = $db->prepare($sql);
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $requete->rowCount();

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Requête de suppression traitée avec succès.']);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Echec de la suppression.']);
        }

        $db = Null;

    } else {
        //Bad request
        http_response_code(400);
        echo json_encode(['message' => 'No ID received']);
    }
} else {
    //Je ne suis pas en méthode get -> erreur HTTP 405 Method not allowed
    http_response_code(405);
    echo json_encode(['message' => 'La méthode n\'est pas autorisée']);
}
