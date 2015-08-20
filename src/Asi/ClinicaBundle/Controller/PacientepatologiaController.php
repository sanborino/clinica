<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Pacientepatologia;
use Asi\ClinicaBundle\Form\PacientepatologiaType;

/**
 * Pacientepatologia controller.
 *
 */
class PacientepatologiaController extends Controller
{

    /**
     * Lists all Pacientepatologia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Pacientepatologia')->findAll();

        return $this->render('AsiClinicaBundle:Pacientepatologia:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Pacientepatologia entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pacientepatologia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pacientepatologia_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Pacientepatologia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pacientepatologia entity.
     *
     * @param Pacientepatologia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pacientepatologia $entity)
    {
        $form = $this->createForm(new PacientepatologiaType(), $entity, array(
            'action' => $this->generateUrl('pacientepatologia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Pacientepatologia entity.
     *
     */
    public function newAction()
    {
        $entity = new Pacientepatologia();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Pacientepatologia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pacientepatologia entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pacientepatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientepatologia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Pacientepatologia:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pacientepatologia entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pacientepatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientepatologia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Pacientepatologia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pacientepatologia entity.
    *
    * @param Pacientepatologia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pacientepatologia $entity)
    {
        $form = $this->createForm(new PacientepatologiaType(), $entity, array(
            'action' => $this->generateUrl('pacientepatologia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Pacientepatologia entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pacientepatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientepatologia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pacientepatologia_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Pacientepatologia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pacientepatologia entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Pacientepatologia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pacientepatologia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pacientepatologia'));
    }

    /**
     * Creates a form to delete a Pacientepatologia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pacientepatologia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
