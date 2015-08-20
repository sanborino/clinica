<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Diagnosticopatologia;
use Asi\ClinicaBundle\Form\DiagnosticopatologiaType;

/**
 * Diagnosticopatologia controller.
 *
 */
class DiagnosticopatologiaController extends Controller
{

    /**
     * Lists all Diagnosticopatologia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->findAll();

        return $this->render('AsiClinicaBundle:Diagnosticopatologia:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Diagnosticopatologia entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Diagnosticopatologia();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('diagnosticopatologia_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Diagnosticopatologia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Diagnosticopatologia entity.
     *
     * @param Diagnosticopatologia $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Diagnosticopatologia $entity)
    {
        $form = $this->createForm(new DiagnosticopatologiaType(), $entity, array(
            'action' => $this->generateUrl('diagnosticopatologia_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Diagnosticopatologia entity.
     *
     */
    public function newAction()
    {
        $entity = new Diagnosticopatologia();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Diagnosticopatologia:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Diagnosticopatologia entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnosticopatologia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Diagnosticopatologia:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Diagnosticopatologia entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnosticopatologia entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Diagnosticopatologia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Diagnosticopatologia entity.
    *
    * @param Diagnosticopatologia $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Diagnosticopatologia $entity)
    {
        $form = $this->createForm(new DiagnosticopatologiaType(), $entity, array(
            'action' => $this->generateUrl('diagnosticopatologia_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Diagnosticopatologia entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Diagnosticopatologia entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('diagnosticopatologia_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Diagnosticopatologia:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Diagnosticopatologia entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Diagnosticopatologia entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('diagnosticopatologia'));
    }

    /**
     * Creates a form to delete a Diagnosticopatologia entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diagnosticopatologia_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
