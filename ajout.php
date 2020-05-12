<?php

require_once 'fonctions.php';

//Ce fichier récupère le detail d'un contact

//On verifie la methode utilsée par le client
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // $jsonobj = $_POST['obj'];
    // var_dump(json_decode($jsonobj));    

    $donneesJson = file_get_contents('php://input');
    $donnees = json_decode($donneesJson);
    var_dump($donnees);

    //Afficher le nom de la personne
    // echo $donnees->nom;

    //On traite les données
    if (isFormComplete($donnees) == true) {

        //On se connecte à la BDD
        try {
            $db = new PDO('mysql:host=localhost;dbname=ajax', 'root', '');

            //On s'assure que les échanges avec MySQL sont encodés en UTF-8
            $db->exec('SET NAMES "utf8"');
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }

        //On récupère et on nettoie les donnéees
        $nom = strip_tags($donnees->nom);
        $prenom = strip_tags($donnees->prenom);
        $adresse = strip_tags($donnees->adresse);
        $ville = strip_tags($donnees->ville);
        $cp = strip_tags($donnees->cp);
        $telephone = strip_tags($donnees->telephone);

        //On exécute la requete SQL
        $sql = 'INSERT INTO `adresses` (nom, prenom, adresse, cp, ville, telephone) VALUES (:nom, :prenom, :adresse, :cp, :ville, :telephone);';

        $requete = $db->prepare($sql);

        $requete->bindvalue(':nom', $nom, PDO::PARAM_STR);
        $requete->bindvalue(':prenom', $prenom, PDO::PARAM_STR);
        $requete->bindvalue(':adresse', $adresse, PDO::PARAM_STR);
        $requete->bindvalue(':cp', $cp, PDO::PARAM_STR);
        $requete->bindvalue(':ville', $ville, PDO::PARAM_STR);
        $requete->bindvalue(':telephone', $telephone, PDO::PARAM_STR);

        if ($requete->execute()) {
            http_response_code(201);
            echo json_encode(['message' => 'Adresse créée avec succès.']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Echec de la création.']);
        }

    } else {
        //Le formulaire est incomplet : erreur 400 Bad Request
        http_response_code(400);
        echo json_encode(['message' => 'Le formulaire est incomplet.']);
    }
} else {
    //Je ne suis pas en méthode get -> erreur HTTP 405 Method not allowed
    http_response_code(405);
    echo json_encode(['message' => 'La méthode n\'est pas autorisée']);
}
