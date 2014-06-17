<?php

namespace Acme\KataBundle\Tests\Unit\Form\DataTransformer;

use Acme\KataBundle\Form\DataTransformer\TagModelTransformer;

class TagModelTransformerTest extends \PHPUnit_Framework_TestCase
{
    private $repo;
    private $transformer;

    protected function setUp()
    {
        $this->repo = $this->getMockBuilder('Acme\KataBundle\Entity\TagRepository')
            ->disableOriginalConstructor()
            ->setMethods(array('findByTitle', 'persistAndFlush'))
            ->getMock()
        ;
        $this->transformer =new TagModelTransformer($this->repo);
    }

    public function testReverseTransformWithEmptyTitle()
    {
        $this->repo
            ->expects($this->once())
            ->method('findByTitle')
            ->with(array())
            ->will($this->returnValue(array()))
        ;
        $result = $this->transformer->reverseTransform(array());
        $this->assertEquals(array(), $result);
    }

    public function testReverseTransformWithUnExistingTag()
    {
        $this->repo
            ->expects($this->exactly(2))
            ->method('persistAndFlush')
        ;

        $this->repo
            ->expects($this->once())
            ->method('findByTitle')
            ->with(array('pomme', 'cerise'))
            ->will($this->returnValue(array()))
        ;

        $results = $this->transformer->reverseTransform(array('pomme', 'cerise'));
        $this->assertCount(2, $results);
        $this->assertInstanceOf('Acme\KataBundle\Entity\Tag', $results[0]);
        $this->assertSame('pomme', $results[0]->getTitle());
        $this->assertInstanceOf('Acme\KataBundle\Entity\Tag', $results[1]);
        $this->assertSame('cerise', $results[1]->getTitle());
    }

    public function taestReverseTransformWithExistingTag()
    {
        $this->repo
            ->expects($this->never())
            ->method('persistAndFlush')
        ;

        $this->repo
            ->expects($this->once())
            ->method('findByTitle')
            ->with(array('pomme', 'cerise'))
            ->will($this->returnValue(array(new Tag('pomme'), new Tag('cerise'))))
        ;

        $results = $dataTransformer->reverseTransform(array('pomme', 'cerise'));
        $this->assertCount(2, $results);
        $this->assertInstanceOf('Acme\KataBundle\Entity\Tag', $results[0]);
        $this->assertSame('pomme', $results[0]->getTitle());
        $this->assertInstanceOf('Acme\KataBundle\Entity\Tag', $results[1]);
        $this->assertSame('cerise', $results[1]->getTitle());
    }

    protected function tearDown()
    {
        $this->repo = null;
        $this->transformer = null;
    }
}
