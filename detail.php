<?php

//Ce fichier récupère le detail d'un contact

//On verifie la methode utilsée par le client
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        //On récupère et on le nettoie
        $id = strip_tags($_GET['id']);

        //On se connecte à la BDD
        try {
            $db = new PDO('mysql:host=localhost;dbname=ajax', 'root', '');

            //On s'assure que les échanges avec MySQL sont encodés en UTF-8
            $db->exec('SET NAMES "utf8"');
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }

        //On exécute la requete SQL
        $requete = $db->prepare('SELECT * FROM `adresses` WHERE `id` = :id');
        $requete->bindvalue(':id', $id, PDO::PARAM_INT);
        $requete->execute();

        //On récupère les données
        $adresse = $requete->fetch(PDO::FETCH_ASSOC);

        //On envoie les données
        echo json_encode($adresse);
    }
} else {
    //Je ne suis pas en méthode get -> erreur HTTP 405 Method not allowed
    http_response_code(405);
    echo json_encode(['message' => 'La méthode n\'est pas autorisée']);
}
