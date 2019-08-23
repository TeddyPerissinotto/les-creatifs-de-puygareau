<?php


namespace App\Controller;


use App\Entity\News;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    //***** Permet d'afficher les 3 dernières News sur la page d'accueil *****//

    /**
     * @Route("/", name="index")
     */
    public function index(EntityManagerInterface $entityManager)
    {
        $newsRepository = $entityManager->getRepository(News::class);

        $news = $newsRepository->findAll();

        return $this->render('news/news.html.twig',
            [
                'lastnews' => array_slice($news, -3, 3)
            ]);

    }

    /**
     * @Route("/nav", name="nav")
     */
    public function navCategory(CategorieRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();

        return $this->render('base/nav.html.twig',
            [
                'categories' => $categories
            ]
        );

    }
}
