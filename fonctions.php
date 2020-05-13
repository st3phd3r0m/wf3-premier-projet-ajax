<?php

function isFormComplete($dataObj)
{

    $fields = ['nom', 'prenom', 'adresse', 'ville', 'cp', 'telephone'];
    foreach ($fields as $field) {
        if (
            !isset($dataObj->$field) ||
            empty($dataObj->$field)
        ) {
            return false;
        }
    }
    return true;
}

function connexionBDD()
{
    //On se connecte à la BDD
    try {
        $db = new PDO('mysql:host=localhost;dbname=ajax', 'root', '');

        //On s'assure que les échanges avec MySQL sont encodés en UTF-8
        $db->exec('SET NAMES "utf8"');
        return $db;
    } catch (PDOException $e) {
        echo 'Erreur : ' . $e->getMessage();
        return false;
    }
}
