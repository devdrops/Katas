<?php

namespace Playground\DemoBundle\Tests\Event;

use Playground\DemoBundle\Event\TriggerTimeEvent;

class TriggerTimeEventTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTriggeredTime()
    {
        $time = time();

        $event = new TriggerTimeEvent($time);

        $this->assertSame($time, $event->getTriggeredTime());
    }
}
