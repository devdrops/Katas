Kata Form Inherit Data
======================

#### As a user, I need to add an user with an address like an article.

```
[x] Add fields of an address into Article form.
[x] Add fields of an address into User form.
[x] Don't repeat the form address, but don't use another entity with any relation.
```

### Steps :

1. Create another entity User with a username and mail. Who don't have any relationShip.
2. Create a basic FormType for an User with username and mail fields.
3. Set as a service.
4. Add address fields to User and Article entity(address, zipcode, city, country).
5. Create another FormType like `LocationType` to represent the address fields. (address, zipcode, city, country).
6. In `LocationType` override `setDefaultOption`, and set 'inherit_data' to true :
`$resolver->setDefaults(array('inherit_data' => true));`
7. Set as a service.
8. Now you can add your `LocationType` in User and Article Form.
Like `->add('location', 'location', array('data_class' => 'Acme\KataBundle\Entity\MyEntity'))`
9. To display the form you can add an action in your controller.

Et voilà!

Some documentation:

- http://symfony.com/doc/current/cookbook/form/inherit_data_option.html
