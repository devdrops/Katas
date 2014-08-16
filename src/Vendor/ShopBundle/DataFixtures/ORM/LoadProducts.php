<?php
namespace Vendor\ShopBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Vendor\ShopBundle\Entity\Product;
use Vendor\ShopBundle\Entity\ProductTranslation;

class LoadSubjectsFixture extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 8; $i++) {
            $product = new Product();
            $product->setName('Product '.$i);
            $product->setDescription('Description of the product '.$i, 'en');
            $product->setDescription('Description du produit '.$i, 'fr');

            $manager->persist($product);

            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
