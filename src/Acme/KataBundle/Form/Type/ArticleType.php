<?php

namespace  Acme\KataBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('author')
            ->add('tags', 'tag_selector')
            ->add('submit', 'submit')
        ;
    }

    public function getName()
    {
        return 'article';
    }
}
