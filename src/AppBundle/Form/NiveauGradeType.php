<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class NiveauGradeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomniveaugrade', TextType::class,array(
            'label' =>'Niveau grade',
            'required' => true,
            'attr' => array(
                'class' => 'form-control'
            )))
            //->add('idprocede')

            ->add('idprocede', EntityType::class, array(
                // query choices from this entity
                'label' => 'Nom procede ',
                'class' => 'AppBundle:Procede',

                // use the User.username property as the visible option string
                'choice_label' => 'nomprocede', 'attr' => array(
                    'class' => 'form-control'
                )));
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\NiveauGrade'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_niveaugrade';
    }


}
