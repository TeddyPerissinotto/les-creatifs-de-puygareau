<?php


namespace App\Controller;


use App\Entity\News;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                         Permet d'afficher les 3 dernières News sur la page d'accueil                               //
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /**
     * @Route("/", name="index")
     */
    public function index(EntityManagerInterface $entityManager, CategorieRepository $categorieRepository)
    {
        $newsRepository = $entityManager->getRepository(News::class);

        $news = $newsRepository->findAll();
        $categories = $categorieRepository->findAll();

        return $this->render('news/news.html.twig',
            [
                'lastnews' => array_slice($news, -3, 3),
                'categories' => $categories
            ]);

    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                         Permet d'afficher les 3 dernières News sur la page d'accueil                           //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(CategorieRepository $categorieRepository)
    {
        $categories = $categorieRepository->findAll();

        return $this->render('contact/contact.html.twig',
            [
                'categories' => $categories
            ]);
    }

}
