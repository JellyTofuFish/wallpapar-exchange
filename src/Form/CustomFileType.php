<?php

namespace App\Form;

use App\Entity\Picture;
use App\Form\DataTransformer\FileTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class,
                ['multiple' => false ]);

        $builder
            ->addViewTransformer(new FileTransformer());
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $entity = $form->getParent()->getData();

        if ($entity instanceof Picture) {
            if ($entity->getPicture() === null) {
                $path = null;
            } else {
                $path = '/images/' . $entity->getPicture();
            }
            $view->vars['file_uri'] = $path;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([ 'file_uri' => null]);
    }


}