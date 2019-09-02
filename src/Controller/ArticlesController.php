<?php


namespace App\Controller;


use App\Repository\ArticlesRepository;
use App\Repository\CategorieRepository;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                         Permet d'afficher les produits en fonction de ma catégorie                             //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/categorie/{id}", name="articles_by_category")
     */
    public function articlesByCategory($id, ArticlesRepository $articlesRepository, CategorieRepository $categorieRepository, ImagesRepository $imagesRepository)
    {
        $categories = $categorieRepository->findAll();
        $categorie = $categorieRepository->find($id);
        $articles = $articlesRepository->findAll();
        $images = $imagesRepository->findAll();

        return $this->render('articles/articles.html.twig',
            [
                'categories' => $categories,
                'categorie' => $categorie,
                'articles' => $articles,
                'images' => $images
            ]);

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                         Permet d'afficher les produits en fonction de ma catégorie                             //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/article/{id}", name="article_by_id")
     */
    public function articleById($id, ArticlesRepository $articlesRepository, CategorieRepository $categorieRepository, ImagesRepository $imagesRepository)
    {
        $article = $articlesRepository->find($id);
        $categories = $categorieRepository->findAll();
        $images = $imagesRepository->findAll();
        $image = $imagesRepository->find($id);

        return $this->render('articles/article.html.twig',
            [
                'article' => $article,
                'categories' => $categories,
                'images' => $images,
                'image' => $image
            ]);
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                                            Barre de recherche                                                  //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/searchResults", name="search_results")
     */
    public function articleByTitle(ArticlesRepository $articlesRepository, Request $request, CategorieRepository $categorieRepository, ImagesRepository $imagesrepository)
    {
        $word = $request->query->get('word');

        $articles = $articlesRepository->findbyTitle($word);
        $categories = $categorieRepository->findAll();
        $images = $imagesrepository->findAll();

        return $this->render('articles/searchResults.html.twig',
            [
                'articles' => $articles,
                'categories' => $categories,
                'images' => $images
            ]);
    }

}