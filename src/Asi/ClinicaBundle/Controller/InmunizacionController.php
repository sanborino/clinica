<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Inmunizacion;
use Asi\ClinicaBundle\Form\InmunizacionType;

/**
 * Inmunizacion controller.
 *
 */
class InmunizacionController extends Controller
{

    /**
     * Lists all Inmunizacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Inmunizacion')->findAll();

        return $this->render('AsiClinicaBundle:Inmunizacion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Inmunizacion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Inmunizacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('inmunizacion_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Inmunizacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Inmunizacion entity.
     *
     * @param Inmunizacion $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Inmunizacion $entity)
    {
        $form = $this->createForm(new InmunizacionType(), $entity, array(
            'action' => $this->generateUrl('inmunizacion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->remove('idconsulta');
        return $form;
    }

    /**
     * Displays a form to create a new Inmunizacion entity.
     *
     */
    public function newAction()
    {
        $entity = new Inmunizacion();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Inmunizacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Inmunizacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Inmunizacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inmunizacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Inmunizacion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Inmunizacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Inmunizacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inmunizacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Inmunizacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Inmunizacion entity.
    *
    * @param Inmunizacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Inmunizacion $entity)
    {
        $form = $this->createForm(new InmunizacionType(), $entity, array(
            'action' => $this->generateUrl('inmunizacion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Inmunizacion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Inmunizacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Inmunizacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('inmunizacion_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Inmunizacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Inmunizacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Inmunizacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Inmunizacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('inmunizacion'));
    }

    /**
     * Creates a form to delete a Inmunizacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('inmunizacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
