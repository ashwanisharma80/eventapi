<?php

namespace DroidInfotech\DroidBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserFavouriteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userId', EntityType::class, array(
                    'class' => 'DroidInfotechDroidBundle:User',
                    'choice_label' => 'email',
                    'multiple' => false,
                    // 'expanded' => true,
                    //'mapped' => false
                ))
            ->add('exhibitorId', EntityType::class, array(
                    'class' => 'DroidInfotechDroidBundle:Exhibitor',
                    'choice_label' => 'name',
                    'multiple' => false,
                    // 'expanded' => true,
                    //'mapped' => false
                ))
            ->add('favourite')
           
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DroidInfotech\DroidBundle\Entity\UserFavourite'
        ));
    }
}
