<?php

namespace Wf3\KikaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo')
            ->add('name')
            ->add('firstname')
            ->add('birthDate')
            ->add('gender', 'choice', array(
                'label' => false,
                'choices' => array(
                'm' => 'Homme',
                'f' => 'Femme'
                ),
                'expanded' => true, 
                'multiple' => false
                ))
            ->add('job')
            ->add('trainerDesc')
            ->add('studentDesc')
            ->add('file','file')
            ->add('email','email')
            ->add('password', 'repeated', array (
                    'type' => 'password',
                    'invalid_message' => 'Les mots de passe ne sont pas identiques.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options'  => array('label' => 'mot de passe'),
                    'second_options' => array('label' => 'Validation du mot de passe')
                    ))
            ->add('Inscriver Vous !','submit') /* on peut + le bouton submit */
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Wf3\KikaBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'wf3_kikabundle_register';
    }
}
