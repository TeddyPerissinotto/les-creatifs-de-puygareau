<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', EntityType::class,
        [
            'class' => Categorie::class,
            'choice_label' => 'titre'
        ])
            ->add('title')
            ->add('description')
            ->add('size')
            ->add('image1')
            ->add('image2')
            ->add('image3')
            ->add('image4')
            ->add('image5')
            ->add('prix')
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
