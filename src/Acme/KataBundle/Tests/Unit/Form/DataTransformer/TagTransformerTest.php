<?php

namespace Acme\KataBundle\Tests\Unit\Form\DataTransformer;

use Acme\KataBundle\Form\DataTransformer\TagModelTransformer;
use Acme\KataBundle\Form\DataTransformer\TagTransformer;
use Acme\KataBundle\Form\DataTransformer\TagViewTransformer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Process\Process;

class TagTransformerTest extends WebTestCase
{
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();

        $process = new Process('php app/console d:f:l --env=test');
        $process->run();
    }

    public function testViewTransform()
    {
        $dataTransformer = new TagViewTransformer();

        $result = $dataTransformer->transform(array());
        $this->assertSame('', $result);

        $result = $dataTransformer->transform(array('chocolat', 'coca', 'nature', 'meteo'));
        $this->assertSame('chocolat coca nature meteo', $result);
    }

    public function testViewReverseTransform()
    {
        $dataTransformer = new TagViewTransformer();

        $result = $dataTransformer->reverseTransform('salut tu vas bien ?');
        $this->assertEquals(array('salut', 'tu', 'vas', 'bien', '?'), $result);
    }

    public function testModelReverseTransform()
    {
        /** @var EntityManager $em */
        $em = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        $dataTransformer = new TagModelTransformer($em);

        $result = $dataTransformer->reverseTransform(array());
        $this->assertEquals(array(), $result);

        $results = $dataTransformer->reverseTransform(array('pomme', 'cerise'));
        $this->assertCount(2, $results);
        $this->assertSame('Acme\KataBundle\Entity\Tag', get_class($results[0]));
        $this->assertSame('pomme', $results[0]->getTitle());
        $this->assertSame('cerise', $results[1]->getTitle());

        $results = $dataTransformer->reverseTransform(array('chocolat', 'pomme', 'cerise'));
        $this->assertCount(3, $results);
        $this->assertSame('Acme\KataBundle\Entity\Tag', get_class($results[0]));
        $this->assertSame('chocolat', $results[0]->getTitle());
        $this->assertSame('pomme', $results[1]->getTitle());
        $this->assertSame('cerise', $results[2]->getTitle());
    }
}