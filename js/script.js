//On attend que le DOM soit chargé
window.onload = () => {
    //ou window.onload = function(){}

    //On selectionne la balise button
    let bouton = document.querySelector('button:first-of-type');

    //On met un écouteur d'évenements 'click sur le bouton
    bouton.addEventListener('click', getText);


    //On selectionne la balise button
    let bouton2 = document.querySelector('button:nth-of-type(2)');

    //On met un écouteur d'évenements 'click sur le bouton
    bouton2.addEventListener('click', getListe);

}

/**
 * Cette fonction va chercher le texte dans texte.php et l'inclut dans la div
 */
function getText() {

    //On va faire une requete AJAX
    //On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest();

    // console.log(xmlhttp);

    //On va écouter l'évenement "readystatechange"
    xmlhttp.onreadystatechange = function () {
        // console.log(xmlhttp.readyState);
        // On attend la fin de la requete et la reception d'une reponse
        if (xmlhttp.readyState == 4) {

            //Ici la requete est terminée et on a une reponse
            //Le stat est -il 200?
            // console.log(xmlhttp.status);
            if (xmlhttp.status == 200) {
                //Ici on a une reponse
                // console.log(xmlhttp.response);
                let div = document.querySelector('div:first-of-type');

                //On injecte le texte
                div.innerText = xmlhttp.response;
            }
        }
    }

    console.log('avant open');
    //On ouvre la requête
    xmlhttp.open("GET", "texte.php");

    console.log('entre open et send')
    //On envoie la requete
    xmlhttp.send();

    console.log('après send')
}


/**
 * Cette fonction va chercher la liste dans liste.php et l'inclut dans la div
 */
function getListe() {

    //On va faire une requete AJAX
    //On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest();

    //On va écouter l'évenement "readystatechange"
    xmlhttp.onreadystatechange = function () {
        // On attend la fin de la requete et la reception d'une reponse
        if (xmlhttp.readyState == 4) {

            //Ici la requete est terminée et on a une reponse

            if (xmlhttp.status == 200) { //Le status est-il 200?
                //Ici on a une reponse
                // console.log(xmlhttp.response);
                let div = document.querySelector('div:nth-of-type(2)');
                div.innerHTML = '';

                let adresses = JSON.parse(xmlhttp.response);

                for (let adresse of adresses) {
                    div.innerHTML += `<p>${adresse.prenom} ${adresse.nom} <a href="#">Voir le detail</a></p>`;

                    //On selectionne la balise button
                    let lien = document.querySelector(`a[href="#"]`);

                    //On met un écouteur d'évenements 'click sur le bouton
                    lien.addEventListener('click', getDetail);
                }

            }
        }
    }

    //On ouvre la requête
    xmlhttp.open("GET", "liste.php");
    //On envoie la requete
    xmlhttp.send();

}

function getDetail() {

    //On va faire une requete AJAX
    //On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest();

    //On va écouter l'évenement "readystatechange"
    xmlhttp.onreadystatechange = function () {
        // On attend la fin de la requete et la reception d'une reponse
        if (xmlhttp.readyState == 4) {

            //Ici la requete est terminée et on a une reponse

            if (xmlhttp.status == 200) { //Le status est-il 200?
                //Ici on a une reponse
                // console.log(xmlhttp.response);
                let div = document.querySelector('div:nth-of-type(3)');
                div.innerHTML = '';

                let adresses = JSON.parse(xmlhttp.response);
                console.log(adresses);

                for (let adresse of adresses) {

                    div.innerHTML += `<p>${adresse.prenom}</p>`;
                    div.innerHTML += `<p>${adresse.nom}</p>`;
                    div.innerHTML += `<p>${adresse.adresse}</p>`;
                    div.innerHTML += `<p>${adresse.cp}</p>`;
                    div.innerHTML += `<p>${adresse.ville}</p>`;
                    div.innerHTML += `<p>${adresse.telephone}</p>`;

                }

            }
        }
    }

    //On ouvre la requête
    xmlhttp.open("GET", "detail.php");
    //On envoie la requete
    xmlhttp.send();
}