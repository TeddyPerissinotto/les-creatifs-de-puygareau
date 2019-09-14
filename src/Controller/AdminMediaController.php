<?php


namespace App\Controller;


use App\Entity\Media;
use App\Form\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMediaController extends AbstractController
{
    //Création de ma route. url+/admin/media/insert
    /**
     * @Route("/admin/media/insert", name="media_form_insert")
     */
    public function mediaFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $media = new Media();

        $form = $this->createForm(MediaType::class, $media);
        $mediaFormView = $form->createView();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($media);
            $entityManager->flush();

            return $this->redirectToRoute('admin_home');
        }
        return $this->render('admin/adminFormMedia.html.twig',
            [
                'mediaFormView' => $mediaFormView
            ]);

    }

}