<?php

namespace App\Form;

use App\Entity\BucketList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            ->add('description')
            ->add('author', TextType::class, [
                'label' => 'Auteur : '
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
