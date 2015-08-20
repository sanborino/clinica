<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Disponibilidad;
use Asi\ClinicaBundle\Form\DisponibilidadType;

/**
 * Disponibilidad controller.
 *
 */
class DisponibilidadController extends Controller
{

    /**
     * Lists all Disponibilidad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clinicas = $this->getUsuarioClinicas();

        $entities = $em->getRepository('AsiClinicaBundle:Disponibilidad')->findByClinicasAndFechaFutura($clinicas);
        return $this->render('AsiClinicaBundle:Disponibilidad:index.html.twig', array(
            'entities' => $entities,
        ));
    }


    private function getUsuarioClinicas()
    {
        $personal = $this->getUser()->getIdpersonal();
        if (!$personal) {
            throw new AccessDeniedHttpException('No es personal.');
        }

        $pc = $personal->getPersonalclinica();
        if (!$pc) {
            throw new NotFoundHttpException('No pertenece a ningún consultorio');
        }
        $clinicas = array();

        foreach ($pc as $key => $value) {
            $clinicas[]=$value->getId();
        }

        return $clinicas;
    }

    /**
     * Creates a new Disponibilidad entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Disponibilidad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('disponibilidad_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Disponibilidad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Disponibilidad entity.
     *
     * @param Disponibilidad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Disponibilidad $entity)
    {
        $form = $this->createForm(new DisponibilidadType(), $entity, array(
            'action' => $this->generateUrl('disponibilidad_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Disponibilidad entity.
     *
     */
    public function newAction()
    {
        $entity = new Disponibilidad();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Disponibilidad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Disponibilidad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Disponibilidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Disponibilidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Disponibilidad:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Disponibilidad entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Disponibilidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Disponibilidad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Disponibilidad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Disponibilidad entity.
    *
    * @param Disponibilidad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Disponibilidad $entity)
    {
        $form = $this->createForm(new DisponibilidadType(), $entity, array(
            'action' => $this->generateUrl('disponibilidad_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        if ($this->getUser()->getIdtipousuario()->getNombre()==='Recepcionista') {
            $form->remove('fecha');
            $form->remove('idclinica');
            $form->remove('hora');
        }
        return $form;
    }
    /**
     * Edits an existing Disponibilidad entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Disponibilidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Disponibilidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $em->flush();

            // if ($entity->getDisponibilidad() === true) {
            //     $citas = $entity->getCitas();
            //     foreach ($citas as $cita) {
            //         if ($cita->getEstado()==='Pendiente') {
            //             $cita->setEstado('Cancelada');
            //             $em->persist($cita);
            //             $em->flush();
            //         }
            //     }
            // }

            return $this->redirect($this->generateUrl('disponibilidad_show', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Disponibilidad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Disponibilidad entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Disponibilidad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Disponibilidad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('disponibilidad'));
    }

    /**
     * Creates a form to delete a Disponibilidad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('disponibilidad_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }

    public function agendarCitaAction(){

        $em = $this->getDoctrine()->getManager();

        $disponibilidad = $em->getRepository('AsiClinicaBundle:Disponibilidad')->findAll();

        return $this->render('AsiClinicaBundle:Disponibilidad:agendar_cita.html.twig', array(
            'disponibilidad'      => $disponibilidad
        ));
    }
}
