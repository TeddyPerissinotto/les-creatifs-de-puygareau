<?php


namespace App\Controller;


use App\Entity\News;
use App\Form\NewsType;
use App\Repository\CategorieRepository;
use App\Repository\ImagesRepository;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminNewsController extends AbstractController
{
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //                      ADMIN : AFFICHE LA LISTE DES ACTUALITES SUR LE MENU ADMIN NEWS                            //
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/admin/menu/news", name="admin_menu_news")
     */
    public function adminNewsMenu(NewsRepository $newsRepository, ImagesRepository $imagesRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $news = $newsRepository->findAll();
        $images = $imagesRepository->findAll();

        return $this->render('admin/adminNewsMenu.html.twig',
            [
                'news' => $news,
                'images' => $images
            ]);

    }


    //***** ADMIN : Permet d'entrer en BDD une nouvelle actualité *****//

    //Création de ma route. url+/admin/news/insert
    /**
     * @Route("/admin/news/insert", name="news_form_insert")
     */
    //Création de ma méthode que j'ai appelé ici newsFormInsert
    //je mets en paramètre de la méthode l'entity manager
    //car c'est l'outil qui me permet de gérer mes entités
    public function newsFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //je créé une nouvelle instance de l'entité News
        //c'est cette entité qui est le miroir de la table News
        $news = new News();
        // Création de la view du formulaire
        $form = $this->createForm(NewsType::class, $news);
        $newsFormView = $form->createView();
        // Le formulaire récupère les infos
        // de la requête
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            // On enregistre l'entité créée avec persist
            // et flush
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('images_form_insert');
        }
        //on appelle un fichier twig avec en premier
        //paramètre le nom du fichier twig
        return $this->render('admin/newsForm.html.twig',
            //et en second paramètre un tableau
            //qui contient les variables à envoyer au fichier Twig
            //(les variables envoyées au fichier Twig
            //pourront être appelés dans le fichier Twig
            [
                'newsFormView'=> $newsFormView
            ]
        );
    }

    //***** ADMIN : Permet de modifier une News en BDD *****//

    /**
     * @Route("/admin/news/{id}/update", name="news_form_update")
     */
    public function newsFormUpdate($id, Request $request, EntityManagerInterface $entityManager, NewsRepository $newsRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $news = $newsRepository->find($id);

        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);


        if ($request->isMethod('Post'))
        {

                $entityManager->persist($news);
                $entityManager->flush();

            $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/newsForm.html.twig',
            [
                'newsFormView' => $form->createView()
            ]);
    }

    //***** ADMIN : Permet de supprimer une actualité de la BDD *****//

    /**
     * @Route("/admin/news/{id}/delete", name="news_delete")
     */
    public function deleteNews($id, NewsRepository $newsRepository, EntityManagerInterface $entityManager)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //je récupère le livre dans la BDD qui a l'id qui correspond a la wild car
        //ps : c'est une entité qui est récupérée
        $news = $newsRepository->find($id);


        //j'utilise la méthode remove() de l'entityManager en spécifiant
        //le livre à supprimer

        $entityManager->remove($news);
        $entityManager->flush();

        return $this->redirectToRoute('admin_home');
    }



}