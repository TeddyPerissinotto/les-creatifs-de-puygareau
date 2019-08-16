<?php


namespace App\Controller;


use App\Entity\News;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{


//***** ADMIN : Permet d'afficher une News enregistrée en BDD *****//

/**
 * @Route("/admin/home/news/{id}", name="adminNewsShow")
 */
public function adminNewsShow($id, NewsRepository $newsRepository)
{
    $news = $newsRepository->find($id);

    return $this->render('admin/newsShow.html.twig',
        [
            'news' => $news
        ]);

}


}