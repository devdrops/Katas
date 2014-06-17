<?php

namespace Playground\DemoBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Playground\DemoBundle\Event\TriggerTimeEvent;
use Psr\Log\LoggerInterface;

class TriggerTimeListener implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onTriggerTime(TriggerTimeEvent $event)
    {
        $this->logger->info('The website is about to close in less than 1 day', array(
            'triggerTime' => $event->getTriggeredTime()
        ));
    }

    public static function getSubscribedEvents()
    {
        return array(
            TriggerTimeEvent::TRIGGER_TIME => array('onTriggerTime', 255),
        );
    }
}