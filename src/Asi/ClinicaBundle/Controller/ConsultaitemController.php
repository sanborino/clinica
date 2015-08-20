<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Consultaitem;
use Asi\ClinicaBundle\Form\ConsultaitemType;

/**
 * Consultaitem controller.
 *
 */
class ConsultaitemController extends Controller
{

    /**
     * Lists all Consultaitem entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Consultaitem')->findAll();

        return $this->render('AsiClinicaBundle:Consultaitem:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Consultaitem entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Consultaitem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('consultaitem_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Consultaitem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Consultaitem entity.
     *
     * @param Consultaitem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Consultaitem $entity)
    {
        $form = $this->createForm(new ConsultaitemType(), $entity, array(
            'action' => $this->generateUrl('consultaitem_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Consultaitem entity.
     *
     */
    public function newAction()
    {
        $entity = new Consultaitem();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Consultaitem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Consultaitem entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Consultaitem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consultaitem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Consultaitem:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Consultaitem entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Consultaitem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consultaitem entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Consultaitem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Consultaitem entity.
    *
    * @param Consultaitem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Consultaitem $entity)
    {
        $form = $this->createForm(new ConsultaitemType(), $entity, array(
            'action' => $this->generateUrl('consultaitem_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Consultaitem entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Consultaitem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consultaitem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('consultaitem_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Consultaitem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Consultaitem entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Consultaitem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Consultaitem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('consultaitem'));
    }

    /**
     * Creates a form to delete a Consultaitem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('consultaitem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
