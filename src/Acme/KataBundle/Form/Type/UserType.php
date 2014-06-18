<?php

namespace  Acme\KataBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('mail')
            ->add('location', 'location', array('data_class' => 'Acme\KataBundle\Entity\User'))
            ->add('submit', 'submit')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}
