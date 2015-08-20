<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Personalclinica;
use Asi\ClinicaBundle\Form\PersonalclinicaType;

/**
 * Personalclinica controller.
 *
 */
class PersonalclinicaController extends Controller
{

    /**
     * Lists all Personalclinica entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Personalclinica')->findAll();

        return $this->render('AsiClinicaBundle:Personalclinica:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Personalclinica entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Personalclinica();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('personalclinica_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Personalclinica:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Personalclinica entity.
     *
     * @param Personalclinica $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Personalclinica $entity)
    {
        $form = $this->createForm(new PersonalclinicaType(), $entity, array(
            'action' => $this->generateUrl('personalclinica_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Personalclinica entity.
     *
     */
    public function newAction()
    {
        $entity = new Personalclinica();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Personalclinica:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Personalclinica entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Personalclinica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personalclinica entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Personalclinica:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Personalclinica entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Personalclinica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personalclinica entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Personalclinica:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Personalclinica entity.
    *
    * @param Personalclinica $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Personalclinica $entity)
    {
        $form = $this->createForm(new PersonalclinicaType(), $entity, array(
            'action' => $this->generateUrl('personalclinica_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Personalclinica entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Personalclinica')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Personalclinica entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('personalclinica_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Personalclinica:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Personalclinica entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Personalclinica')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Personalclinica entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('personalclinica'));
    }

    /**
     * Creates a form to delete a Personalclinica entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('personalclinica_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
