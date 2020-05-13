//On attend que le DOM soit chargé
window.onload = () => {
    //ou window.onload = function(){}

    //On selectionne la balise button
    let bouton = document.querySelector('button:first-of-type');

    //On met un écouteur d'évenements 'click sur le bouton
    bouton.addEventListener('click', getText);

    //On selectionne la balise button
    let boutonAdresses = document.querySelector('button:nth-of-type(2)');
    //On met un écouteur d'évenements 'click sur le bouton
    boutonAdresses.addEventListener('click', getListe);

    //On selectionne la balise button
    let boutonSubmit = document.querySelector('form');
    //On met un écouteur d'évenements 'click sur le bouton
    boutonSubmit.addEventListener('submit', pickAdress);
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

    // console.log('avant open');
    //On ouvre la requête
    xmlhttp.open("GET", "texte.php");

    // console.log('entre open et send')
    //On envoie la requete
    xmlhttp.send();

    // console.log('après send')
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
                    div.innerHTML += `<p>${adresse.prenom} ${adresse.nom} <a href="#" data-id="${adresse.id}">Voir le detail</a></p>`;
                }

                //On selectionne la balise button
                let liens = document.querySelectorAll("a");

                //On boucle sur les balises a et on leur affecte un écouteur d'evenement 'click'
                for (let lien of liens) {
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

/**
 * Cette fonction interroge la page detail.php en demandant un id.
 * Ensuite, les infos sont affichées dans la div.
 */
function getDetail() {
    // let id = this.getAttribute('data-id');
    let id = this.dataset.id;

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

                let adresse = JSON.parse(xmlhttp.response);

                div.innerHTML = `<p> Nom : ${adresse.nom}</p>` +
                    `<p> Prénom : ${adresse.prenom}</p>` +
                    `<p> Adresse : ${adresse.adresse}</p>` +
                    `<p> Code Postal : ${adresse.cp}</p>` +
                    `<p> Ville : ${adresse.ville}</p>` +
                    `<p> Téléphone : ${adresse.telephone}</p>`;
            }
        }
    }

    //On ouvre la requête
    xmlhttp.open("GET", "detail.php?id=" + id);
    //On envoie la requete
    xmlhttp.send();
}

/**
 * Cette fonction qui récupère les infos du formulaire et les traite
 */
function pickAdress(event) {
    event.preventDefault();

    let donnees = new FormData(this);

    let entrees = donnees.entries();

    let objet = Object.fromEntries(entrees);

    let donneesJson = JSON.stringify(objet);
    
    //On va faire une requete AJAX
    //On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest();

    //On traite la requete
        xmlhttp.onreadystatechange = () => {
            // On attend la fin de la requete et la reception d'une reponse
            if (xmlhttp.readyState == 4) {
                //Ici la requete est terminée et on a une reponse
    
                if (xmlhttp.status == 201) { //Le status est-il 201?
                    //Ici on a une reponse, l'ajout est un succès

                    //On affiche la liste des adresses
                    getListe();

                    //On vide le formulaire
                    event.target.reset();

                }
            }
        }

    //On ouvre la requête
    xmlhttp.open("POST", "ajout.php");
    //On envoie la requete
    xmlhttp.send(donneesJson);
}