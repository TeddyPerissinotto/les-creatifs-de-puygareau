<?php


namespace App\Controller;


use App\Repository\ArticlesRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/categorie/{id}", name="articles_by_category")
     */
    public function articlesByCategory($id, ArticlesRepository $articlesRepository, CategorieRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();
        $categorie = $categorieRepository->find($id);
        $articles = $articlesRepository->findAll();

        return $this->render('articles/articles.html.twig',
            [
                'categories' => $categories,
                'categorie' => $categorie,
                'articles' => $articles
            ]);
    }

    /**
     * @Route("/article/{id}", name="article_by_id")
     */
    public function articleById($id, ArticlesRepository $articlesRepository, CategorieRepository $categorieRepository)
    {
        $article = $articlesRepository->find($id);
        $categories = $categorieRepository->findAll();

        return $this->render('articles/article.html.twig',
            [
                'article' => $article,
                'categories' => $categories
            ]);
    }

    //****************************************** BARRE DE RECHERCHE *************************************************//

    /**
     * @Route("/searchResults", name="search_results")
     */
    public function articleByTitle(ArticlesRepository $articlesRepository, Request $request, CategorieRepository $categorieRepository)
    {
        $word = $request->query->get('word');

        $articles = $articlesRepository->findbyTitle($word);
        $categories = $categorieRepository->findAll();

        return $this->render('articles/searchResults.html.twig',
            [
                'articles' => $articles,
                'categories' => $categories
            ]);
    }

}