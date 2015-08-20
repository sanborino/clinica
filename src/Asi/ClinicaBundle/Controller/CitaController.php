<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Cita;
use Asi\ClinicaBundle\Form\CitaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
/**
 * Cita controller.
 *
 */
class CitaController extends Controller
{

    /**
     * Lists all Cita entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->getUser()->getIdtipousuario()->getNombre()==='Administrador') {
            $entities = $em->getRepository('AsiClinicaBundle:Cita')->findAll();    
        } else {
            $entities = $em->getRepository('AsiClinicaBundle:Cita')->findCitaByClinica($this->getUsuarioClinicas());
        }
        

        return $this->render('AsiClinicaBundle:Cita:index.html.twig', array(
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
     * Creates a new Cita entity.
     *
     */
    public function createAction(Request $request, $id=null)
    {
        $entity = new Cita();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createCreateForm($entity);
        $user = $this->get('security.context')->getToken()->getUser();
        if ($user->getIdtipousuario()->getNombre()==='Paciente') {
            $paciente = $user->getIdpaciente();
            $disponibilidad = $em->getRepository('AsiClinicaBundle:Disponibilidad')->findOneById($id);
            $entity->setIdDisponibilidad($disponibilidad, $paciente);

        $form = $this->createForm(new CitaType($disponibilidad, $paciente), $entity, array(
            'action' => $this->generateUrl('cita_create', array("id" => $id)),
            'method' => 'POST',
        ));
        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        }

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($this->getUser()->getIdtipousuario()->getNombre()==='Paciente') {
                $this->pacienteTieneCita($entity->getIdDisponibilidad()->getFecha());
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            if ($this->getUser()->getIdtipousuario()->getNombre()==='Paciente') {
                return $this->redirect($this->generateUrl('cita_historial'));
            }
            return $this->redirect($this->generateUrl('cita_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Cita:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    private function pacienteTieneCita($fecha)
    {
        $em = $this->getDoctrine()->getManager();
        $yatienecita = $em->getRepository('AsiClinicaBundle:Cita')->findCitaByPacienteAndFecha($this->getUser()->getIdpaciente()->getId(), $fecha);

        if (count($yatienecita)>0) {
            throw new AccessDeniedHttpException('Ya ha creado una cita para esta fecha.');
        }
        return true;
    }

    /**
     * Creates a form to create a Cita entity.
     *
     * @param Cita $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cita $entity)
    {
        
        $form = $this->createForm(new CitaType(), $entity, array(
            'action' => $this->generateUrl('recepcion_cita_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $form;
    }

    /**
     * Displays a form to create a new Cita entity.
     *
     */
    public function newAction()
    {

        $entity = new Cita();

        $form   = $this->createCreateForm($entity);


        return $this->render('AsiClinicaBundle:Cita:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cita entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Cita')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cita entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Cita:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cita entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Cita')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cita entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Cita:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Cita entity.
    *
    * @param Cita $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cita $entity)
    {
        $form = $this->createForm(new CitaType(), $entity, array(
            'action' => $this->generateUrl('cita_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        $form -> remove('idpaciente');

        return $form;
    }
    /**
     * Edits an existing Cita entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Cita')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cita entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cita_show', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Cita:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cita entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AsiClinicaBundle:Cita')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cita entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cita'));
    }

    /*
     * Creates a form to delete a Cita entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cita_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'ELIMINAR', 'attr' => array('class' => 'round button blue text-upper small-button')))
            ->getForm()
        ;
    }

    public function crearCitaAction(){

        $em = $this->getDoctrine()->getManager();

        $especialidad = $em->getRepository('AsiClinicaBundle:Especialidad')->findEspecialidadDisponible();
        return $this->render('AsiClinicaBundle:Disponibilidad:agendar_cita.html.twig', array(
            'especialidad'      => $especialidad
        ));
    }

    public function crearAction($idDisponibilidad)
    {

        $em = $this->getDoctrine()->getManager();

        $disponibilidad = $em->getRepository('AsiClinicaBundle:Disponibilidad')->find($idDisponibilidad);
        
        $user = $this->get('security.context')->getToken()->getUser()->getId();

        $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findByIdusuario($user);

        $entity = new Cita();

        $entity->setIdDisponibilidad($disponibilidad, $paciente);

        $form = $this->createForm(new CitaType($disponibilidad, $paciente), $entity, array(
            'action' => $this->generateUrl('cita_create', array('id'=>$idDisponibilidad)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));

        return $this->render('AsiClinicaBundle:Cita:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cita entity.
     *
     */
    public function historialAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paciente = $this->getUser()->getIdpaciente();

        $entity = $em->getRepository('AsiClinicaBundle:Cita')->findByIdpaciente($paciente);

        return $this->render('AsiClinicaBundle:Cita:historial.html.twig', array(
            'entities'      => $entity,
        ));
    }

    public function getClinicasAction(Request $request)
    {
        $idespecialidad = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();

        $clinicas = $em->getRepository('AsiClinicaBundle:Clinica')
            ->findByIdespecialidad($idespecialidad)
        ;

        foreach ($clinicas as $key => $value) {
            $lista[] =array ('id' => $value->getId(), 'nombre' => $value->getNombre());
        }

        $response = new Response (json_encode($lista));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getDisponibilidadesAction(Request $request)
    {
        $idclinica = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();

        $disponibilidades = $em->getRepository('AsiClinicaBundle:Disponibilidad')->findByIdclinicaAndFechaFutura($idclinica);
        //$disponibilidades = $em->getRepository('AsiClinicaBundle:Disponibilidad')->findByIdclinica($idclinica);
        if (!$disponibilidades) {
            $response = new Response (json_encode(null));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        foreach ($disponibilidades as $key => $value) {
            $lista[] =array (
                // 'id' => $value->getId(), 
                'hora' => $value->getHora()->format('H:i'), 
                'fecha' => $value->getFecha()->format('Y-m-d'),
                'clinica' => $value->getIdclinica()->getNombre(),
                'disponibilidad' => $value->getDisponibilidad(),
                'url' => $this->getDisponibilidadLink($value->getDisponibilidad(), $value->getId())
                );
        }

        $response = new Response (json_encode($lista));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    private function getDisponibilidadLink($disponible, $id)
    {
        $link = null;
        if ($disponible) {
            $link = $this->generateUrl('cita_crear', array('idDisponibilidad'=>$id));
        }

        return $link;
    }

    public function cancelarAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Cita')->findOneById($id);

        $entity->setEstado('Cancelada');
        $entity->getIdDisponibilidad()->setDisponibilidad('1');
        $em->persist($entity);
        $em->flush();
        

        return $this->redirect($this->generateUrl('recepcion_citas'));

    }


}