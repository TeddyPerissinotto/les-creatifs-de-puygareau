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
/*                                          ANIMATION DU CARROUSEL                                                    */
/**********************************************************************************************************************/

$(document).ready(function(){

    var $carrousel = $('#carrousel'), // on cible le bloc du carrousel
        $img = $('#carrousel img'), // on cible les images contenues dans le carrousel
        indexImg = $img.length - 1, // on définit l'index du dernier élément
        i = 0, // on initialise un compteur
        $currentImg = $img.eq(i); // enfin, on cible l'image courante, qui possède l'index i (0 pour l'instant)

    $img.css('display', 'none'); // on cache les images
    $currentImg.css('display', 'block'); // on affiche seulement l'image courante


    function slideImg(){
        setTimeout(function(){ // on utilise une fonction anonyme

            if(i < indexImg){ // si le compteur est inférieur au dernier index
                i++; // on l'incrémente
            }
            else{ // sinon, on le remet à 0 (première image)
                i = 0;
            }

            $img.css('display', 'none');

            $currentImg = $img.eq(i);
            $currentImg.css('display', 'block');

            slideImg(); // on oublie pas de relancer la fonction à la fin

        }, 4000); // on définit l'intervalle à 4000 millisecondes (4s)
    }

    slideImg(); // enfin, on lance la fonction une première fois

});

$(document).ready(function(){

    //quand on clique sur une image
    $(".imgPopUp").on('click', function(){
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
