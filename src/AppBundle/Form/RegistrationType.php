<?php
namespace AppBundle\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
class RegistrationType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', TextType::class, array(
            'label' => 'Email',
            'required' => true,
            'attr' => array(
                'class' => 'form-control'
            )))
            ->add('username', TextType::class, array(
                'label' => 'Nom d utilisateur',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot de passe ', 'attr' => array(
                    'class' => 'form-control'
                )),
                'second_options' => array('label' => 'Repeter mot de passe', 'attr' => array(
                    'class' => 'form-control'
                )),

            ))
            ->add('roles',ChoiceType::class,array(
                'choices'=>[
                    'ROLE_UTILISATEUR'=>'ROLE_UTILISATEUR',
          'Role_ADMIN'=>'Role_ADMIN',
          'Role_RH'=>'Role_RH',
          'Role_RespFormation'=>'Role_RespFormation',
            //        'Role_secretaire'=>'Role_secretaire',
                ],
                'multiple'=>true,
                'expanded'=>false,
                'attr'=>['class'=>'form-control']
            ))

            ->add('enabled', CheckboxType::class,array(
                "required" => false,
                "label" => "Activé             ",
                'attr' => array(
                    'class' => 'iCheck-helper minimal'
                )));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

}