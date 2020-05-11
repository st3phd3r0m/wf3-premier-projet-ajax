<?php

//Ce fichier récupère la liste des données

if($_SERVER['REQUEST_METHOD'] == 'GET'){
//On se connecte à la BDD
try{
    $db = new PDO('mysql:host=localhost;dbname=ajax','root','');

    //On s'assure que les échanges avec MySQL sont encodés en UTF-8
    $db->exec('SET NAMES "utf8"');

} catch(PDOException $e){
    echo 'Erreur : '. $e->getMessage();
}

//On exécute la requete SQL
$requete = $db->query('SELECT id, nom, prenom FROM `adresses`');

//On récupère les données
$liste = $requete->fetchAll(PDO::FETCH_ASSOC);

//Convertir les données en JSON
$listeJson = json_encode($liste);

//On envoie les données
echo $listeJson;

}else{
    //Je ne suis pas en méthode get -> erreur HTTP 405 Method not allowed
    http_response_code(405);
    echo json_encode(['message' => 'La méthode n\'est pas autorisée']);
}




