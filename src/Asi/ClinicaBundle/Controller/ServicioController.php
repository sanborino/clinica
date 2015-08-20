<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Servicio;
use Asi\ClinicaBundle\Entity\Vacuna;
use Asi\ClinicaBundle\Entity\Medicamento;
use Asi\ClinicaBundle\Entity\Examen;
use Asi\ClinicaBundle\Form\ServicioType;
use Asi\ClinicaBundle\Form\MedicamentoType;
use Asi\ClinicaBundle\Form\VacunaType;
use Asi\ClinicaBundle\Form\ExamenType;
use Asi\ClinicaBundle\Entity\Tiposervicio;
use Symfony\Component\HttpFoundation\Response;

/**
 * Servicio controller.
 *
 */
class ServicioController extends Controller
{

    /**
     * Lists all Servicio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Servicio')->findAll();

        return $this->render('AsiClinicaBundle:Servicio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Servicio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Servicio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('servicio_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Servicio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Servicio entity.
     *
     * @param Servicio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Servicio $entity)
    {
        $form = $this->createForm(new ServicioType(null), $entity, array(
            'action' => $this->generateUrl('servicio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Servicio entity.
     *
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('AsiClinicaBundle:Tiposervicio')->findAll();
        //$form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Servicio:new.html.twig', array('entities' => $entities ));/*, array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));*/
    }

    public function getServicioFormAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tiposerv = $em->getRepository('AsiClinicaBundle:Tiposervicio')->findOneById($request->request->get('id'));
        if ($tiposerv === null) {
                return new Response('No');
        } else {
            switch ($tiposerv->getNombre()) {
                case 'Medicamento':
                    $entity = new Medicamento();
                    $form = $this->createMedicamentoForm($entity, $tiposerv);
                    break;
                case 'Examen':
                    $entity = new Examen();
                    $form = $this->createExamenForm($entity, $tiposerv);
                    break;
                case 'Vacuna':
                    $entity = new Vacuna();
                    $form = $this->createVacunaForm($entity, $tiposerv);
                    break;
                default:
                    $entity = new Servicio();
                    $form = $this->createCreateForm($entity, $tiposerv);    
                    break;
            }
        }

        return $this->render('AsiClinicaBundle:Servicio:form.html.twig', array(
            //'entity' => $entity,
            'form' => $form->createView()
        ));

    }

    private function createMedicamentoForm(Medicamento $entity, Tiposervicio $entityserv)
    {
        $form = $this->createForm(new MedicamentoType($entityserv), $entity, array(
            'action' => $this->generateUrl('medicamento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->remove('estadoactivacion');
        return $form;
    }

    private function createExamenForm(Examen $entity, Tiposervicio $entityserv)
    {
        $form = $this->createForm(new ExamenType($entityserv), $entity, array(
            'action' => $this->generateUrl('examen_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->remove('estadoactivacion');
        return $form;
    }

    private function createVacunaForm(Vacuna $entity, Tiposervicio $entityserv)
    {
        $form = $this->createForm(new VacunaType($entityserv), $entity, array(
            'action' => $this->generateUrl('vacuna_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->remove('estadoactivacion');
        return $form;
    }

    /**
     * Finds and displays a Servicio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Servicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Servicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Servicio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Servicio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Servicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Servicio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Servicio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Servicio entity.
    *
    * @param Servicio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Servicio $entity)
    {
        $form = $this->createForm(new ServicioType(), $entity, array(
            'action' => $this->generateUrl('servicio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Servicio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Servicio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Servicio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('servicio_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Servicio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Servicio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Servicio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Servicio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('servicio'));
    }

    /**
     * Creates a form to delete a Servicio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('servicio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
