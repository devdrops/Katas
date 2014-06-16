<?php

namespace Acme\KataBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\KataBundle\Entity\Article;
use Acme\KataBundle\Form\ArticleType;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{

    /**
     * Lists all Article entities.
     *
     * @Route("/", name="article")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $entities = $this->get('doctrine')->getRepository('AcmeKataBundle:Article')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/", name="article_create")
     * @Method("POST")
     * @Template("AcmeKataBundle:Article:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $form = $this->createCreateForm($article);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $article->getId())));
        }

        return array(
            'entity' => $article,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Article entity.
     *
     * @Route("/new", name="article_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $article = new Article();
        $form   = $this->createCreateForm($article);

        return array(
            'entity' => $article,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);

        return array(
            'entity'      => $article,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/{id}/edit", name="article_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction(Article $article)
    {
        $editForm = $this->createEditForm($article);
        $deleteForm = $this->createDeleteForm($article);

        return array(
            'entity'      => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Article entity.
     *
     * @Route("/{id}", name="article_update")
     * @Method("PUT")
     * @Template("AcmeKataBundle:Article:edit.html.twig")
     */
    public function updateAction(Request $request, Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $editForm = $this->createEditForm($article);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('article_edit', array('id' => $article->getId())));
        }

        $deleteForm = $this->createDeleteForm($article);

        return array(
            'entity'      => $article,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("/{id}", name="article_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Article $article)
    {
        $form = $this->createDeleteForm($article);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a Article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Creates a form to edit a Article entity.
     *
     * @param Article $article The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Article $article)
    {
        $form = $this->createForm('article', $article, array(
            'action' => $this->generateUrl('article_update', array('id' => $article->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Creates a form to create a Article entity.
     *
     * @param Article $article The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Article $article)
    {
        $form = $this->createForm('article', $article, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
}
