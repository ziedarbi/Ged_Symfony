<?php
 
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SujetDocType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre',TextType::class, array(
            'required'=>True,
            'label' => 'Titre ',
            'attr' => array(
                'class' => 'form-control'
            )))->add('dossier',TextType::class, array(
            'required'=>True,
            'label' => 'Dossier ',
            'attr' => array(
                'class' => 'form-control'
            )))
            ->add('roleutilisateur', ChoiceType::class, array(
                'label' => 'Utilisateur',
                'choices' => array(
                    'RH' => 'RH',
                    'ResponsableFormation' => 'ResponsableFormation',

                ),
                'attr' => array(
                    'class' => 'form-control'
                ),
            ))

            ->add('pecheance', ChoiceType::class, array(
            'label' => 'Possede echeance',
            'choices' => array(
                'Oui' => 'Oui',
                'Non' => 'Non',
            ),
            'attr' => array(
                'class' => 'form-control'
            ),
        ))
            ->add('nbrejournotif', IntegerType::class, array(
                'label' => 'Notification avant ( jours )',
                'attr' => array(
                    'class' => 'form-control'
                ),

            ))

        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SujetDoc'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sujetdoc';
    }


}
