<?php

namespace Playground\DemoBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Playground\DemoBundle\Event\TriggerTimeEvent;

class OpenDaysListener implements EventSubscriberInterface
{
    private $openDay;
    private $closeDay;
    private $dispatcher;
    private $currentDay;

    public function __construct($openDay, $closeDay, EventDispatcherInterface $dispatcher)
    {
        $this->openDay = $openDay;
        $this->closeDay = $closeDay;
        $this->dispatcher = $dispatcher;
        $this->setCurrentDay(date('w'));
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        if ($this->currentDay === ($this->closeDay-1)) {
            $this->dispatcher->dispatch(TriggerTimeEvent::TRIGGER_TIME, new TriggerTimeEvent(new \DateTime()));
        }

        if ($this->currentDay < $this->openDay || $this->currentDay > $this->closeDay) {
            // setting a response stops the propagation of the kernel.request event
            $event->setResponse(new Response('Sorry the website is now closed.'));
        }
    }

    public function setCurrentDay($day)
    {
        $this->currentDay = $day;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array('onKernelRequest', 255),
        );
    }
}