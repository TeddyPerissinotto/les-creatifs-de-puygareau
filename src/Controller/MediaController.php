<?php


namespace App\Controller;


use App\Repository\CategorieRepository;
use App\Repository\ImagesRepository;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{
    /**
     * @Route("/media", name="media")
     */
    public function media(MediaRepository $mediaRepository, ImagesRepository $imagesRepository, CategorieRepository $categorieRepository)
    {
        $medias = $mediaRepository->findAll();
        $images = $imagesRepository->findAll();
        $categories = $categorieRepository->findAll();

        return $this->render('Media/media.html.twig',
            [
                'medias' => $medias,
                'images' => $images,
                'categories' => $categories
            ]
        );
    }

}