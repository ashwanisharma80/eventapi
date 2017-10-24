<?php

namespace DroidInfotech\DroidBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ExhibitorType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('boothno',  TextType::class,array('label'=>'Booth Number'))
                ->add('location')
                ->add('logo', FileType::class, array('label' => 'Upload Logo Image','data_class' => null,'required'=>false,'mapped'=>false))
                ->add('image', FileType::class, array('label' => 'Upload Image','data_class' => null,'required'=>false,'mapped'=>false))
                ->add('contactNumber')
                ->add('emailAdd', EmailType::class)
                ->add('url', UrlType::class, array())
                ->add('categoryIds', EntityType::class, array(
                    'class' => 'DroidInfotechDroidBundle:category',
                     'query_builder' => function (\DroidInfotech\DroidBundle\Repository\CategoryRepository $er) {
        return $er->createQueryBuilder('c')
            ->where('c.active = 1');
    },
                    'choice_label' => 'name',
                    'multiple' => true,
                    // 'expanded' => true,
                    //'mapped' => false
                ))
                ->add('productDesc',  \Symfony\Component\Form\Extension\Core\Type\TextareaType::class,array('label'=>'Product Description'))
                ->add('eventShowcase', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, array('label' => 'Event Showcase', 'choices' => array(
                        'Yes' => true,
                        'No' => false,
                    ),'expanded'=>true))
                ->add('eventshowcaseInfo',  \Symfony\Component\Form\Extension\Core\Type\TextareaType::class,array('label'=>'Event Showcase Info','required'=>false))
                ->add('eventshowcaseimage', FileType::class, array('label' => 'Upload Image','required'=>false,'data_class' => null,'mapped'=>false))
                ->add('Facebooklink', UrlType::class, array('required' => false, 'label' => 'Facebook Social link'))
                ->add('Youtubelink', UrlType::class, array('required' => false, 'label' => 'YouTube Social link'))
                ->add('Instagram', TextType::class, array('required' => false, 'label' => 'Instagram Social link'))
                ->add('Twiterlink', TextType::class, array('required' => false, 'label' => 'Twitter Social link'))
                ->add('active')

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'DroidInfotech\DroidBundle\Entity\Exhibitor'
        ));
    }

}
