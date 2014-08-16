Translation Kata
================

### As a user, I need to see the french version of a shop when I click on the french flag, and the english version when I click on the american flag.

    [X] The static message on the website must be translated.
    [X] The local must be in the url.
    [X] The list of products must be displayed from the database, in the two languages.
    [X] The pages must look like these designs:

![capture d ecran 2014-08-17 a 02 48 02](https://cloud.githubusercontent.com/assets/667519/3944489/9e8409fc-2607-11e4-8207-b9fbec468808.png)
![capture d ecran 2014-08-17 a 02 48 10](https://cloud.githubusercontent.com/assets/667519/3944490/ab8f4ad0-2607-11e4-8367-0fdadf095a1d.png)

N.B.: We'll use Doctrine and MySQL for the exercise.

### Steps:

1. Create a new bundle called VendorShopBundle.
2. Begin with the design of the layout in ``src/Vendor/ShopBundle/Resources/views/layout.html.twig``
3. Integrate in it some twitter bootstrap to make it presentable.
4. Create your homepage (Controller ``src/Vendor/ShopBundle/Controller/DefaultController.php`` + View ``src/Vendor/ShopBundle/Resources/views/Default/index.html``).
5. In your ``layout`` template, make that the meta description, meta keywords and title
of the page are translated with those keys ``{{ 'meta.keywords'|trans }}``,
``{{ 'meta.description'|trans }}`` and ``{{ 'shop.name'|trans }}``.
6. Use the tag ``{% trans_default_domain 'index' %}`` to use the catalogs
``index.en.yml`` and ``index.fr.yml``.
7. Create the catalogs in ``src/Vendor/ShopBundle/Resources/translations/index.fr.yml``
and ``src/Vendor/ShopBundle/Resources/translations/index.en.yml``.
8. Enable translation in the ``app/config/config.yml`` by uncommenting the line
``translator:  { fallback: "%locale%" }`` under the ``framework`` key.
9. Don't forget to clear you're cache, as you changed you configuration ;)
10. Complete your ``src/Vendor/ShopBundle/Resources/views/Default/index.html`` template.
10. Create your product list page (Controller ``src/Vendor/ShopBundle/Controller/ProductController.php`` + View ``src/Vendor/ShopBundle/Resources/views/Product/index.html``).
11. Complete your ``src/Vendor/ShopBundle/Resources/views/Product/index.html`` template.
12. Create a event susbsriber ``src/Vendor/ShopBundle/EventListener/LocaleListener.php``
that will be responisble of changing the locale of the request, put the locale
in session and set other languages available so only right flags will be displayed
to the user.
13. In the layout, add the snippet of code to display the other available language through flags
(mind adding the picto in ``src/Vendor/ShopBundle/Resources/public/images/pictos``).
14. Now time to make sure that all routes of the bundle are prefixed with a locale
(don't forget to add requirements and a default).
15. Then, create the entities ``src/Vendor/ShopBundle/Entity/Product.php`` and
``src/Vendor/ShopBundle/Entity/ProductTranslation.php`` (oneToMany relation).
16. Add the ``src/Vendor/ShopBundle/Translation/TranslationProxy.php`` (responsible
of the translation system).
17. Create some fixtures (the ``doctrine/doctrine-fixtures-bundle`` package is needed).
18. Create your database, your schema and load your fixtures.
19. Add the right code in the ``src/Vendor/ShopBundle/Resources/views/Product/index.html``
template to display your product information.

Et voilà !

Some documentation:
- http://symfony.com/doc/current/book/translation.html
- http://symfony.com/doc/current/cookbook/session/locale_sticky_session.html
- http://symfony.com/doc/current/components/translation/index.html
- http://moquet.net/talks/phptour-2014-i18n/


-------------------------


### Go a little further:

You can use the https://github.com/lexik/LexikTranslationBundle to manage your translation in
database.

The bundle is integrated in this branch : https://github.com/poledev/Katas/tree/kata-translation

*NB*: AngularJS is needed. And don't forget to launch the ``app/console assets:install`` command.

The interface is available on ``/translations/grid`` uri.
![capture decran 2014-08-17 a 12 01 29](https://cloud.githubusercontent.com/assets/667519/3944581/1f87b724-260d-11e4-8d9c-ec99c281ebd3.png)


- To import your bundle translation : ``app/console lexik:translations:import VendorShopBundle``
- To export your translations from the database :  ``app/console lexik:translations:export``

*NB*: For the exportation, mind that you must create first the app/cache/dev/Resources/translations
so the new translations created via the web interface can be dumped in the yml files.

![capture d ecran 2014-08-17 a 14 40 02](https://cloud.githubusercontent.com/assets/667519/3944559/c8955c74-260b-11e4-9213-bd818a8f11ca.png)

Add the new lines in the original files, you can then, import it via the
``app/console lexik:translations:import VendorShopBundle``.
