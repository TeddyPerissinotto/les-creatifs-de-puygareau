<?php


namespace App\Controller;


use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
//Pour tous les controlleurs, je fais un extend de la classe AbstractController
{

    //***** Permet d'afficher les 3 dernières News sur la page d'accueil *****//

    /**
     * @Route("/", name="index_news")
     */
    public function newsIndex(EntityManagerInterface $entityManager)
    {
        $newsRepository = $entityManager->getRepository(News::class);

        $news = $newsRepository->findAll();

        return $this->render('news/news.html.twig',
            [
                'lastnews' => array_slice($news, -3, 3)
            ]);
    }

    //***** Permet d'afficher toutes News sur la page News *****//


    /**
     * @Route("/homeNews", name="home_news")
     */
    public function homeNews(EntityManagerInterface $entityManager)
    {
        $newsRepository = $entityManager->getRepository(News::class);

        $news = $newsRepository->findAll();

        return $this->render('news/homeNews.html.twig',
            [
                'allnews' => $news
            ]);

    }

    /**
     * @Route("/showNews/{id}", name="show_news")
     */
    public function showNews($id, EntityManagerInterface $entityManager)
    {
        $newsRepository = $entityManager->getRepository(News::class);

        $news = $newsRepository->find($id);

        return $this->render('news/showNews.html.twig',
            [
                'showNews' => $news
            ]);

    }

}