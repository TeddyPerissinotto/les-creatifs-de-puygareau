<?php


namespace App\Controller;


use App\Repository\ArticlesRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/categorie/{id}", name="articles_by_category")
     */
    public function articlesByCategory($id, ArticlesRepository $articlesRepository, CategorieRepository $categorieRepository)
    {
        $categorie = $categorieRepository->find($id);
        $articles = $articlesRepository->findAll();

        return $this->render('articles/articles.html.twig',
            [
                'categorie' => $categorie,
                'articles' => $articles
            ]);
    }

    /**
     * @Route("/article/{id}", name="article_by_id")
     */
    public function articleById($id, ArticlesRepository $articlesRepository)
    {
        $article = $articlesRepository->find($id);

        return $this->render('articles/article.html.twig',
            [
                'article' => $article
            ]);
    }


}