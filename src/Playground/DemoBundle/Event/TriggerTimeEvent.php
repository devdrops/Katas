<?php

namespace Playground\DemoBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class TriggerTimeEvent extends Event
{
    const TRIGGER_TIME = 'trigger.time';

    private $triggeredTime;

    public function __construct($triggeredTime)
    {
        $this->triggeredTime = $triggeredTime;
    }

    public function getTriggeredTime()
    {
        return $this->triggeredTime;
    }
}