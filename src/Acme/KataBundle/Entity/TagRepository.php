<?php

namespace Acme\KataBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    public function persistAndFlush(Tag $tag)
    {
        $this->_em->persist($tag);
        $this->_em->flush($tag);
    }
}
