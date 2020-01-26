<?php

namespace AppBundle\Form;

use AppBundle\Entity\FamilleInsp;
use AppBundle\Entity\MethodeDispline;
use AppBundle\Entity\NiveauGrade;
use AppBundle\Entity\Procede;
use Symfony\Component\Form\FormEvent;
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
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormFactory;
class SearchDoctechniqueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //     $builder->add('date_ajout')->add('date_validite')->add('nom')->add('etat')->add('fichier')->add('idEmploye')->add('typeDoc');



        $builder

            ->add('famille',EntityType::class,[
                'class' =>'AppBundle\Entity\FamilleInsp',
                'placeholder'=>'choisir famille',
                'required'=>false,
                'mapped'=>false,
                'label' => 'Famille',
             'attr' => array(
        'class' => 'form-control')
        ]);

        $builder->get('famille')->addEventListener(FormEvents::POST_SUBMIT,
            function(FormEvent $event) {


                $famille=$event->getForm()->getData();
                $form=$event->getForm();

$this->addMethodeFiled($form->getParent(),$form->getData());

               // $this->addMethodeFiled($form->getParent(),$form->getData());

            });

$builder->addEventListener( FormEvents::POST_SET_DATA,
    function(FormEvent $event){
   $data=$event->getData();
       // dump($data);
        $niveaugrade=null;
        if($data!=null){


            $niveaugrade=$data->idMethodeDisp();

        }


        $form=$event->getForm();
if ($niveaugrade){
    $procede=$niveaugrade->getIdprocede();
    $methodedisp=$procede->getIdmethodedisp();
    $famille=$methodedisp->getIdfamilleInsp();

    $this->addMethodeFiled($form,$famille);
    $this->addProcede($form,$methodedisp);
    //$this->addNiveaugrade($form,$procede);
    $form->get('famille')->setData($famille);
    $form->get('Methode')->setData($methodedisp);
    $form->get('procede')->setData($procede);
} else{
    $this->addMethodeFiled($form,null);
    $this->addProcede($form,null);
   // $this->addNiveaugrade($form,null);
}


    });



// https://www.youtube.com/watch?v=F0Z-D3MSjA0  19:05
    }

    /**
     * add filed famille au formulaire
     * @param FormInterface $form
     * @param FamilleInsp $famille
     */
    private function addMethodeFiled(FormInterface $form, ?FamilleInsp $famille)
    {
        $builder = $form ->getConfig()->getFormFactory()->createNamedBuilder
        ('Methode', EntityType::class, null, [
            'class' => 'AppBundle\Entity\MethodeDispline',
            'placeholder' => 'methode displine',
            'auto_initialize' => false,
            'required' => false,
            'mapped' => false,
            'label' => 'Methode',
            'attr' => array(
                'class' => 'form-control'),
            'choices' =>$famille ?$famille->getIdMethodeDisp():[]
        ]);


        $builder->addEventListener(FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
$form=$event->getForm();

               $this->addProcede($form->getParent(),$form->getData());
            });
        $form->add($builder->getForm());
    }
/*
    private function addProcede(FormInterface $form , MethodeDispline $methode){
        $form->add('procede',EntityType::class,[
            'class' =>'AppBundle\Entity\Procede',
            'placeholder'=>'choisir procede',
            'mapped' => false,
            'auto_initialize' => false,
            'choices' => $methode->getProcedes()
        ]);

    }
*/

    /**
     * add filed famille au formulaire
     * @param FormInterface $form
     * @param MethodeDispline $methode
     */
    private function addProcede(FormInterface $form,  ?MethodeDispline $methode)
    {
        $builder = $form ->getConfig()->getFormFactory()->createNamedBuilder
        ('procede', EntityType::class, null, [
            'class' => 'AppBundle\Entity\Procede',
            'placeholder' => $methode ?'procede':'selectionner methode',
            'auto_initialize' => false,
            'required' => false,
            'mapped' => false,
            'label' => 'Procede',
            'attr' => array(
                'class' => 'form-control'),
            'choices' =>$methode ?$methode->getProcedes():[]
        ]);

/*
        $builder->addEventListener(FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form=$event->getForm();
               // dump($form->getData());
             $this->addNiveaugrade($form->getParent(),$form->getData());
            });
        */
        $form->add($builder->getForm());
    }
/*
    private function addNiveaugrade(FormInterface $form , ?Procede $procede){
        $form->add('idniveaugrade',EntityType::class,[
            'class' =>'AppBundle\Entity\NiveauGrade',
            'placeholder'=>$procede ?'choisir niveau':'selectionner procede',
            'required' => false,
            'mapped' => false,
            'auto_initialize' => false,
            'label' => 'Niveau',
            'attr' => array(
                'class' => 'form-control'),
            'choices' =>$procede? $procede->getNiveaugrads():[]
        ]);

    }
    */



    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_searchdoctechnique';
    }


}
