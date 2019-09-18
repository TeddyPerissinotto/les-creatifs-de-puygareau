<?php

namespace App\Form;

use App\Entity\Articles;
use App\Entity\Images;
use App\Entity\Media;
use App\Entity\News;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('media', EntityType::class,
                [
                    'class'=> Media::class,
                    'choice_label'=>'title',
                    'required'=> false
                ])
            ->add('articles', EntityType::class,
                [
                    'class'=>Articles::class,
                    'choice_label'=>'title',
                    'required'=>false
                ])
            ->add('news', EntityType::class,
                [
                    'class' => News::class,
                    'choice_label' => 'title',
                    'required' => false
                ])
            ->add('title', FileType::class, [
                'label' => 'Télécharger une image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                    ])
                ]
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Images::class,
        ]);
    }
}
