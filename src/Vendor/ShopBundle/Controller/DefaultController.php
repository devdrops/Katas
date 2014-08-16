<?php

namespace Vendor\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="vendor_index")
     * @Method({"GET"})
     * @Template
     */
    public function indexAction(Request $request)
    {
        return array();
    }

    /**
     * @Route("/locale", name="vendor_locale")
     */
    public function localeAction(Request $request)
    {
        return $this->redirect($this->generateUrl($request->get('referer'), array('_locale' => $request->get('_locale'))));
    }
}
