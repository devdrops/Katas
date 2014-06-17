<?php

namespace Acme\KataBundle\Form\Type;

use Acme\KataBundle\Form\DataTransformer\TagModelTransformer;
use Acme\KataBundle\Form\DataTransformer\TagViewTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    private $tagModelTransformer;
    private $tagViewTransformer;

    public function __construct(TagModelTransformer $tagModelTransformer, TagViewTransformer $tagViewTransformer)
    {
        $this->tagModelTransformer = $tagModelTransformer;
        $this->tagViewTransformer = $tagViewTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addModelTransformer($this->tagModelTransformer)
            ->addViewTransformer($this->tagViewTransformer)
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'invalid_message' => 'Error',
        ));
    }

    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'tag_selector';
    }
}
