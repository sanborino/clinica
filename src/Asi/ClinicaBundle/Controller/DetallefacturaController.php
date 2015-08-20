<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Detallefactura;
use Asi\ClinicaBundle\Form\DetallefacturaType;

/**
 * Detallefactura controller.
 *
 */
class DetallefacturaController extends Controller
{

    /**
     * Lists all Detallefactura entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Detallefactura')->findAll();

        return $this->render('AsiClinicaBundle:Detallefactura:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Detallefactura entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Detallefactura();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('detallefactura_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Detallefactura:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Detallefactura entity.
     *
     * @param Detallefactura $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Detallefactura $entity)
    {
        $form = $this->createForm(new DetallefacturaType(), $entity, array(
            'action' => $this->generateUrl('detallefactura_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Detallefactura entity.
     *
     */
    public function newAction()
    {
        $entity = new Detallefactura();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Detallefactura:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Detallefactura entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Detallefactura entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Detallefactura:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Detallefactura entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Detallefactura entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Detallefactura:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Detallefactura entity.
    *
    * @param Detallefactura $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Detallefactura $entity)
    {
        $form = $this->createForm(new DetallefacturaType(), $entity, array(
            'action' => $this->generateUrl('detallefactura_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Detallefactura entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Detallefactura entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('detallefactura_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Detallefactura:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Detallefactura entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Detallefactura entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('detallefactura'));
    }

    /**
     * Creates a form to delete a Detallefactura entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('detallefactura_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
