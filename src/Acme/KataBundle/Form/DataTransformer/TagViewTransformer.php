<?php

namespace Acme\KataBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TagViewTransformer implements DataTransformerInterface
{

    /**
     * Transforms array (tags) to a string.
     *
     * @param  array $tags
     * @return string
     */
    public function transform($tags)
    {
        return implode(' ', $tags);
    }

    /**
     * Transforms a string to array(s) (tag).
     *
     * @param string $titles
     * @return array
     */
    public function reverseTransform($titles)
    {
        $titles = trim($titles);

        if (empty($titles)) {
            return null;
        }

        return $titles = explode(' ', $titles);
    }
}
