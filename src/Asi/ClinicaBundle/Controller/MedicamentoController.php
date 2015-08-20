<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Medicamento;
use Asi\ClinicaBundle\Form\MedicamentoType;

/**
 * Medicamento controller.
 *
 */
class MedicamentoController extends Controller
{

    /**
     * Lists all Medicamento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Medicamento')->findAll();

        return $this->render('AsiClinicaBundle:Medicamento:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Medicamento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Medicamento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('medicamento_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Medicamento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Medicamento entity.
     *
     * @param Medicamento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Medicamento $entity)
    {
        $en=$this->getDoctrine()->getManager()->getRepository('AsiClinicaBundle:Tiposervicio')->findOneByNombre('Medicamento');
        $form = $this->createForm(new MedicamentoType($en), $entity, array(
            'action' => $this->generateUrl('medicamento_create'),
            'method' => 'POST',
        ));
        $form->remove('estadoactivacion');
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Medicamento entity.
     *
     */
    public function newAction()
    {
        $entity = new Medicamento();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Medicamento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Medicamento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Medicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Medicamento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Medicamento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Medicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Medicamento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Medicamento entity.
    *
    * @param Medicamento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Medicamento $entity)
    {
        $form = $this->createForm(new MedicamentoType(), $entity, array(
            'action' => $this->generateUrl('medicamento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Medicamento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Medicamento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Medicamento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('medicamento_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Medicamento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Medicamento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Medicamento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Medicamento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('medicamento'));
    }

    /**
     * Creates a form to delete a Medicamento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medicamento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
