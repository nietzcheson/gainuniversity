<?php

namespace AppBundle\Form\ACL;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Form\ACL\EventListener\UsuariosSubscriber;

class UsuariosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('username')
            ->add('salt','hidden')
            ->add('email')
            ->add('roles', 'entity', array(
              'class' => 'AppBundle:ACL\Roles',
              'property' => 'role',
              'expanded' => true,
            ))

        ;

        $builder->addEventSubscriber(new UsuariosSubscriber());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ACL\Usuarios',
            'validation_groups' => array('registro_usuario'),
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acl_aclbundle_usuarios';
    }
}
