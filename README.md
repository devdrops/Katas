Event Listener / Event Subscriber Kata
======================================

### As a user, I need to make my website available between Sunday to friday.

     [X] Make an EventListener on kernel.request must be triggered as soon as possible
     [X] Don’t execute the logic if we aren’t in a master request 
     [X] Days of availability are configurable
     [X] Convert it to an EventSubscriber 
     [X] Create a custom event with a method telling the triggered time
     [X] Inside the listener, dispatch a custom event 1 day before closing 
     [X] Tests the EventSubscriber. 

### Steps:

1. Create the OpenDaysListener class with business logic.
2. Create a controller class + action with a twig template saying "We are open".
3. Construct the service definition of the event listener in the YourBundle/Resource/config/service.xml file.
4. Write the configuration in the app/config/config.yml file.
5. Write the description of the configuration in the Configuration class (YourBundle/Configuration.php file)
  Don't forget documentation with info() and example() method
6. Declare your configuration and inject your config variables in the container
  `$definition = $container->findDefinition('playground_demo.open_days_listener');`
  `$definition->setArguments(array($config['open_day'], $config['close_day']));`
7. Then create a construct method in the eventListener to inject config variables to access them.
8. Time to transform the eventListener into an eventSubscriber :
    - OpenDaysListener has to implements EventSubscriberInterface
    - Implement the getSubscribedEvents, listening to the `KernelEvents::REQUEST` event
9. Change tag of the service by `kernel.event_subscriber`
10.Create the `TriggerTimeEvent` class with the `getTriggeredTime` method (getting the trigger time) and the event constant `TRIGGER_TIME`.
11. Inject the eventDispatcher in the listener in the Extension class by getting the  playground_demo.open_days_listener service definition first then using `setArguments(new Reference('event_dispatcher'))`.
    NB : You can access the eventDispatcher from the event, but the `getDispatcher` is deprecated since 2.3
12. In the method onKernelRequest of your listener, dispatch the event TriggerTimeEvent::TRIGGER_TIME one day before the last day of opening.
13. Create an eventSubscriber `TriggerTimeListener` on the `TriggerTimeEvent::TRIGGER_TIME`.
14. Define it as a service with tag ``kernel.event_subscriber```.
15. Create the onTriggerTime method in the listener that logs the triggerTime info (use the logger from Psr\log).
    To verify that the eventSubscriber has been called, see the Symfony profiler, section "Events".
16. Test the OpenDaysListener with a subsrequest.
17. Test that the website is well closed on saturday.
18. Test that the website is opened on thursday.
19. Test that the TriggerTimeEvent is triggered one day before the closing day.

Et voilà!

Some documentation:
- http://symfony.com/doc/current/cookbook/doctrine/event_listeners_subscribers.html
- http://symfony.com/doc/current/cookbook/bundles/extension.html
- http://symfony.com/doc/current/components/event_dispatcher/introduction.html
