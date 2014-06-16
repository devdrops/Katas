<?php

namespace Acme\KataBundle\Form\DataTransformer;

use Acme\KataBundle\Entity\Tag;
use Acme\KataBundle\Entity\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;

class TagModelTransformer implements DataTransformerInterface
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
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
     * @param  array           $titles
     * @return ArrayCollection
     */
    public function reverseTransform($titles)
    {
        $existingTitles = $this->tagRepository->findByTitle($titles);

        foreach ($titles as $title) {
            if (!in_array($title, $existingTitles)) {
                $tag = new Tag();
                $tag->setTitle($title);
                $this->tagRepository->persistAndFlush($tag);
                $existingTitles[] = $tag;
            }
        }

        return $existingTitles;
    }
}
