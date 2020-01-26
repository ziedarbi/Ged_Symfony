<?php
 
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class MethodeDisplineType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('idfamilleInsp')
        ->add('idfamilleInsp', EntityType::class, array(
            // query choices from this entity
            'label' => 'Famille Insp ',
            'class' => 'AppBundle:FamilleInsp',

            // use the User.username property as the visible option string
            'choice_label' => 'nomfamille', 'attr' => array(
                'class' => 'form-control'
            )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\MethodeDispline'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_methodedispline';
    }


}
