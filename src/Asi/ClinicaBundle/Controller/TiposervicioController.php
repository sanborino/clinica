<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Tiposervicio;
use Asi\ClinicaBundle\Form\TiposervicioType;

/**
 * Tiposervicio controller.
 *
 */
class TiposervicioController extends Controller
{

    /**
     * Lists all Tiposervicio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Tiposervicio')->findAll();

        return $this->render('AsiClinicaBundle:Tiposervicio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tiposervicio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tiposervicio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tiposervicio_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Tiposervicio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tiposervicio entity.
     *
     * @param Tiposervicio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tiposervicio $entity)
    {
        $form = $this->createForm(new TiposervicioType(), $entity, array(
            'action' => $this->generateUrl('tiposervicio_create'),
            'method' => 'POST',
        ));
        $form->remove('estadoactivacion');
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Tiposervicio entity.
     *
     */
    public function newAction()
    {
        $entity = new Tiposervicio();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Tiposervicio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tiposervicio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tiposervicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tiposervicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tiposervicio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tiposervicio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tiposervicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tiposervicio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tiposervicio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tiposervicio entity.
    *
    * @param Tiposervicio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tiposervicio $entity)
    {
        $form = $this->createForm(new TiposervicioType(), $entity, array(
            'action' => $this->generateUrl('tiposervicio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Tiposervicio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tiposervicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tiposervicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tiposervicio_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Tiposervicio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tiposervicio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Tiposervicio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tiposervicio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tiposervicio'));
    }

    /**
     * Creates a form to delete a Tiposervicio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiposervicio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
