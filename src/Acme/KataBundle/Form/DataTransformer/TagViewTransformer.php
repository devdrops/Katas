<?php

namespace Acme\KataBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class TagViewTransformer implements DataTransformerInterface
{

    /**
     * Transforms array (tags) to a string.
     *
     * @param  array  $tags
     * @return string
     */
    public function transform($tags)
    {
        return implode(' ', $tags);
    }

    /**
     * Transforms a string to array(s) (tag).
     *
     * @param  string $titles
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
