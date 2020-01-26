<?php
 
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class ProcedeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomprocede')->add('idmethodedisp')
        ->add('idmethodedisp', EntityType::class, array(
            // query choices from this entity
            'label' => 'methode disp concernée ',
            'class' => 'AppBundle:MethodeDispline',

            // use the User.username property as the visible option string
            'choice_label' => 'nom', 'attr' => array(
                'class' => 'form-control'
            )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Procede'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_procede';
    }


}
