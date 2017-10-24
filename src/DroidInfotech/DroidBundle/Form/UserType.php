<?php

namespace DroidInfotech\DroidBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType {

   /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
   public function buildForm(FormBuilderInterface $builder, array $options) {
      $builder->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('required' => true, 'label' => 'First Name'))
              ->add('lname', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array('required' => true, 'label' => 'Last Name'))
              ->add('email', EmailType::class)
              ->add('password', RepeatedType::class, array(
                  'type' => PasswordType::class,
                  'invalid_message' => 'The password fields must match.',
                  'options' => array('attr' => array('class' => 'password-field')),
                  'required' => true,
                  'error_bubbling' => true,
                  'first_options' => array('label' => 'Password', 'attr' => array('class' => 'password-field1')),
                  'second_options' => array('label' => 'Repeat Password', 'attr' => array('class' => 'password-field2')),
              ))

      ;
   }

   /*
    *  ->add('roles', ChoiceType::class, [
     'multiple' => true,
     'expanded' => true, // render check-boxes
     'choices' => [
     'Admin' => 'ROLE_ADMIN',
     'User' => 'ROLE_USER',
     // ...
     ],
     ])
    */

   /**
    * @param OptionsResolver $resolver
    */
   public function configureOptions(OptionsResolver $resolver) {
      $resolver->setDefaults(array(
          'data_class' => 'DroidInfotech\DroidBundle\Entity\User'
      ));
   }

}
