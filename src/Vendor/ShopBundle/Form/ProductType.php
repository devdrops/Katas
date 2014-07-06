<?php

namespace Vendor\ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Name:'))
            ->add('price', 'money', array('label' => 'Price:'))
            ->add('document', 'file', array('label' => 'Upload description (PDF file):'))
            ->add('submit', 'submit', array('label' => 'Create!'))
        ;
    }

    public function getName()
    {
        return 'product';
    }
}
