/**********************************************************************************************************************/
/*                                          ANIMATION DE LA NAVBAR                                                    */
/**********************************************************************************************************************/

$(document).ready(function() {

    $('#clickMenu').click(function () {
        $('.slideMenu').slideToggle();
    })
});

/**********************************************************************************************************************/
/*                                        ANIMATION DE LA NAVBAR ADMIN                                                */
/**********************************************************************************************************************/

$(document).ready(function () {
    $('#clickButtonAdmin').click(function () {
        $('.navAdmin').toggle();
    })
});

/**********************************************************************************************************************/
/*                                        ANIMATION BOUTON RETOUR EN HAUT                                             */
/**********************************************************************************************************************/

$(document).ready(function () {

    $(window).scroll(function () {
        if ($(this).scrollTop() < 800) {
            $("#clickButtonTop").fadeOut();
        } else {
            $("#clickButtonTop").fadeIn();
        }
    })
});

/**********************************************************************************************************************/
/*                                       SECURITE FRONT BARRE DE RECHERCHE                                            */
/**********************************************************************************************************************/



//Je clique sur un élément avec la classe de mon bouton
$('.searchSubmit').click(function(){
    //Je fais mpon traitement sur mes valeurs de formulaire
    var texte = $('.searchBar').val();
    var characterReg = /^\s*[a-zA-Z0-9,\s]+\s*$/;
    //Je lance ma condition qui retourne false si un caractère spécial a été soumis dans mon formulaire
    if(!characterReg.test(texte)) {
        alert("Caractères spéciaux interdits : " + texte);
        return false;
    }
});

/**********************************************************************************************************************/
/*                                  ANIMATION POPUP DES IMAGES DE PRODUITS                                            */
/**********************************************************************************************************************/

$(document).ready(function(){

    //quand on clique sur une image
    $(".imgPop").on('click', function(){
        //affichage de la modal en modifiant le css de la modal
        $(".modalArticle").css("display", "block");

        //ajout de la source de l'image dans le contenu de la modal en fonction de la source de l'image cliquée
        //le $(this) fait reference a l'img qui a été cliquée
        $("#imgSelected").attr("src", $(this).attr("src"));
    });

    //si on clique sur le bouton, on ferme la modal en modifiant le css
    $(".closeModal").on("click", function(){
        $(".modalArticle").css("display", "none");
    });

});
