<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Encargadopaciente;
//use Asi\ClinicaBundle\Form\EncargadopacienteType;
use Asi\ClinicaBundle\Form\RegistropacienteType;
use Asi\ClinicaBundle\Entity\Paciente;
use Asi\ClinicaBundle\Form\PacienteType;




/**
 * Encargadopaciente controller.
 *
 */
class RegistropacienteController extends Controller
{

    /**
     * Lists all Encargadopaciente entities.
     *
     */
    // public function indexAction()
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $entities = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->findAll();

    //     return $this->render('AsiClinicaBundle:Registropaciente:new.html.twig', array(
    //         'entities' => $entities,
    //     ));
    // }
    /**
     * Creates a new Encargadopaciente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Paciente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $entity->setIdusuario($this->getUser());
            $entity -> setFechacreacion(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $connection = $em->getConnection();
            $statement = $connection->prepare("SELECT DATEDIFF(sysdate(),fechaNacimiento) edad FROM clinica_db.paciente WHERE id = :id");
            $statement->bindValue('id', $entity->getId());
            $statement->execute();
            $results = $statement->fetch();

            $edad = $results['edad'];

            if ((int)$edad>6570){
                return $this->redirect($this->generateUrl('fos_user_profile_show', array('id' => $entity->getId())));
            }else{
                return $this->redirect($this->generateUrl('registropaciente_encargado'));
            }

        }

        return $this->render('AsiClinicaBundle:Registropaciente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Encargadopaciente entity.
     *
     * @param Encargadopaciente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Paciente $entity)
    {
           
        $form = $this->createForm(new PacienteType($this->getUser()->getIdTipoUsuario()->getNombre()), $entity, array(
            'action' => $this->generateUrl('registropaciente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Encargadopaciente entity.
     *
     */
    public function indexAction()
    {

        $entity = new Paciente();
        $form   = $this->createCreateForm($entity);

        return $this->render('AsiClinicaBundle:Registropaciente:new.html.twig', array(
            'entity' => $entity,
            'tipo' => 'paciente',
            'form'   => $form->createView(),
        ));
    }

    public function encargadoAction()
    {
        $entity = new Encargadopaciente();
        $form   = $this->createEncargadoForm($entity);

        return $this->render('AsiClinicaBundle:Registropaciente:new.html.twig', array(
            'entity' => $entity,
            'tipo' => 'encargado',
            'form'   => $form->createView(),
        ));
    }    

    private function createEncargadoForm(Encargadopaciente $entity)
    {
           
        $form = $this->createForm(new RegistropacienteType($this->getUser()->getIdTipoUsuario()->getNombre()), $entity, array(
            'action' => $this->generateUrl('registropaciente_encargadocrear'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->remove('idpaciente');
        return $form;
    }

    public function createEncargadoAction(Request $request)
    {
        $entity = new Encargadopaciente();
        $form = $this->createEncargadoForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneByIdusuario($this->getUser()->getId());
            
            $entity->setIdpaciente($paciente);
            $em->persist($entity);
            $em->flush();

        }

        return $this->redirect($this->generateUrl('asi_clinica_paciente'));
    }
    /**
     * Finds and displays a Encargadopaciente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encargadopaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Registropaciente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Encargadopaciente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encargadopaciente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Registropaciente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Encargadopaciente entity.
    *
    * @param Encargadopaciente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Paciente $entity)
    {
        $form = $this->createForm(new PacienteType(), $entity, array(
            'action' => $this->generateUrl('registropaciente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }
    /**
     * Edits an existing Encargadopaciente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Encargadopaciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('registropaciente_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Registropaciente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Encargadopaciente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Encargadopaciente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Encargadopaciente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('registropaciente'));
    }

    /**
     * Creates a form to delete a Encargadopaciente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registropaciente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }
}
