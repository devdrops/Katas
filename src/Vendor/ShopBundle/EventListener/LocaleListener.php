<?php

namespace Vendor\ShopBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;

class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            $request->getSession()->start();
        }

        // try to see if the locale has been set as a _locale routing parameter
        if ($locale = $request->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            $locale = $request->getSession()->get('_locale');
        }

        // if no explicit locale has been set on this request, use one from the session
        $request->setLocale($locale);

        $this->setOtherAvailableLanguages($request, $locale);

    }

    public function setOtherAvailableLanguages(Request $request, $locale)
    {
        $allLocales = array('en', 'fr');

        foreach ($allLocales as $l) {
            if ($locale != $l) {
                $locales[] = $l;
            }
        }

        $request->getSession()->set('other_locales', $locales);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
        );
    }
}
