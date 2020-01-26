<?php
 
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\SujetDoc;
use Doctrine\ORM\EntityRepository;
class DocType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class,array(
            'label' => 'Nom (*)',
            'required' => true,
            'attr' => array(
                'class' => 'form-control'
            )))
            ->add('fichier',FileType::class, array('required' => false, 'label' => 'Document ', 'data_class' => null))

            ->add('idEmploye', EntityType::class, array(
                // query choices from this entity
                'label'=>'Employe',
                'class' => 'AppBundle:Employe',

                // use the User.username property as the visible option string
                'choice_label' => function($emp) {

                    return $emp->getId().'- '. $emp->getNom().' '.$emp->getPrenom();},


                'attr' => array(
                    'class' => 'form-control'
                )))
            ->add('typeDoc', EntityType::class, array(
                // query choices from this entity
                'label'=>'Type document',
                'class' => 'AppBundle:SujetDoc',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')

                        ->where('u.roleutilisateur  LIKE :roleutilisateur  ')
                        //  ->where('u.roles NOT LIKE :rolesb')

                        ->setParameter('roleutilisateur', '%RH%');

                },



                // use the User.username property as the visible option string
                'choice_label' => function($emp) {

                    return $emp->gettitre();},


                'attr' => array(
                    'class' => 'form-control'
                )))

       ->add('date_validite',DateType::class,array(
           'label' => 'Date d\'echeance',
           'required' => true,
           'widget' => 'single_text',
           'html5' => false,
           'data' => new \DateTime(),
           'attr' => ['class' => 'js-datepicker form-control'],
           'format' => 'dd-MM-yyyy'))
            ->add('etat', ChoiceType::class, array(
                'label' => 'Etat',
                'choices' => array(
                    'Valide' => 'Valide',
                    'Non Valide' => 'Non Valide',
                ),
                'attr' => array(
                    'class' => 'form-control'
                )));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Doc'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_doc';
    }


}
