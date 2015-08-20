<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Asi\ClinicaBundle\Entity\Pacientepatologia;
use Asi\ClinicaBundle\Form\PacientepatologiaType;
use Asi\ClinicaBundle\Entity\Inmunizacion;
use Asi\ClinicaBundle\Form\InmunizacionType;
use Asi\ClinicaBundle\Entity\Pednacimientodesarrollo;
use Asi\ClinicaBundle\Form\PednacimientodesarrolloType;
use Asi\ClinicaBundle\Entity\Paciente;
use Asi\ClinicaBundle\Form\PacienteType;

/**
 * Departamento controller.
 *
 */
class ExpedienteController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clinicas = $this->getUsuarioClinicas();

        // $pacientes = $em->getRepository('AsiClinicaBundle:Paciente')->findAllByClinicas($clinicas);
        $pacientes = $em->getRepository('AsiClinicaBundle:Paciente')->findAll();
        return $this->render('AsiClinicaBundle:Expediente:index.html.twig', array(
            'pacientes' => $pacientes,
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

    public function pacienteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneById($id);

        if (!$paciente) {
            throw new AccessDeniedHttpException("Denegado");
        }
        return $this->render('AsiClinicaBundle:Expediente:menu.html.twig', array(
            'id' => $id,
            'paciente' => $paciente
        ));
    }

    public function pacientePatologiaAction($id)
    {
        $pacientepatologia = new Pacientepatologia();
        $form   = $this->patologiaForm($id, $pacientepatologia);

        return $this->render('AsiClinicaBundle:Expediente:patologia.html.twig', array(
            'id' => $id,
            'pacientepatologia' => $pacientepatologia,
            'form'   => $form->createView(),
        ));
    }

    private function patologiaForm($id, Pacientepatologia $pacientepatologia)
    {
        $form = $this->createForm(new PacientepatologiaType(), $pacientepatologia, array(
            'action' => $this->generateUrl('recepcion_expediente_paciente_patologia_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agregar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('importante');
        $form->remove('idpaciente');
        return $form;
    }

    public function pacientePatologiaCreateAction($id, Request $request)
    {
        $pacientepatologia = new Pacientepatologia();
        $form = $this->patologiaForm($id, $pacientepatologia);
        

        $em = $this->getDoctrine()->getManager();

        $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneById($id);
        if (!$paciente) {
            throw new AccessDeniedHttpException('Paciente no encontrado.');  
        }
        $pacientepatologia->setIdpaciente($paciente);
        $form->handleRequest($request);

        if ($form->isValid()) {

            
            $pacientepatologia->setImportante(true);
            $em->persist($pacientepatologia);
            $em->flush();

            return $this->redirect($this->generateUrl('recepcion_expediente_paciente', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Expediente:patologia.html.twig', array(
            'id'=>$id,
            'pacientepatologia' => $pacientepatologia,
            'form'   => $form->createView(),
        ));
    }

    public function inmunizacionAction($id)
    {
        $inmunizacion = new Inmunizacion();
        $form   = $this->inmunizacionForm($id, $inmunizacion);

        return $this->render('AsiClinicaBundle:Expediente:inmunizacion.html.twig', array(
            'id' => $id,
            'inmunizacion' => $inmunizacion,
            'form'   => $form->createView(),
        ));
    }

    private function inmunizacionForm($id, Inmunizacion $inmunizacion)
    {
        $form = $this->createForm(new InmunizacionType(), $inmunizacion, array(
            'action' => $this->generateUrl('recepcion_expediente_paciente_inmunizacion_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agregar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('idconsulta');
        $form->remove('idpaciente');
        return $form;
    }

    public function inmunizacionCreateAction($id, Request $request)
    {

        $inmunizacion = new Inmunizacion();
        $form = $this->inmunizacionForm($id, $inmunizacion);
        $em = $this->getDoctrine()->getManager();
        $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneById($id);
        if (!$paciente) {
            throw new AccessDeniedHttpException('Paciente no encontrado.');  
        }
        $inmunizacion->setIdpaciente($paciente);

        $form->handleRequest($request);
        
        if ($form->isValid()) {

            

            
            $em->persist($inmunizacion);
            $em->flush();

            return $this->redirect($this->generateUrl('recepcion_expediente_paciente', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Expediente:inmunizacion.html.twig', array(
            'id'=>$id,
            'inmunizacion' => $inmunizacion,
            'form'   => $form->createView(),
        ));
    }

public function pednacimientodesarrolloAction($id)
    {
        $pednacimientodesarrollo = new Pednacimientodesarrollo();
        $form = $this->pednacimientodesarrolloForm($id, $pednacimientodesarrollo);
        $em = $this->getDoctrine()->getManager();

        $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneById($id);

        if ($paciente->getPednacimientodesarrollo()) {
            throw new AccessDeniedHttpException('Paciente ya tiene datos de pediatría.');
        }

        return $this->render('AsiClinicaBundle:Expediente:pednacimientodesarrollo.html.twig', array(
            'id' => $id,
            'pednacimientodesarrollo' => $pednacimientodesarrollo,
            'form'   => $form->createView(),
        ));
    }

    private function pednacimientodesarrolloForm($id, Pednacimientodesarrollo $pednacimientodesarrollo)
    {
        $form = $this->createForm(new PednacimientodesarrolloType(), $pednacimientodesarrollo, array(
            'action' => $this->generateUrl('recepcion_expediente_paciente_pednacimientodesarrollo_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agregar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('idpaciente');
        return $form;
    }

    public function pednacimientodesarrolloCreateAction($id, Request $request)
    {
        $pednacimientodesarrollo = new Pednacimientodesarrollo();
        $form = $this->pednacimientodesarrolloForm($id, $pednacimientodesarrollo);
        $form->handleRequest($request);


        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneById($id);
            if (!$paciente) {
                throw new AccessDeniedHttpException('Paciente no encontrado.');  
            }
            $pednacimientodesarrollo->setIdpaciente($paciente);
            $em->persist($pednacimientodesarrollo);
            $em->flush();

            return $this->redirect($this->generateUrl('recepcion_expediente_paciente', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Expediente:pednacimientodesarrollo.html.twig', array(
            'id'=>$id,
            'pednacimientodesarrollo' => $pednacimientodesarrollo,
            'form'   => $form->createView(),
        ));
    }

    public function datosPacienteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneById($id);

        if (!$paciente) {
            throw new AccessDeniedHttpException("Denegado");
        }
        return $this->render('AsiClinicaBundle:Expediente:expediente.html.twig', array(
            'id' => $id,
            'paciente' => $paciente
        ));
    }

    
    /////////Paciente

    public function showPacienteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AsiClinicaBundle:Paciente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function newPacienteAction()
    {
        $entity = new Paciente();
        $form   = $this->createPacienteCreateForm($entity);
        
        return $this->render('AsiClinicaBundle:Paciente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function createPacienteAction(Request $request)
    {
        $entity = new Paciente();
        $form = $this->createPacienteCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('recepcion_paciente_show', array('id' => $entity->getId())));
        }

        return $this->render('AsiClinicaBundle:Paciente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editPacienteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }

        $editForm = $this->createPacienteEditForm($entity);


        return $this->render('AsiClinicaBundle:Paciente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),

        ));
    }

    public function updatePacienteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Paciente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Paciente entity.');
        }


        $editForm = $this->createPacienteEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('recepcion_paciente_edit', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:Paciente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),

        ));
    }

    private function createPacienteEditForm(Paciente $entity)
    {
        $form = $this->createForm(new PacienteType(), $entity, array(
            'action' => $this->generateUrl('recepcion_paciente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ACTUALIZAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->remove('idusuario');
        return $form;
    }

    private function createPacienteCreateForm(Paciente $entity)
    {
        $form = $this->createForm(new PacienteType(), $entity, array(
            'action' => $this->generateUrl('recepcion_paciente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'CREAR', 'attr' => array('class' => 'round button blue text-upper small-button')));
        $form->get('idusuario')->remove('estadoactivacion');
        $form->get('idusuario')->remove('idtipousuario');
        return $form;
    }
}
