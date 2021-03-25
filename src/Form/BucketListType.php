<?php

namespace App\Form;

use App\Entity\BucketList;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class BucketListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre : '
                ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :'
            ])
            ->add('author', TextType::class, [
                'label' => 'Auteur : '
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie :',
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('isPublished', ChoiceType::class, [
                'label' => 'Publier : ',
                'choices' => [
                    'Public' => true,
                    'Privé' => false
                ],
                'expanded' => true,
                'multiple' => false
            ])
            // ->add('dateCreated')
            // ->add('likes')
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BucketList::class,
        ]);
    }
}
