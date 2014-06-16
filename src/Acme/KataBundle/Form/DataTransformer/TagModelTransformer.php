<?php

namespace Acme\KataBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\KataBundle\Entity\Tag;

class TagModelTransformer implements DataTransformerInterface
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

    /**
     * Transforms objects (tags) to an array.
     *
     * @param  ArrayCollection|null $tags
     * @return array
     */
    public function transform($tags)
    {
        if (null === $tags) {
            return array();
        }

        $tags = is_array($tags) ? $tags : $tags->toArray();

        return $tags;
    }

    /**
     * Transforms an array to object(s) (tag).
     *
     * @param array $titles
     * @return ArrayCollection
     */
    public function reverseTransform($titles)
    {
        $existingTitles = $this->om
            ->getRepository('AcmeKataBundle:Tag')
            ->findByTitle($titles)
        ;

        foreach ($titles as $title) {
            if (!in_array($title, $existingTitles)) {
                $tag = new Tag();
                $tag->setTitle($title);
                $this->om->persist($tag);
                $existingTitles[] = $tag;
            }
        }

        $this->om->flush();

        return $existingTitles;
    }
}
