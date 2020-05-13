<?php

require_once 'fonctions.php';

//Ce fichier met à jour une corrdonnées d'un contact


//On verifie la methode utilsée par le client
if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {

    if (isset($_GET['id']) && !empty($_GET['id'])) {

        //On récupère et on nettoie les donnéees
        $id = strip_tags($_GET['id']);
        echo $id;

        //On vérifie que l'id se trouve bien dans la bdd
        $db = connexionBDD();
        //On exécute la requete SQL
        $sql = 'SELECT id FROM `adresses` WHERE id = :id;';
        $requete = $db->prepare($sql);
        $requete->bindvalue(':id', $id, PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetch();

        if (!$result) {
            http_response_code(404);
            echo json_encode(['message' => 'Adresse inexistante']);
            die();
        }

        //On traite les données
        $donneesJson = file_get_contents('php://input');
        $donnees = json_decode($donneesJson, true);

        //On récupère et on nettoie les donnéees en retirant les balises 
        $field = strip_tags(array_key_first($donnees));
        $value = strip_tags(array_values($donnees)[0]);
        //On retire les espaces sur le champ qui va être concaténer dans la requete sql
        $field = str_replace(' ','', $field);

        if (
            isset($field) && !empty($field) &&
            isset($value) && !empty($value)
        ) {
            //On exécute la requete SQL (on est déjà connecté sur la BDD)
            $sql = 'UPDATE `adresses` SET ' . $field . ' = :valeur WHERE id = '.$result['id'];
            $requete = $db->prepare($sql);
            $requete->bindvalue(':valeur', $value, PDO::PARAM_STR);

            if ($requete->execute()) {
                http_response_code(204);
                echo json_encode(['message' => 'Enregistrement modifié']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Echec de la modification']);
            }

            $db = Null;
        }
        
    } else {
        //Bad request
        http_response_code(400);
        echo json_encode(['message' => 'No ID send']);
    }
} else {
    //Je ne suis pas en méthode get -> erreur HTTP 405 Method not allowed
    http_response_code(405);
    echo json_encode(['message' => 'La méthode n\'est pas autorisée']);
}
