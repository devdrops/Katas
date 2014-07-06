<?php

namespace Vendor\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Vendor\ShopBundle\Entity\Product;

class ProductController extends Controller
{
    /**
     * @Route("/product/new", name="vendor_product_new")
     * @Template()
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('product', $product);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $filename = $this->get('vendor.uploader')->upload($product->getDocument());
            $product->setDocument($filename);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($product);
            $manager->flush();

            return $this->redirect($this->generateUrl('vendor_product_show', array('id' => $product->getId())));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/product/show/{id}", name="vendor_product_show")
     * @Template()
     * @Method({"GET"})
     */
    public function showAction(Product $product)
    {
        return array(
            'product' => $product,
            'upload_path' => $this->container->getParameter('upload_path'),
        );
    }
}
