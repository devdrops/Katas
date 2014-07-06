Kata Form Upload File
=====================

#### As a user, I need to upload a PDF with a Product.

```
[x] Create a Product through a form.
[x] A Product is composed of a name, price and a PDF document.
[x] Use semantical configuration in your Bundle so it can be possible to configure the path to the folder upload.
```

### Steps :

1. Generate a bundle called: Vendor/ShopBundle.
2. Create a Product entity with 3 properties: name, price and document.
3. Add @ORM annotations so we'll be able to persist the product in database.
4. Run ``php app/console doctrine:database:create`` then ``php app/console doctrine:schema:update``.
5. Create a ProductType class in the "Form" folder with 4 fields: name, price, document and submit.
6. Declarate it as a service.
7. Create a ``ProductController`` class extending the Symfony\Bundle\FrameworkBundle\Controller\Controller (so we'll be
able to access the container, and some nice methods as shortcut).
8. Create an action ``newAction`` in the ProductController with th pattern ``/product/new`` and pass the form to the view.
9. Restrict HTTP method to access the route (GET and POST)
10. Create a view in the ``Resources/views/Product`` folder called ``new.html.twig`` rendering the form.
11. Add constraints on fields with annotations in the Product class.
12. Use form theme to surround each field with a fieldset.
13. In the template, deactivate the HTML5 validation, and don't forget to add the ``form_enctype``.
14. Call the handleRequest() method in your action and do the logic to handle the submitted values.
15. Add logic in the ``if ($form->isValid())`` statement to persist the product without the upload of document.
16. Create the ``Uploader`` service in the folder ``Vendor\ShopBundle\Services`` having an ``upload()`` method.
17. In the upload method, implement the logic to generate the name of your document uploaded, and move the document in
the right folder. Return the filename generated.
18. Declarate the Uploader as a service and inject the service ``filesystem`` to it by constructor.
19. Make a sementical configuration to declarate the upload path.
20. Indicate a ``vendor_shop.upload_path`` in the ``app/config/config.yml`` with a value ``"%upload_path%"``.
21. Declarate the node in the ``src/Vendor/ShophBundle/DependencyInjection/Configuration.php``.
22. Add the argument ``upload_path`` to the definition of service ``vendor.uploader``in
``src/Vendor/ShopBundle/DependencyInjection/VendorShopExtension::load()`` method.
23. Don't forget to add the private property ``$path`` in the uploader service so it can be initialized in the constructor.
24. In the action, get the uploader service and call the method ``upload``.
25. Don't forget to update the ``$product->document`` property.
26. When the product is persisted, redirect the user to the ``/product/show/{id}`` route to show the product newly added
in database.
27. Create the showAction having the ``/product/show/{id}`` route pattern.
28. Create the template show.html.twig in the ``src/Vendor/ShopBundle/Resources/views/Product`` to display all
information of the product.

Et voilà!

Some documentation:

- http://symfony.com/doc/current/cookbook/form/form_customization.html
- http://symfony.com/doc/current/cookbook/bundles/extension.html
