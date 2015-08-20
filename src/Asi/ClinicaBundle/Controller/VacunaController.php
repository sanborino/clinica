<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Vacuna;
use Asi\ClinicaBundle\Form\VacunaType;

/**
 * Vacuna controller.
 *
 */
class VacunaController extends Controller
{

    /**
     * Lists all Vacuna entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Vacuna')->findAll();

        return $this->render('AsiClinicaBundle:Vacuna:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Vacuna entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Vacuna();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vacuna_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Vacuna:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Vacuna entity.
     *
     * @param Vacuna $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vacuna $entity)
    {
        $en=$this->getDoctrine()->getManager()->getRepository('AsiClinicaBundle:Tiposervicio')->findOneByNombre('Vacuna');
        $form = $this->createForm(new VacunaType($en), $entity, array(
            'action' => $this->generateUrl('vacuna_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->remove('estadoactivacion');
        return $form;
    }

    /**
     * Displays a form to create a new Vacuna entity.
     *
     */
    public function newAction()
    {
        $entity = new Vacuna();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Vacuna:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Vacuna entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Vacuna:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Vacuna entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Vacuna:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Vacuna entity.
    *
    * @param Vacuna $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vacuna $entity)
    {
        $form = $this->createForm(new VacunaType(), $entity, array(
            'action' => $this->generateUrl('vacuna_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Vacuna entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Vacuna')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vacuna entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vacuna_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Vacuna:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Vacuna entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Vacuna')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vacuna entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vacuna'));
    }

    /**
     * Creates a form to delete a Vacuna entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vacuna_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
