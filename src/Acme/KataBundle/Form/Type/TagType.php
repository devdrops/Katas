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
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $viewTransformer = new TagViewTransformer();
        $modelTransformer = new TagModelTransformer($this->om);
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