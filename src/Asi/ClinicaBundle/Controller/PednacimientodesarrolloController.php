<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Pednacimientodesarrollo;
use Asi\ClinicaBundle\Form\PednacimientodesarrolloType;

/**
 * Pednacimientodesarrollo controller.
 *
 */
class PednacimientodesarrolloController extends Controller
{

    /**
     * Lists all Pednacimientodesarrollo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Pednacimientodesarrollo')->findAll();

        return $this->render('AsiClinicaBundle:Pednacimientodesarrollo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Pednacimientodesarrollo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Pednacimientodesarrollo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pednacimientodesarrollo_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Pednacimientodesarrollo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Pednacimientodesarrollo entity.
     *
     * @param Pednacimientodesarrollo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pednacimientodesarrollo $entity)
    {
        $form = $this->createForm(new PednacimientodesarrolloType(), $entity, array(
            'action' => $this->generateUrl('pednacimientodesarrollo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Pednacimientodesarrollo entity.
     *
     */
    public function newAction()
    {
        $entity = new Pednacimientodesarrollo();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Pednacimientodesarrollo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Pednacimientodesarrollo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pednacimientodesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pednacimientodesarrollo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Pednacimientodesarrollo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Pednacimientodesarrollo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pednacimientodesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pednacimientodesarrollo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Pednacimientodesarrollo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Pednacimientodesarrollo entity.
    *
    * @param Pednacimientodesarrollo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pednacimientodesarrollo $entity)
    {
        $form = $this->createForm(new PednacimientodesarrolloType(), $entity, array(
            'action' => $this->generateUrl('pednacimientodesarrollo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Pednacimientodesarrollo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Pednacimientodesarrollo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pednacimientodesarrollo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pednacimientodesarrollo_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Pednacimientodesarrollo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Pednacimientodesarrollo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Pednacimientodesarrollo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pednacimientodesarrollo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pednacimientodesarrollo'));
    }

    /**
     * Creates a form to delete a Pednacimientodesarrollo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pednacimientodesarrollo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
