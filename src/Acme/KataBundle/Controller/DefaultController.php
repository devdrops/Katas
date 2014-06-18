<?php

namespace Acme\KataBundle\Controller;

use Acme\KataBundle\Entity\Article;
use Acme\KataBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $article = new Article();

        $form = $this->createForm('article', $article);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('success'));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/user", name="homepage")
     * @Template()
     */
    public function userAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm('user', $user);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('success'));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/success", name="success")
     */
    public function successAction()
    {
        return new Response('success');
    }
}
