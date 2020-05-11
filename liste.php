<?php

//Ce fichier récupère la liste des données

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


