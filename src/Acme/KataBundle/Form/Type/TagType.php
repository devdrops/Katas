<?php

namespace Acme\KataBundle\Form\Type;

use Acme\KataBundle\Form\DataTransformer\TagModelTransformer;
use Acme\KataBundle\Form\DataTransformer\TagViewTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    private $tagRepository;

    public function __construct($tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $viewTransformer = new TagViewTransformer();
        $modelTransformer = new TagModelTransformer($this->tagRepository);
        $builder->addViewTransformer($viewTransformer)->addModelTransformer($modelTransformer);
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
