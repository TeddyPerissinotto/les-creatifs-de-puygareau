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
        if ($(this).scrollTop() > 800) {
            $("#clickButtonTop").fadeIn();
        } else {
            $("#clickButtonTop").fadeOut();
        }
    });

    $(function(){
        $("#clickButtonTop").click(function(event){
            $("html, body").animate({scrollTop: 0},"fast");
            return false;
        });

    });

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
    //quand on clique sur une image//
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

$(document).ready(function(){
    //quand on clique sur une image//
    $(".imgPopNews").on('click', function(){
        //affichage de la modal en modifiant le css de la modal
        $(".modalNews").css("display", "block");

        //ajout de la source de l'image dans le contenu de la modal en fonction de la source de l'image cliquée
        //le $(this) fait reference a l'img qui a été cliquée
        $("#imgSelected").attr("src", $(this).attr("src"));
    });

    //si on clique sur le bouton, on ferme la modal en modifiant le css
    $(".closeModalNews").on("click", function(){
        $(".modalNews").css("display", "none");
    });

});

/**********************************************************************************************************************/
/*                                         ANIMATION MODAL SUPPRESSION                                                */
/**********************************************************************************************************************/

$(document).ready(function(){
    $('.deleteSecurity').on('click', function() {
        $('.deleteSecurityModal').fadeIn();
    });
    $('.closeModalSecurity').on('click', function() {
        $('.deleteSecurityModal').fadeOut();
    });
});

/**********************************************************************************************************************/
/*                                                 SCROLL PAGE                                                        */
/**********************************************************************************************************************/
$(document).ready(function(){

window.addEventListener('load',function() {

    if(document.URL === "http://localhost/lesCreatifsDePuygareau/public/") {

        window.scrollTo(0, 0);

    } else {

        window.scrollTo(800, 800);
    }

}, false);

});

/**********************************************************************************************************************/
/*                                                 STICKY MENU                                                        */
/**********************************************************************************************************************/

$(document).ready(function() {

    var stickyNavTop = $('.navbar').offset().top;

    var stickyNav = function(){
        var scrollTop = $(window).scrollTop();

        if (scrollTop > stickyNavTop) {
            $('.navbar').addClass('sticky');
        } else {
            $('.navbar').removeClass('sticky');
        }
    };
    stickyNav();

    $(window).scroll(function() {
        stickyNav();
    });
});