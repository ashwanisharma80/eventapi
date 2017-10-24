<?php

namespace DroidInfotech\DroidBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SurveyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('eventId',  \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, array('placeholder' => '--Select--',
                'class' => 'DroidInfotechDroidBundle:Events',
                'choice_label' => 'title',
                'multiple' => false,
                // 'expanded' => true,
                'label'=>'Event'
            ))       
            ->add('title')
            ->add('descriptions')
            ->add('active')
           
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DroidInfotech\DroidBundle\Entity\Survey'
        ));
    }
}
