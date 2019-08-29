<?php


namespace App\Controller;


use App\Entity\News;
use App\Repository\ArticlesRepository;
use App\Repository\CategorieRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{


//***** ADMIN : Permet d'afficher une News enregistrée en BDD *****//

//***** ADMIN : Permet d'afficher toutes les news enregistrées en BDD *****//

    /**
     * @Route("/admin/home", name="admin_home")
     */
    public function adminAllList(NewsRepository $newsRepository, ArticlesRepository $articlesRepository, CategorieRepository $categorieRepository)
    {

        $news = $newsRepository->findAll();
        $articles = $articlesRepository->findAll();
        $categories = $categorieRepository->findAll();

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

            if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){

                return $this->render('admin/adminHome.html.twig',
                    [
                        'allnews' => $news,
                        'allarticles' => $articles,
                        'categories' => $categories
                    ]);
            }else {
                return $this->redirectToRoute('index_news',
                    [
                        'categories' => $categories
                    ]);
            }
        }else {
            return $this->redirectToRoute('fos_user_security_login',
                [
                    'categories' => $categories
                ]);
        }
    }

}