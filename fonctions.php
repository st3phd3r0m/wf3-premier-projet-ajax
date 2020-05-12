<?php

function isFormComplete($dataObj){

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