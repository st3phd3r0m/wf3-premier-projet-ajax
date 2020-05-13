//On attend que le DOM soit chargé
window.onload = () => {
    //ou window.onload = function(){}

    let balisesTD = document.querySelectorAll('td');
    for (baliseTD of balisesTD) {
        baliseTD.addEventListener('click', rendreEditable);
    }

}


/**
 * Cette fonction envoie une requete delete au serveur
 */
function deleteAdresse(numAdresse) {

    if(confirm("Voulez-vous supprimer cette adresse ?")){
        // requete AJAX
        // On instancie XMLHttpRequest
        let xmlhttp = new XMLHttpRequest();

        //On va écouter l'évenement "readystatechange"
        xmlhttp.onreadystatechange = function () {
            // On attend la fin de la requete et la reception d'une reponse
            if (xmlhttp.readyState == 4) {
                //Ici la requete est terminée et on a une reponse
                if (xmlhttp.status == 200) {
                    //Ici on a une reponse
                    document.querySelector('tr[data-id="'+numAdresse+'"]').remove();

                    alert("Suppression effectuée");
                }
            }
        }

        //On ouvre la requête
        xmlhttp.open("DELETE", "delete.php?id=" + numAdresse);
        //On envoie la requete
        xmlhttp.send();
    }else{
        return false;
    }
}


/**
 * Cette fonction rend un élément éditable
 */
function rendreEditable() {

    if (
        this.dataset.delete == "true"
    ) {
        let id = this.parentElement.dataset.id;
        deleteAdresse(id);

    } else if (
        this.dataset.delete == undefined
    ) {
        //On ajoute l'attribut contenteditable sur l'élément appelant
        this.setAttribute("contenteditable", "true");
        //On met le curseur sur l'élément
        this.focus();
        this.addEventListener('blur', miseAJour);
    }
}

/**
 * Cette fonction envoie une requete update au serveur
 */
function miseAJour() {

    this.setAttribute("contenteditable", "false");

    let id = this.parentElement.dataset.id;
    let field = this.dataset.field;

    //On prepare notre objet js
    let donnees = {};
    donnees[field] = this.textContent;
    let donneesJson = JSON.stringify(donnees);

    // requete AJAX
    // On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest();

    //On va écouter l'évenement "readystatechange"
    xmlhttp.onreadystatechange = function () {
        // On attend la fin de la requete et la reception d'une reponse
        if (xmlhttp.readyState == 4) {
            //Ici la requete est terminée et on a une reponse
            if (xmlhttp.status == 204) {
                //Ici on a une reponse
                console.log("Sauvegarde effectuée");
            }
        }
    }

    //On ouvre la requête
    xmlhttp.open("PATCH", "update.php?id=" + id);
    //On envoie la requete
    xmlhttp.send(donneesJson);

}