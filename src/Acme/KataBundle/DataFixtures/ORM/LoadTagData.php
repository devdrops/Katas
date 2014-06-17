<?php

namespace Acme\KataBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\KataBundle\Entity\Tag;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tags = array('chocolat', 'coca', 'nature', 'meteo');

        foreach ($tags as $tag) {
            $manager->persist(new Tag($tag));
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
