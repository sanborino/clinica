<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Tipopatologia;
use Asi\ClinicaBundle\Form\TipopatologiaType;

/**
 * Tipopatologia controller.
 *
 */
class TipopatologiaController extends Controller
{

    /**
     * Lists all Tipopatologia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Tipopatologia')->findAll();

        return $this->render('AsiClinicaBundle:Tipopatologia:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tipopatologia entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tipopatologia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipopatologia_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Tipopatologia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tipopatologia entity.
     *
     * @param Tipopatologia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tipopatologia $entity)
    {
        $form = $this->createForm(new TipopatologiaType(), $entity, array(
            'action' => $this->generateUrl('tipopatologia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Tipopatologia entity.
     *
     */
    public function newAction()
    {
        $entity = new Tipopatologia();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Tipopatologia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tipopatologia entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipopatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipopatologia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tipopatologia:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tipopatologia entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipopatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipopatologia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tipopatologia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tipopatologia entity.
    *
    * @param Tipopatologia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tipopatologia $entity)
    {
        $form = $this->createForm(new TipopatologiaType(), $entity, array(
            'action' => $this->generateUrl('tipopatologia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Tipopatologia entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipopatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipopatologia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipopatologia_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Tipopatologia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tipopatologia entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Tipopatologia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipopatologia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipopatologia'));
    }

    /**
     * Creates a form to delete a Tipopatologia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipopatologia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
