<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Tipopersonal;
use Asi\ClinicaBundle\Form\TipopersonalType;

/**
 * Tipopersonal controller.
 *
 */
class TipopersonalController extends Controller
{

    /**
     * Lists all Tipopersonal entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Tipopersonal')->findAll();

        return $this->render('AsiClinicaBundle:Tipopersonal:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tipopersonal entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tipopersonal();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipopersonal_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Tipopersonal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tipopersonal entity.
     *
     * @param Tipopersonal $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tipopersonal $entity)
    {
        $form = $this->createForm(new TipopersonalType(), $entity, array(
            'action' => $this->generateUrl('tipopersonal_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Tipopersonal entity.
     *
     */
    public function newAction()
    {
        $entity = new Tipopersonal();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Tipopersonal:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tipopersonal entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipopersonal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipopersonal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tipopersonal:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tipopersonal entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipopersonal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipopersonal entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tipopersonal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tipopersonal entity.
    *
    * @param Tipopersonal $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tipopersonal $entity)
    {
        $form = $this->createForm(new TipopersonalType(), $entity, array(
            'action' => $this->generateUrl('tipopersonal_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Tipopersonal entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipopersonal')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipopersonal entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipopersonal_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Tipopersonal:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tipopersonal entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Tipopersonal')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipopersonal entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipopersonal'));
    }

    /**
     * Creates a form to delete a Tipopersonal entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipopersonal_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
