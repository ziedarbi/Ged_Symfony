<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class EmployeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule',TextType::class, array(
                'required'=>True,
                'label' => 'Matricule * ',
                'attr' => array(
                    'class' => 'form-control'
                )))->add('cin',TextType::class, array(
                'required'=>True,
                'label' => 'CIN ou Passeport * ',
                'attr' => array(
                    'class' => 'form-control'
                )))
           ->add('nom',TextType::class, array(
               'required'=>True,
               'label' => 'Nom * ',
               'attr' => array(
                   'class' => 'form-control'
               )))->add('prenom',TextType::class, array(
                'required'=>True,
                'label' => 'Prenom * ',
                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('specialite',TextType::class, array(
                'required'=>True,
                'label' => 'Specialité * ',
                'attr' => array(
                    'class' => 'form-control'
                )))

            ->add('date_naissance', DateTimeType::class, array(
                'label' => 'Date de naissance',
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'data' => new \DateTime('now'),
                'attr' => ['class' => 'js-datepicker form-control'],
                'format' => 'dd-MM-yyyy'))

            ->add('dateEmbauche', DateTimeType::class, array(
                'label' => 'Date d\'embauche ',
                'required' => true,
                'widget' => 'single_text',
                'html5' => false,
                'data' => new \DateTime('now'),
                'attr' => ['class' => 'js-datepicker form-control'],
                'format' => 'dd-MM-yyyy'))

            ->add('direction',ChoiceType::class,array(
                'choices'=>[
                   'Direction Administrative'=>'Direction Administrative',
                    'Direction Technique'=>'Direction Technique',

                ],
                'multiple'=>false,
                'expanded'=>false,
                'attr'=>['class'=>'form-control']
            ))
            ->add('service',ChoiceType::class,array(
                'choices'=>[
                    'SERVICE GENERAUX'=>'SERVICE GENERAUX',
                    'MARKETING & COMMUNICATION LYON'=>'MARKETING & COMMUNICATION LYON',
                    'FINANCIER'=>'FINANCIER',
                    'LOGISTIQUE'=>'LOGISTIQUE',
                    'TECHNIQUE'=>'TECHNIQUE',
                    'RECHERCHE & DEVELOPPEMENT'=>'RECHERCHE & DEVELOPPEMENT',
                    'JURIDIQUE PARIS'=>'JURIDIQUE PARIS',

                ],
                'multiple'=>false,
                'expanded'=>false,
                'attr'=>['class'=>'form-control']
            ))


            ->add('emploioccupe',ChoiceType::class,array(
                'choices'=>[
                    'CHEF DE PROJET'=>'CHEF DE PROJET',
                    'INGENIEUR'=>'INGENIEUR',
                    'TECHNICIEN SUPERIEUR'=>'TECHNICIEN SUPERIEUR',
                    'TECHNICIEN'=>'TECHNICIEN',
                    'RESPONSABLE PARC AUTO'=>'RESPONSABLE PARC AUTO',
                    'Chauffeur'=>'Chauffeur',
                    'Inspecteur Paris'=>'Inspecteur Paris',

                ],
                'label' => 'Poste occupé ',
                'multiple'=>false,
                'expanded'=>false,
                'attr'=>['class'=>'form-control']
            ))

            ->add('diplome',ChoiceType::class,array(
                'choices'=>[
                    'Ingénieur'=>'Ingénieur',
                    'Master'=>'Master',
                    'Maitrise'=>'Maitrise',
                    'Licence'=>'Licence',
                    'BTS'=>'BTS',
                    'BTP'=>'BTP',

                ],
                'multiple'=>false,
                'expanded'=>false,
                'attr'=>['class'=>'form-control']
            ))
            ->add('naturecontrat',ChoiceType::class,array(
                'choices'=>[
                    'CDI'=>'CDI',
                    'CDD'=>'CDD',
                    'CNE'=>'CNE',

                ],
                'label' => 'Nature de contrat ',
                'multiple'=>false,
                'expanded'=>false,
                'attr'=>['class'=>'form-control']
            ))
            ->add('agence',ChoiceType::class,array(
                'choices'=>[
                    'LYON'=>'LYON',
                    'PARIS'=>'PARIS',
                    'GRENOBLE'=>'GRENOBLE',
                    'HONGRIE'=>'HONGRIE',
                     'PORTUGAL'=>'PORTUGAL',

                ],
                'label' => 'Agence ',
                'multiple'=>false,
                'expanded'=>false,
                'attr'=>['class'=>'form-control']
            ))


        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Employe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_employe';
    }


}
