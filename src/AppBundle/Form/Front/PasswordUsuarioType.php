<?php

namespace AppBundle\Form\Front;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PasswordUsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password','repeated', array(
              'type' => 'password',
              'invalid_message' => 'The password fields must match.',
              'options' => array('attr' => array('class' => 'password-field')),
              'required' => true,
              'first_options'  => array('label' => 'Password'),
              'second_options' => array('label' => 'Repita el Password'),
            ))
            ->add('submit', 'submit', array(
              'label' => 'Guardar',
              'attr' => array(
                'class' => 'btn btn-warning'
              )
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ACL\Usuarios'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'password_usuario';
    }
}