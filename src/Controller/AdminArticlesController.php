<?php


namespace App\Controller;


use App\Form\ArticlesType;
use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{

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

            return $this->redirectToRoute('admin_home');
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
    public function articlesFormUpdate($id, Request $request, EntityManagerInterface $entityManager, ArticlesRepository $articlesRepository, CategorieRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();
        $articles = $articlesRepository->find($id);
        $form = $this->createForm(ArticlesType::class, $articles);

        $articlesFormView = $form->createView();

        if ($request->isMethod('Post'))
        {
            $form->handleRequest($request);

            if ($form->isValid())
            {
                $entityManager->persist($articles);
                $entityManager->flush();
            }
            $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/articlesForm.html.twig',
            [
                'articlesFormView' => $articlesFormView,
                'categories' => $categories
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