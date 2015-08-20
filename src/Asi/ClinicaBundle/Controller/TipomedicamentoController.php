<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Tipomedicamento;
use Asi\ClinicaBundle\Form\TipomedicamentoType;

/**
 * Tipomedicamento controller.
 *
 */
class TipomedicamentoController extends Controller
{

    /**
     * Lists all Tipomedicamento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Tipomedicamento')->findAll();

        return $this->render('AsiClinicaBundle:Tipomedicamento:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tipomedicamento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tipomedicamento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipomedicamento_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Tipomedicamento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tipomedicamento entity.
     *
     * @param Tipomedicamento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tipomedicamento $entity)
    {
        $form = $this->createForm(new TipomedicamentoType(), $entity, array(
            'action' => $this->generateUrl('tipomedicamento_create'),
            'method' => 'POST',
        ));
        $form->remove('estadoactivacion');
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Tipomedicamento entity.
     *
     */
    public function newAction()
    {
        $entity = new Tipomedicamento();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Tipomedicamento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tipomedicamento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipomedicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipomedicamento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tipomedicamento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tipomedicamento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipomedicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipomedicamento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tipomedicamento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tipomedicamento entity.
    *
    * @param Tipomedicamento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tipomedicamento $entity)
    {
        $form = $this->createForm(new TipomedicamentoType(), $entity, array(
            'action' => $this->generateUrl('tipomedicamento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Tipomedicamento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipomedicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipomedicamento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipomedicamento_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Tipomedicamento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tipomedicamento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Tipomedicamento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipomedicamento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipomedicamento'));
    }

    /**
     * Creates a form to delete a Tipomedicamento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipomedicamento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
