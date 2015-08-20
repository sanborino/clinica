<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Especialidad;
use Asi\ClinicaBundle\Form\EspecialidadType;

/**
 * Especialidad controller.
 *
 */
class EspecialidadController extends Controller
{

    /**
     * Lists all Especialidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Especialidad')->findAll();

        return $this->render('AsiClinicaBundle:Especialidad:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Especialidad entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Especialidad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('especialidad_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Especialidad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Especialidad entity.
     *
     * @param Especialidad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Especialidad $entity)
    {
        $form = $this->createForm(new EspecialidadType(), $entity, array(
            'action' => $this->generateUrl('especialidad_create'),
            'method' => 'POST',
        ));
        $form->remove('estadoactivacion');
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Especialidad entity.
     *
     */
    public function newAction()
    {
        $entity = new Especialidad();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Especialidad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Especialidad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Especialidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Especialidad:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Especialidad entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Especialidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Especialidad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Especialidad entity.
    *
    * @param Especialidad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Especialidad $entity)
    {
        $form = $this->createForm(new EspecialidadType(), $entity, array(
            'action' => $this->generateUrl('especialidad_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Especialidad entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Especialidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('especialidad_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Especialidad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Especialidad entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Especialidad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Especialidad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('especialidad'));
    }

    /**
     * Creates a form to delete a Especialidad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('especialidad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
