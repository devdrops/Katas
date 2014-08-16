<?php

namespace Vendor\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/products")
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="vendor_get_products")
     * @Method({"GET"})
     * @Template
     */
    public function indexAction(Request $request)
    {
        $products = $this->get('doctrine')->getRepository('VendorShopBundle:Product')->findAll();

        return array('products' => $products);
    }
}
