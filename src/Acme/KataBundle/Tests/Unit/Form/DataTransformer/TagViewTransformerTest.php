<?php

namespace Acme\KataBundle\Tests\Unit\Form\DataTransformer;

use Acme\KataBundle\Form\DataTransformer\TagModelTransformer;
use Acme\KataBundle\Form\DataTransformer\TagViewTransformer;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Process\Process;

class TagViewTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testTransform()
    {
        $dataTransformer = new TagViewTransformer();

        $result = $dataTransformer->transform(array());
        $this->assertSame('', $result);

        $result = $dataTransformer->transform(array('chocolat', 'coca', 'nature', 'meteo'));
        $this->assertSame('chocolat coca nature meteo', $result);
    }

    public function testReverseTransform()
    {
        $dataTransformer = new TagViewTransformer();

        $result = $dataTransformer->reverseTransform('salut tu vas bien ?');
        $this->assertEquals(array('salut', 'tu', 'vas', 'bien', '?'), $result);
    }
}
