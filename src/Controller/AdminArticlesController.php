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

    /**
     * @Route("/admin/menu/articles", name="admin_menu_articles")
     */
    public function adminArticlesMenu(ArticlesRepository $articlesRepository, CategorieRepository $categorieRepository, ImagesRepository $imagesRepository)
    {
        $articles = $articlesRepository->findAll();
        $categories = $categorieRepository->findAll();
        $images =$imagesRepository->findAll();

        return $this->render('admin/adminArticlesMenu.html.twig',
        [
            'articles' => $articles,
            'categories' => $categories,
            'images' => $images
        ]);
    }

    //*************************************ADMIN : AJOUTE UN PRODUIT EN BDD***************************************//
    /**
     * @Route("/admin/articles/insert", name="articles_form_insert")
     */
    public function articlesFormInsert(Request $request, EntityManagerInterface $entityManager, CategorieRepository $categorieRepository)
    {
        $articles = new Articles();

        $form = $this->createForm(ArticlesType::class, $articles);
        $categories = $categorieRepository->findAll();

        $articlesFormView = $form->createView();

        if ($request->isMethod('Post'))
        {
            $form->handleRequest($request);

            $entityManager->persist($articles);
            $entityManager->flush();

            return $this->redirectToRoute('images_form_insert');
        }

        return $this->render('admin/articlesForm.html.twig',
            [
                'articlesFormView' => $articlesFormView,
                'categories' => $categories

            ]
        );
    }

    //*************************************ADMIN : MODIFIE UN PRODUIT EN BDD***************************************//

    /**
     * @Route("/admin/articles/{id}/update", name="articles_form_update")
     */
    public function articlesFormUpdate($id, Request $request, EntityManagerInterface $entityManager, ArticlesRepository $articlesRepository)
    {
        $articles = $articlesRepository->find($id);

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

    public function deleteArticles($id, ArticlesRepository $articlesRepository, EntityManagerInterface $entityManager, CategorieRepository $categorieRepository )
    {
        //je récupère le produit dans la BDD qui a l'id qui correspond a la wild card
        //ps : c'est une entité qui est récupérée
        $articles = $articlesRepository->find($id);
        $categories = $categorieRepository->findAll();

        //j'utilise la méthode remove() de l'entityManager en spécifiant
        //le livre à supprimer

        $entityManager->remove($articles);
        $entityManager->flush();

        return $this->redirectToRoute('admin_home',
        [
            'categories' => $categories
        ]);
    }

}