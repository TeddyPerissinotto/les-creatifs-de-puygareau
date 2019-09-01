<?php


namespace App\Controller;


use App\Entity\News;
use App\Form\NewsType;
use App\Repository\CategorieRepository;
use App\Repository\ImagesRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
//Pour tous les controlleurs, je fais un extend de la classe AbstractController
{



    //***** Permet d'afficher toutes News sur la page News *****//

    /**
     * @Route("/homeNews", name="home_news")
     */
    public function homeNews(EntityManagerInterface $entityManager, CategorieRepository $categorieRepository, ImagesRepository $imagesRepository)
    {
        $newsRepository = $entityManager->getRepository(News::class);

        $news = $newsRepository->findAll();
        $categories = $categorieRepository->findAll();
        $images = $imagesRepository->findAll();

        return $this->render('news/homeNews.html.twig',
            [
                'allnews' => $news,
                'categories' => $categories,
                'images' => $images
            ]);

    }

    /**
     * @Route("/showNews/{id}", name="show_news")
     */
    public function showNews($id, EntityManagerInterface $entityManager, CategorieRepository $categorieRepository, ImagesRepository $imagesRepository)
    {
        $newsRepository = $entityManager->getRepository(News::class);

        $news = $newsRepository->find($id);
        $categories = $categorieRepository->findAll();
        $images = $imagesRepository->findAll();

        return $this->render('news/showNews.html.twig',
            [
                'showNews' => $news,
                'categories' => $categories,
                'images' => $images
            ]);

    }

}