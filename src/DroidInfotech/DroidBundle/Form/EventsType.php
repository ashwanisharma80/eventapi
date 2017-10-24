<?php

namespace DroidInfotech\DroidBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class EventsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder
            ->add('title', TextType::class,array('label' => 'Event Name'))
            //->add('event_schedule',DateType::class, array('label' => 'Event Schedule','widget' => 'single_text','html5' => false,'attr' => ['class' => 'datepicker','id'=>'txtDate'],'mapped'=>false))
            ->add('location',TextType::class,array('label' => 'Location',))
            ->add('address',TextType::class,array('label' => 'Address',))    
            ->add('logo',  FileType::class,array('mapped'=>false,'required'=>false,'label' => 'Upload Event Logo'))    
            ->add('event_Image',  FileType::class,array('mapped'=>false,'required'=>false,'label' => 'Upload Images'))
            ->add('website',UrlType::class,array('label'=>'Event Info'))
            ->add('faqslink',UrlType::class,array('label'=>'FAQ'))     
            ->add('schedulelink',UrlType::class,array('label'=>'Schedule'))          
            ->add('exhibitorIds',EntityType::class, array(
                'class' => 'DroidInfotechDroidBundle:Exhibitor',
                'choice_label' => 'name',
                'multiple' => true,
                // 'expanded' => true,
                'label'=>'Assign Exhibitor'
            ))
                ->add('description')
            ->add('active')
           
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DroidInfotech\DroidBundle\Entity\Events'
        ));
    }
}
