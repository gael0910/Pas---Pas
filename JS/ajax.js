document.addEventListener('DOMContentLoaded', function()

{
// requête ajax pour aller chercher les infos en bdd et les afficher en html sans raffraîchir la page lorsque l'on choisit une option de recherche

    let tri = document.querySelector('#tri'); 
    tri.addEventListener('change', recupInfos);

    let div = document.querySelector('#target');
    
function recupInfos()

    {
        fetch( "index.php?route=displayInfosAjax&tri="+ tri.value)
            .then( response => response.text())
            .then(resultat => {
                // let div = document.querySelector('#target')
                div.innerHTML = resultat;
                console.log(resultat);
            });
    }

    

});