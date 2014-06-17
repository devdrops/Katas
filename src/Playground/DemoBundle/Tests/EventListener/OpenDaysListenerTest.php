<?php

namespace Playground\DemoBundle\Tests\EventListener;

use Playground\DemoBundle\EventListener\OpenDaysListener;

class OpenDaysListenerTest extends \PHPUnit_Framework_TestCase
{
    private $event;
    private $dispatcher;
    
    public function testOnKernelRequestWithSubRequest()
    {
        $this->event
            ->expects($this->once())
            ->method('isMasterRequest')
            ->will($this->returnValue(false))
        ;
        $this->event->expects($this->never())->method('setResponse');
        $this->dispatcher->expects($this->never())->method('dispatch');

        $listener = new OpenDaysListener(8, 18, $this->dispatcher);

        $listener->onKernelRequest($this->event);
    }

    public function testWebsiteIsOpen()
    {
        $this->event
            ->expects($this->once())
            ->method('isMasterRequest')
            ->will($this->returnValue(true))
        ;

        $this->event->expects($this->never())->method('setResponse');
        $this->dispatcher->expects($this->never())->method('dispatch');

        $listener = new OpenDaysListener(0, 6, $this->dispatcher);
        $listener->setCurrentDay(4);

        $listener->onKernelRequest($this->event);
    }

    public function testWebsiteIsClosed()
    {
        $this->event
            ->expects($this->once())
            ->method('isMasterRequest')
            ->will($this->returnValue(true))
        ;

        $this->event->expects($this->once())->method('setResponse');
        $this->dispatcher->expects($this->never())->method('dispatch');

        $listener = new OpenDaysListener(0, 5, $this->dispatcher);
        $listener->setCurrentDay(6);

        $listener->onKernelRequest($this->event);
    }

    public function testWebsiteIsOpenfForOneLastDay()
    {
        $this->event
            ->expects($this->once())
            ->method('isMasterRequest')
            ->will($this->returnValue(true))
        ;

        $this->dispatcher->expects($this->once())->method('dispatch');

        $listener = new OpenDaysListener(0, 5, $this->dispatcher);
        $listener->setCurrentDay(4);

        $listener->onKernelRequest($this->event);
    }

    protected function setUp()
    {
        // Create a mock and deactivate the construct method
        $this->event = $this
            ->getMockBuilder('Symfony\Component\HttpKernel\Event\GetResponseEvent')
            ->disableOriginalConstructor()
            ->setMethods(array('isMasterRequest', 'setResponse'))
            ->getMock()
        ;

        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
    }

    protected function tearDown()
    {
        $this->event = null;
        $this->dispatcher = null;
    }
}