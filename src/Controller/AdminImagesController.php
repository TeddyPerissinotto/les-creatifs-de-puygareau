<?php


namespace App\Controller;


use App\Entity\Images;
use App\Form\ImagesType;
use App\Repository\ImagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdminImagesController extends AbstractController
{
    /**
     * @Route("/admin/images/insert", name="images_form_insert")
     */
    public function insertImages(Request $request, EntityManagerInterface $entityManager, ImagesRepository $imagesRepository)
    {
        $images = new Images();

        $form = $this->createForm(ImagesType::class, $images);

        $imagesFormView = $form->createView();

        if($request->isMethod('POST')) {
            /*Récupère la requête uniquement si la méthode du form est "post" */
            $form->handleRequest($request);
            /** @var UploadedFile $imageFile */
            $imageFile = $form['title']->getData();
            // Condition nécessaire car le champ 'image' n'est pas requis
            // donc le fichier doit être traité que s'il est téléchargé
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // Nécessaire pour inclure le nom du fichier en tant qu'URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                // Déplace le fichier dans le dossier des images de la image
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                // Met à jour l'image pour stocker le nouveau nom de la image
                $images->setNom($newFilename);
            }
            // Si le formulaire est envoyé et qu'il est valide (si les champs obligatoires sont remplis...)
            // si ce n'est pas le cas, cette étape est sautée pour arriver directement au return
            // (donc l'affichage de la page avec le formulaire)
            if ($form->isSubmitted() && $form->isValid()) {
                // On envoie la image en base de données grâce aux méthodes persist(objet) + flush
                // persist + flush est l'équivalent de commit + push de Git.
                $entityManager->persist($images);
                $entityManager->flush();
                return $this->redirectToRoute('admin_home');
            }
        }
        return $this->render('admin/adminImagesForm.html.twig', [
            // formView retourne tout le code html correspondant au formulaire
            'imagesFormView' => $imagesFormView
        ]);
    }

}