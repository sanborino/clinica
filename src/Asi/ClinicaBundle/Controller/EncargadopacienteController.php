<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Encargadopaciente;
use Asi\ClinicaBundle\Form\EncargadopacienteType;

/**
 * Encargadopaciente controller.
 *
 */
class EncargadopacienteController extends Controller
{

    /**
     * Lists all Encargadopaciente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->findAll();

        return $this->render('AsiClinicaBundle:Encargadopaciente:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Encargadopaciente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Encargadopaciente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('encargadopaciente_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Encargadopaciente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Encargadopaciente entity.
     *
     * @param Encargadopaciente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Encargadopaciente $entity)
    {
        $form = $this->createForm(new EncargadopacienteType(), $entity, array(
            'action' => $this->generateUrl('encargadopaciente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Encargadopaciente entity.
     *
     */
    public function newAction()
    {
        $entity = new Encargadopaciente();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Encargadopaciente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Encargadopaciente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encargadopaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Encargadopaciente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Encargadopaciente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encargadopaciente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Encargadopaciente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Encargadopaciente entity.
    *
    * @param Encargadopaciente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Encargadopaciente $entity)
    {
        $form = $this->createForm(new EncargadopacienteType(), $entity, array(
            'action' => $this->generateUrl('encargadopaciente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Encargadopaciente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encargadopaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('encargadopaciente_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Encargadopaciente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Encargadopaciente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Encargadopaciente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('encargadopaciente'));
    }

    /**
     * Creates a form to delete a Encargadopaciente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('encargadopaciente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
