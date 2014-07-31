<?php

namespace Wf3\KikaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddTrainingType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array(
                    "label" => "Intitulé de la formation"))
            ->add('beginDate', null, array(
                    "label" => "Date de début de la formation"))
            ->add('beginHours', null, array(
                    "label" => "heure de début de la formation"))
            ->add('street', null, array(
                    "label" => "adresse de la formation"))
            ->add('postalCd', null, array(
                    "label" => "Code Postal"))
            ->add('city', null, array(
                    "label" => "Ville"))
            ->add('country', null, array(
                    "label" => "Pays"))
            ->add('duration', null, array(
                    "label" => "Durée de la formation"))
            ->add('numberPlaces', null, array(
                    "label" => "Nombres de places totales"))
            ->add('trainingDesc', null, array(
                    "label" => "description de la formation"))
            ->add('file','file', array(
                    "label" => " Télécharger la photo de la formation"))
            ->add('category','entity', array(
                      "class"    => "Wf3KikaBundle:Category",
                      "property" => "name"))
            ->add('Ajouter the formation','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wf3\KikaBundle\Entity\Training'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wf3_kikabundle_addtraining';
    }
}
