<?php


namespace App\Controller;


use App\Form\ArticlesType;
use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use App\Repository\CategorieRepository;
use App\Repository\ImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                      ADMIN : AFFICHE LA LISTE DES PRODUITS SUR LE MENU ADMIN ARTICLES                          //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Création de ma route. url+/admin/menu/articles
    /**
     * @Route("/admin/menu/articles", name="admin_menu_articles")
     */
    //Création de ma méthode que j'ai appelé ici adminArticlesMenu
    //Je passe en paramètres ArtcilesRepository qui est la classe
    //permettant de gérer les requêtes liées à mon entité Articles
    public function adminArticlesMenu(ArticlesRepository $articlesRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //Je fais appel à la méthode findAll() présente dans le repository
        // cela va me permettre de récupérer tous les les articles
        $articles = $articlesRepository->findAll();

        return $this->render('admin/adminArticlesMenu.html.twig',
        [
            'articles' => $articles
        ]);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                    ADMIN : AJOUT D'UN PRODUIT EN BDD                                           //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Création de ma route. url+/admin/articles/insert
    /**
     * @Route("/admin/articles/insert", name="articles_form_insert")
     */
    //Création de ma méthode que j'ai appelé ici articlesFormInsert
    //je mets en paramètre de la méthode l'entity manager
    //car c'est l'outil qui me permet de gérer mes entités
    public function articlesFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        //refuse l'accès si l'utlisateur n'est pas enregistré en Administrateur
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //je créé une nouvelle instance de l'entité Articles
        //c'est cette entité qui est le miroir de la table Articles
        $articles = new Articles();
        // Crée le formulaire grâce à la méthode "createForm"
        // dans laquelle on passe la représentation abstraite du formulaire (articles).
        $form = $this->createForm(ArticlesType::class, $articles);
        // Récupère la requête uniquement si la méthode du formulaire est "post"
        $form->handleRequest($request);
        // Si le formulaire est envoyé et qu'il est valide (si les champs obligatoires
        //sont remplis...)
        // si ce n'est pas le cas, cette étape est sautée pour arriver directement au return
        // (donc l'affichage de la page avec le formulaire)
        if ($form->isSubmitted() && $form->isValid())
        {
            //on charge les données du nouvel article avec persist et on les envoie en
            //base de données avec flush
            $entityManager->persist($articles);
            $entityManager->flush();

        //Redirection vers le formulaire d'ajout d'images
            return $this->redirectToRoute('images_form_insert');
        }
        //on appelle un fichier twig avec en premier
        //paramètre le nom du fichier twig
        return $this->render('admin/articlesForm.html.twig',
            //et en second paramètre un tableau
            //qui contient les variables à envoyer au fichier Twig
            //(les variables envoyées au fichier Twig
            //pourront être appelés dans le fichier Twig
            [
                // Création de la view du formulaire
                'articlesFormView' => $form->createView()

            ]
        );
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                ADMIN : MODIFICATION D'UN PRODUIT EN BDD                                        //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/admin/articles/{id}/update", name="articles_form_update")
     */
    public function articlesFormUpdate($id, Request $request, EntityManagerInterface $entityManager, ArticlesRepository $articlesRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $articles = $articlesRepository->find($id);
        //je récupère l'article dans la BDD qui a l'id qui correspond a la wild car
        //ps : c'est une entité qui est récupérée

        $form = $this->createForm(ArticlesType::class, $articles);

        $form->handleRequest($request);

        if ($request->isMethod('Post'))
        {
                $entityManager->persist($articles);
                $entityManager->flush();

            $this->redirectToRoute('admin_menu_articles');
        }
        return $this->render('admin/articlesForm.html.twig',
            [
                'articlesFormView' => $form->createView()
            ]);
    }

    //*************************************ADMIN : SUPPRIME UN PRODUIT EN BDD***************************************//

    /**
     * @Route("/admin/articles/{id}/delete", name="articles_delete")
     */

    public function deleteArticles($id, ArticlesRepository $articlesRepository, EntityManagerInterface $entityManager)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //je récupère le produit dans la BDD qui a l'id qui correspond a la wild card
        //ps : c'est une entité qui est récupérée
        $articles = $articlesRepository->find($id);

        //j'utilise la méthode remove() de l'entityManager en spécifiant
        //le livre à supprimer

        $entityManager->remove($articles);
        $entityManager->flush();

        return $this->redirectToRoute('admin_home');
    }

}