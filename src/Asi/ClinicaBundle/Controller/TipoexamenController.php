<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Tipoexamen;
use Asi\ClinicaBundle\Form\TipoexamenType;

/**
 * Tipoexamen controller.
 *
 */
class TipoexamenController extends Controller
{

    /**
     * Lists all Tipoexamen entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Tipoexamen')->findAll();

        return $this->render('AsiClinicaBundle:Tipoexamen:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tipoexamen entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Tipoexamen();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipoexamen_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Tipoexamen:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Tipoexamen entity.
     *
     * @param Tipoexamen $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tipoexamen $entity)
    {
        $form = $this->createForm(new TipoexamenType(), $entity, array(
            'action' => $this->generateUrl('tipoexamen_create'),
            'method' => 'POST',
        ));
        $form->remove('estadoactivacion');
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Tipoexamen entity.
     *
     */
    public function newAction()
    {
        $entity = new Tipoexamen();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Tipoexamen:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tipoexamen entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipoexamen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipoexamen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tipoexamen:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tipoexamen entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipoexamen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipoexamen entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Tipoexamen:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Tipoexamen entity.
    *
    * @param Tipoexamen $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tipoexamen $entity)
    {
        $form = $this->createForm(new TipoexamenType(), $entity, array(
            'action' => $this->generateUrl('tipoexamen_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Tipoexamen entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Tipoexamen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipoexamen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tipoexamen_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Tipoexamen:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tipoexamen entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Tipoexamen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipoexamen entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipoexamen'));
    }

    /**
     * Creates a form to delete a Tipoexamen entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tipoexamen_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
