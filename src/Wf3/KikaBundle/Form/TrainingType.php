<?php

namespace Wf3\KikaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrainingType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('img')
            ->add('beginDate')
            ->add('beginHours')
            ->add('street')
            ->add('city')
            ->add('postalCd')
            ->add('country')
            ->add('duration')
            ->add('numberPlaces')
            ->add('numberStudent')
            ->add('trainingDesc')
            ->add('status')
            ->add('dateCreated')
            ->add('coach')
            ->add('category','entity', array(
                      "class"    => "Wf3KikaBundle:Category",
                      "property" => "name"))
            ->add('Créer','submit') 
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
        return 'wf3_kikabundle_training';
    }
}
