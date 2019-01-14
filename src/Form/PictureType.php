<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Picture;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('file', FileType::class,[
                'multiple' => false,
                 'required' => false
            ])
            ->add('description', TextareaType::class,[
                'required' => false ]
            )
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'User',
            ])
            ->add('picture_categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'Category',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->orderBy('f.category', 'asc');
                },
                'multiple'  => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
