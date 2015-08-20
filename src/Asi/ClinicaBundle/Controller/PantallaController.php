<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Pantalla;
use Asi\ClinicaBundle\Form\PantallaType;

/**
 * Pantalla controller.
 *
 */
class PantallaController extends Controller
{

    /**
     * Lists all Pantalla entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Pantalla')->findAll();

        return $this->render('AsiClinicaBundle:Pantalla:index.html.twig', array(
            'entities' => $entities
        ));
    }
    /**
     * Creates a new Pantalla entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pantalla();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pantalla_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Pantalla:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pantalla entity.
     *
     * @param Pantalla $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pantalla $entity)
    {
        $form = $this->createForm(new PantallaType(), $entity, array(
            'action' => $this->generateUrl('pantalla_create'),
            'method' => 'POST',
        ));
        $form->remove('estadoactivacion');
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Pantalla entity.
     *
     */
    public function newAction()
    {
        $entity = new Pantalla();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Pantalla:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pantalla entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pantalla')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantalla entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Pantalla:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pantalla entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pantalla')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantalla entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Pantalla:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pantalla entity.
    *
    * @param Pantalla $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pantalla $entity)
    {
        $form = $this->createForm(new PantallaType(), $entity, array(
            'action' => $this->generateUrl('pantalla_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Pantalla entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pantalla')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pantalla entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pantalla_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Pantalla:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pantalla entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Pantalla')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pantalla entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pantalla'));
    }

    /**
     * Creates a form to delete a Pantalla entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pantalla_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
