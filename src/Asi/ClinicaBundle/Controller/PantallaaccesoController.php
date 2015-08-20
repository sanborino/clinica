<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\PantallaAcceso;
use Asi\ClinicaBundle\Form\PantallaaccesoType;

/**
 * Pantallaacceso controller.
 *
 */
class PantallaaccesoController extends Controller
{

    /**
     * Lists all Pantallaacceso entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Pantallaacceso')->findAll();

        return $this->render('AsiClinicaBundle:Pantallaacceso:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Pantallaacceso entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PantallaAcceso();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pantallaacceso_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Pantallaacceso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pantallaacceso entity.
     *
     * @param Pantallaacceso $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pantallaacceso $entity)
    {
        $form = $this->createForm(new PantallaaccesoType(), $entity, array(
            'action' => $this->generateUrl('pantallaacceso_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Pantallaacceso entity.
     *
     */
    public function newAction()
    {
        $entity = new PantallaAcceso();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Pantallaacceso:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pantallaacceso entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pantallaacceso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantallaacceso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Pantallaacceso:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pantallaacceso entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pantallaacceso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantallaacceso entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Pantallaacceso:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pantallaacceso entity.
    *
    * @param Pantallaacceso $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pantallaacceso $entity)
    {
        $form = $this->createForm(new PantallaaccesoType(), $entity, array(
            'action' => $this->generateUrl('pantallaacceso_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Pantallaacceso entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pantallaacceso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantallaacceso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pantallaacceso_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Pantallaacceso:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pantallaacceso entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Pantallaacceso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pantallaacceso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pantallaacceso'));
    }

    /**
     * Creates a form to delete a Pantallaacceso entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pantallaacceso_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
