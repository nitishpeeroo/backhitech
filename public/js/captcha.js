function reloadCaptcha(element)
{
    //"element" est un lien ou un bouton présent DANS la balise FORM. On recherche le formulaire 
    var form = $(element).closest('form');

    //A partir de là on recherche le champ caché contenant l'identifiant du Captcha
    var input = form.find('input[type=hidden][name=captcha\\[id\\]]');//ici y a bien deux doubles anti-slashes

    //t la valeur du champ ID
    var id = input.val();

    //On va chercher la balise de l'image à recharger. Il est important que l'image ait la classe "captcha_image"
    var img = form.find('.captcha_image');

    //On remplace notre image par une image de chargement
    img.attr('src','/img/loading.gif'); //<< Mettre un petit Gif animé qui va bien mais pas trop gros ni moche ^^

    //Requete ajax vers notre action pour recharger le captcha
    $.ajax({
        url: "/captcha/reloadcaptcha", //<< Ici url à modifier
        data: { id: id }, // << En parametre on ne passe que l'identifiant du captacha
        dataType: 'json' //<< On attend comme résultat un objet Json contenant "url" et "id" pour le captacha
      }).done(function(retour_serveur) {//<< Quand le serveur répond bien

          //On remplace notre image par la nouvelle
          img.attr('src',retour_serveur.url);

          //Et on remplace l'id dans le champ caché par le nouveau
          input.val(retour_serveur.id);
      }).fail(function () { //<< Si on a un bug sur le serveur, théoriquement ca devrait pas arriver
          //On masque le "chargement"
          img.hide();

          //On avertis l'utilisateur
          alert('Impossible de rafraichir le Captcha. Veuillez recharger la page');//<< A voir pour modifier
      });

    return false ; // On retourne FALSE comme ca dans un lien on ne fait pas de redirection
}