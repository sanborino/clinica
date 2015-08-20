<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Itemexamenfisico;
use Asi\ClinicaBundle\Form\ItemexamenfisicoType;

/**
 * Itemexamenfisico controller.
 *
 */
class ItemexamenfisicoController extends Controller
{

    /**
     * Lists all Itemexamenfisico entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Itemexamenfisico')->findAll();

        return $this->render('AsiClinicaBundle:Itemexamenfisico:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Itemexamenfisico entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Itemexamenfisico();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('itemexamenfisico_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Itemexamenfisico:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Itemexamenfisico entity.
     *
     * @param Itemexamenfisico $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Itemexamenfisico $entity)
    {
        $form = $this->createForm(new ItemexamenfisicoType(), $entity, array(
            'action' => $this->generateUrl('itemexamenfisico_create'),
            'method' => 'POST',
        ));
        $form->remove('estadoactivacion');
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Itemexamenfisico entity.
     *
     */
    public function newAction()
    {
        $entity = new Itemexamenfisico();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Itemexamenfisico:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Itemexamenfisico entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Itemexamenfisico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Itemexamenfisico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Itemexamenfisico:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Itemexamenfisico entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Itemexamenfisico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Itemexamenfisico entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Itemexamenfisico:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Itemexamenfisico entity.
    *
    * @param Itemexamenfisico $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Itemexamenfisico $entity)
    {
        $form = $this->createForm(new ItemexamenfisicoType(), $entity, array(
            'action' => $this->generateUrl('itemexamenfisico_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Itemexamenfisico entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Itemexamenfisico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Itemexamenfisico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('itemexamenfisico_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Itemexamenfisico:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Itemexamenfisico entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Itemexamenfisico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Itemexamenfisico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('itemexamenfisico'));
    }

    /**
     * Creates a form to delete a Itemexamenfisico entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('itemexamenfisico_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
