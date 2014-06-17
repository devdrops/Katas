Kata Data Transformers
========================

#### As a user, I need to link Tags to my Article.

```
[x] Add a way to add Tags in the form Article.
[x] Link a Tag to an Article if he already exists.
[x] Tags are represented as text with space between other Tags.
[x] Tests dataTransformer.
```

### Steps :


1. Create an entity ``Article`` with those properties :
- title (string)
- author (string)
- content (text)
- createdAt (datetime)
2. Create another entity Tag with a title. Which has a ManyToMany relationship with the Article entity.
3. Create a ``TagRepository`` class with the method ``persistAndFlush``, doing basically a persist then a flush of an object "Tag".
4. Make it as a service: create a ``doctrine.xml`` file in ``/Resources/config`` and declare your repository as a service with ``factory-service="doctrine.orm.entity_manager"`` && ``factory-method="getRepository"``.
5. Load your ``doctrine.xml`` in the Extension file of your bundle (``/src/YourBundle/DependencyInjection``).
6. Create a ModelTransformer class (``TagModelTransformer``) which implements the ``DataTransformerInterface`` in `Form\DataTransformer\`.
7. Pass to its constructor the ``TagRepository``
8. Implements the `transform` and `reverseTransform` methods for converting an arrayCollection to a simple array and conversely.
9. In `reverseTransform` method if a tag doesn't exist, persist a new one with ObjectManager. If not, link to Article.
10. Declare the ``TagModelTransformer`` as a private service (``public="false"``).
11. Create a ViewTransformer class (``TagViewTransformer``) which implements the ``DataTransformerInterface`` in `Form\DataTransformer\`.
12. Implements `transform` and `reverseTransform` method for converting an array to a string with space and conversely : You can use ``explode`` and ``implode`` PHP functions.
13. Declare it as a private service.
14. Now time to create a Type for the tag called ``TagType`` which implements the method ``getName()`` (mandatory, returning a string), and the method ``buildForm`` (taking as arguments a FormBuilderInterface && an array of options).
15. Add the ``TagModelTransformer`` && ``TagViewTransformer`` to the builder.
16. You'll make it a service: you'll need your two DataTransformers, so create 2 private properties that will be initiated in the constructor.
17. Declare it as service: create a ``form.xml`` file in ``/Resources/config`` and declare your type with the tag ``form.type`` (make sure that the alias is the same as the string returned by the ``getName()`` method in your type), the two dependancies => your ModelTransformer and ViewTransformer ``$builder->addViewTransformer($viewTransformer)->addModelTransformer($modelTransformer);``
17. Then create a Type for your Article called ``ArticleType`` with your new TagType (indicate the alias of your type like 
`->add('tags', 'tags_selector')`).
18. Declare it as a service in the ``form.xml`` file.
19. Then create your Controller with actions to show, create, edit, delete articles.
20. Create views accordingly to your actions.
21. Time for tests! Create a directory /Tests/Unit/Form/DataTransformer
22. To test the ``TagModelTransformerTest``:
	- first create a ``TagModelTransformerTest`` extending ``\PHPUnit_Framework_TestCase``;
	- implement the ``setUp()`` method to initiate the two private properties ``$repo`` (a mock of the ``TagRepository``) and ``$transformer``(a real instance of ``TagModelTransformer`` taking the repository as argument)
	- create your unit tests to test the ``transform()`` and ``reverseTransform()`` methods of your ModelTransformer => basically verify that the method converts an arrayCollection to a simple array and conversely.
	- Make sure that your tests cover the case of having an existing tag title and a new tag title!
23. To test the ``TagViewTransformerTest``:
	- first create a ``TagViewTransformerTest`` extending ``\PHPUnit_Framework_TestCase``;
	- create your unit tests to test the ``transform()`` and ``reverseTransform()`` methods of your ViewTransformer => basically verify that the method converts an array to a string with space and conversely.

Et voilà !



Some documentation:
- http://symfony.com/doc/current/cookbook/form/data_transformers.html
- https://speakerdeck.com/webmozart/3-steps-to-symfony2-form-mastery
- https://speakerdeck.com/hhamon/ingenierie-inversee-du-composant-form-de-symfony
