<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Asi\ClinicaBundle\Form\ConsultaType;
use Asi\ClinicaBundle\Form\DiagnosticopatologiaType;
use Asi\ClinicaBundle\Form\DetallefacturaType;
use Asi\ClinicaBundle\Form\PacientepatologiaType;
use Asi\ClinicaBundle\Form\InmunizacionType;
use Asi\ClinicaBundle\Entity\Consulta;
use Asi\ClinicaBundle\Entity\Consultaitem;
use Asi\ClinicaBundle\Entity\Diagnosticopatologia;
use Asi\ClinicaBundle\Entity\Pacientepatologia;
use Asi\ClinicaBundle\Entity\Paciente;
use Asi\ClinicaBundle\Entity\Factura;
use Asi\ClinicaBundle\Entity\Detallefactura;
use Asi\ClinicaBundle\Entity\Inmunizacion;
use Asi\ClinicaBundle\Entity\Cita;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ModuloMedicoController extends Controller
{
    public function indexAction()
    {
        return $this->render('AsiClinicaBundle:ModuloMedico:index.html.twig');
    }

    //Muestra la agenda por cada uno de los medicos

    public function mostrarAgendaAction()
    {
    	$medico = $this->isMedico();

        $clinicas = $this->getClinicasMedico($medico);

        $em = $this->getDoctrine()->getManager();

        $cita= $em->getRepository('AsiClinicaBundle:Cita')->findCitaByClinica($clinicas);

        return $this->render('AsiClinicaBundle:ModuloMedico:agendaMedico.html.twig', array(
            'cita'      => $cita
        ));
    }

    public function getClinicasMedico($medico)
    {
        $em=$this->getDoctrine()->getManager();

        $idpersonal = $medico->getIdpersonal()->getId();

        $clinicapersonal = $em->getRepository('AsiClinicaBundle:Personalclinica')->findByIdpersonal($idpersonal);
        $clinicas = array();
        foreach ($clinicapersonal as $clinica) {
            $clinicas[]=$clinica->getIdclinica()->getId();
        }

        return $clinicas;
    }    

    ////Fase 1
    public function consultaAction($id){
        
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);

        if (!$consulta) {
            $consulta = $this->nuevaConsulta($id);
        }

        $form = $this->createEditForm($consulta);

        return $this->render('AsiClinicaBundle:ModuloMedico:consulta.html.twig', array(
            'form'      => $form->createView()
        ));
    }

    /**
     * Creates a form to create a Consulta entity.
     *
     * @param Consulta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Consulta $entity)
    {
        $form = $this->createForm(new ConsultaType(), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->remove('fecha');
        $form->remove('hora');
        $form->remove('idcita');
        $form->remove('idfactura');
        $form->add('submit', 'submit', array('label' => 'Siguiente', 'attr' => array('class' => 'round button blue small-button image-right ic-right-arrow')));

        return $form;
    }

    
    private function crearFactura(Paciente $entity)
    {
        $factura = new Factura();
        
        $factura->setTitular($entity->getNombreApellido());
        $factura->setFechahoraemision(new \DateTime('now'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($factura);
        $em->flush();

        return $factura;
    }

    private function nuevaConsulta($idcita)
    {
        $medico = $this ->isMedico();

        $em = $this->getDoctrine()->getManager();
        
        $cita = $this->citaDisponible($idcita, true);

        $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneById($cita->getIdpaciente());

        $factura = $this->crearFactura($paciente);


        $em->getConnection()->beginTransaction();
        
        try {

        $consulta = new Consulta();
        
        $consulta->setIdcita($cita);
        $consulta->setIdfactura($factura);
        $consulta->setFecha(new \DateTime('now'));
        $consulta->setHora(new \DateTime('now'));
        $consulta->setIdmedico($medico);

        $cita->setEstado('Procesando');

        $servicio = $em->getRepository('AsiClinicaBundle:Servicio')->findOneByNombre('Consulta');
        if ($servicio) {
            $detallefactura = new Detallefactura();
            $detallefactura->setIdservicio($servicio);
            $detallefactura->setIdfactura($factura);
            $detallefactura->setFacturado(true);
            $detallefactura->setDescuento(0);
            $detallefactura->setPrecio($servicio->getPrecio());
            $detallefactura->setCantidad(1);

            $em->persist($detallefactura);
        }
        
        $em->persist($cita);
        $em->persist($consulta);
        $em->flush();

        $em->getConnection()->commit();
            
        } catch (\Exception $e) {
            $em->getConnection()->rollback();
            throw $e; 
        }

        return $consulta;
    }

    private function citaDisponible($idcita, $primeravez=false)
    {
        $em = $this->getDoctrine()->getManager();
        $cita = $em->getRepository('AsiClinicaBundle:Cita')->findOneById($idcita);
        if (!$cita) {
            throw $this->createNotFoundException('Cita inexistente.');
        }

        $idclinica = $cita->getIdDisponibilidad()->getIdclinica()->getId();

        $usuario = $this->getUser()->getId();
        $idpersonal = $em->getRepository('AsiClinicaBundle:Personal')->findOneByIdusuario($usuario)->getId();

        $personalclinica = $em->getRepository('AsiClinicaBundle:Personalclinica')->findByPersonalAndClinica($idpersonal ,$idclinica);

        if (!$personalclinica) {
            throw new AccessDeniedHttpException('No pertenece a este consultorio.');
        }

        $estadocita = $cita->getEstado();

        if ($primeravez===true) {
            $check = $estadocita==='Pendiente';
        } else {
            $check = $estadocita==='Procesando';
        }

        if ($check===false) {
            throw new AccessDeniedHttpException(sprintf('Cita %s.', $estadocita));
        }
        return $cita;
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AsiClinicaBundle:Consulta')->find($id);

        $editForm = $this->createEditForm($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Consulta inexistente.');
        }
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('modulomedico_consulta_menu', array(
                'id' => $entity->getIdcita()->getId()
            )));

        }

        return $this->render('AsiClinicaBundle:ModuloMedico:consulta.html.twig', array(
            'form'      => $editForm->createView()
        ));
    }


    private function isMedico()
    {
        $usuario = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $personal = $em->getRepository('AsiClinicaBundle:Personal')->findOneByIdusuario($usuario);
        if (!$personal) {
            throw new AccessDeniedHttpException('No es personal ;)');
        }

        $medico = $em->getRepository('AsiClinicaBundle:Medico')->findOneByIdpersonal($personal->getId());

        if (!$medico) {
            throw new AccessDeniedHttpException('No es médico');
        }
        return $medico;
    }


    public function menuConsultaAction($id)
    {
        $cita=$this->citaDisponible($id);

        $em = $this->getDoctrine()->getManager();

        
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();

        $estadoitems = $this->getEstadoItems($idconsulta, $cita);
        $estadopatologias = $this->getEstadoPatologias($idconsulta);
        $estadoinmunizaciones = $this->getEstadoInmunizaciones($idconsulta);
        $estadoexamenes = $this->getEstadoExamenes($idconsulta);
        $estadorecetas = $this->getEstadoRecetas($idconsulta);

        return $this->render('AsiClinicaBundle:ModuloMedico:menuconsulta.html.twig', array(
            'id'=>$id,
            'estadoitems'=>$estadoitems, //0 = no hay items para especialidad, 1 = no se han agregado datos, 2 = se han agregado datos
            'estadopatologias'=>$estadopatologias,
            'estadoinmunizaciones'=>$estadoinmunizaciones,
            'estadoexamenes'=>$estadoexamenes,
            'estadorecetas'=>$estadorecetas
        ));
    }

    private function getEstadoItems($idconsulta, Cita $cita)
    {
        $em = $this->getDoctrine()->getManager();
        $items = $this->getItemsLista($cita);

        $estadoitems = 0;
        if ($items) {
            $estadoitems = 1;
            
            $tieneitems = $em->getRepository('AsiClinicaBundle:Consultaitem')->consultaTieneItems($idconsulta);
            if ($tieneitems[1]>0) {
                $estadoitems = 2;
            }
        }
        return $estadoitems;
    }

    private function getEstadoPatologias($idconsulta)
    {
        $em = $this->getDoctrine()->getManager();
        $patologias = $em->getRepository('AsiClinicaBundle:Patologia')->cantidadPatologias();

        $estadopatologias = 0;
        if ($patologias[1]>0) {
            $estadopatologias = 1;

            $tienepatologias = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->consultaTienePatologias($idconsulta);
            if ($tienepatologias[1]>0) {
                $estadopatologias = 2;
            }
        }
        return $estadopatologias;
    }

    private function getEstadoInmunizaciones($idconsulta)
    {
        $em = $this->getDoctrine()->getManager();
        $vacunas = $em->getRepository('AsiClinicaBundle:Vacuna')->cantidadVacunas();

        $estadoinmunizaciones = 0;
        if ($vacunas[1]>0) {
            $estadoinmunizaciones = 1;

            $tieneinmunizaciones = $em->getRepository('AsiClinicaBundle:Inmunizacion')->consultaTieneInmunizaciones($idconsulta);
            if ($tieneinmunizaciones[1]>0) {
                $estadoinmunizaciones = 2;
            }
        }
        return $estadoinmunizaciones;
    }

    private function getEstadoExamenes($idconsulta)
    {
        $em = $this->getDoctrine()->getManager();
        $vacunas = $em->getRepository('AsiClinicaBundle:Examen')->cantidadExamenes();

        $estadoexamenes = 0;
        if ($vacunas[1]>0) {
            $estadoexamenes = 1;

            $factura = $em->getRepository('AsiClinicaBundle:Consulta')->findOneById($idconsulta)->getIdfactura();
            $tieneexamenes = $em->getRepository('AsiClinicaBundle:Detallefactura')->findExamenesByFactura($factura->getId());

            if (count($tieneexamenes)>0) {
                $estadoexamenes = 2;
            }
        }
        return $estadoexamenes;
    }

    private function getEstadoRecetas($idconsulta)
    {
        $em = $this->getDoctrine()->getManager();
        $medicamentos = $em->getRepository('AsiClinicaBundle:Medicamento')->cantidadMedicamentos();

        $estadorecetas = 0;
        if ($medicamentos[1]>0) {
            $estadorecetas = 1;

            $factura = $em->getRepository('AsiClinicaBundle:Consulta')->findOneById($idconsulta)->getIdfactura();
            $tienemedicamentos = $em->getRepository('AsiClinicaBundle:Detallefactura')->findMedicamentosByFactura($factura->getId());

            if (count($tienemedicamentos)>0) {
                $estadorecetas = 2;
            }
        }
        return $estadorecetas;
    }

    /////Cosas de examen fisico
    public function examenFisicoAction($id)
    {   
        $cita=$this->citaDisponible($id);
        $em = $this->getDoctrine()->getManager();
        
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();
        
        $tieneitems = $em->getRepository('AsiClinicaBundle:Consultaitem')->consultaTieneItems($idconsulta);

        $items = $this->getItemsLista($cita);
        if (!$items) {
            throw new AccessDeniedHttpException('No existe examen físico para esta especialidad.');
        }
        if ($tieneitems[1]>0) {
            $form = $this->updateExamenFisicoForm($id, $items);
        } else {
            $form = $this->createExamenFisicoForm($id, $items);
            
        }
        return $this->render('AsiClinicaBundle:ModuloMedico:examenfisico.html.twig', array(
            'id'=>$id,
            'form'=>$form->createView()
        ));
    }

    private function getItemsLista(Cita $cita)
    {
        $em = $this->getDoctrine()->getManager();
        $items = $em->getRepository('AsiClinicaBundle:Itemexamenfisico')->findItemsByEspecialidad($cita->getIdDisponibilidad()->getIdclinica()->getIdespecialidad()->getId());
        return $items;
    }

    public function examenFisicoCreateAction($id, Request $request)
    {
        $cita=$this->citaDisponible($id);

        $em = $this->getDoctrine()->getManager();
        $items = $this->getItemsLista($cita);
        $form = $this->createExamenFisicoForm($id, $items);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $datosform = $form->getData();
            $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);

            foreach ($datosform as $nombre => $valor) {
                $consultaitem = new ConsultaItem();
                $consultaitem->setIdconsulta($consulta);
                $itemexamen = $em->getRepository('AsiClinicaBundle:Itemexamenfisico')->findOneByNombre($nombre);
                $consultaitem->setIditemexamenfisico($itemexamen);
                $consultaitem->setValor($valor);

                $em->persist($consultaitem);
                $em->flush();

            }
           return $this->redirect($this->generateUrl('modulomedico_consulta_menu', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:examenfisico.html.twig', array(
            'id'=>$id,
            'form'=>$form->createView()
        ));
    }

    public function examenFisicoUpdateAction($id, Request $request)
    {
        $cita=$this->citaDisponible($id);

        $em = $this->getDoctrine()->getManager();
        $items = $this->getItemsLista($cita);
        $form = $this->updateExamenFisicoForm($id, $items);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $datosform = $form->getData();
            $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();
            $consultaitem = $em->getRepository('AsiClinicaBundle:Consultaitem')->findByIdconsulta($idconsulta);
            foreach ($consultaitem as $ci) {
                $valor = $datosform[$ci->getIditemexamenfisico()->getNombre()];
                $ci -> setValor($valor);

                $em->persist($ci);
                $em->flush();

            }
           return $this->redirect($this->generateUrl('modulomedico_consulta_menu', array('id' => $id)));

        }

        return $this->render('AsiClinicaBundle:ModuloMedico:examenfisico.html.twig', array(
            'id'=>$id,
            'form'=>$form->createView()
        ));
    }

    private function createExamenFisicoForm($id ,$items)
    {
        $parametros = array(
            'action' => $this->generateUrl('modulomedico_consulta_examenfisico_create', array('id' => $id)),
            'method' => 'POST',
            'required' => false
            );

        $form = $this->createFormBuilder(null, $parametros);
        foreach ($items as $item) {
            $form->add($item->getNombre(), $item->getTipodato());
        }

        $form->add('submit', 'submit', array('label' => 'Crear', 'attr' => array('class' => 'round button blue small-button')));
        return $form->getForm();
    }

    private function updateExamenFisicoForm($id, $items)
    {
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();

        $parametros = array(
            'action' => $this->generateUrl('modulomedico_consulta_examenfisico_update', array('id' => $id)),
            'method' => 'POST',
            'required' => false
            );

        $form = $this->createFormBuilder(null, $parametros);
        foreach ($items as $item) {
            $valor = $em->getRepository('AsiClinicaBundle:Consultaitem')->getValorByConsultaAndItem($idconsulta, $item->getId());
            $valor = ('valor');
            if ($item->getTipodato()==='checkbox') {
                $valor = (bool)$valor;
            }
            $form->add($item->getNombre(), $item->getTipodato(), array(
                'data' => $valor
                ));
        }
        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'round button blue small-button')));
        $form->getForm();
        return $form->getForm();
    }

    /////Cosas de patologias

    public function consultaPatologiasAction($id)
    {
        $cita = $this->citaDisponible($id);
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);

        $patologias = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->findByIdconsulta($idconsulta);

        $entity = new Diagnosticopatologia();
        $form = $this->createPatologiaForm($id, $entity);

        return $this->render('AsiClinicaBundle:ModuloMedico:patologias.html.twig', array(
            'id' => $id,
            'form' => $form->createView(),
            'patologias' => $patologias,
            'deleteform' => null
        ));
    }

    public function crearDiagnosticoPatologiaAction($id, Request $request)
    {
        $entity = new Diagnosticopatologia();
        $form = $this->createPatologiaForm($id, $entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $patologias = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->findByIdconsulta($idconsulta);
        if ($form->isValid()) {
            
            $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
            $paciente = $consulta->getIdcita()->getIdpaciente();
            $entity->setIdconsulta($consulta);
            $entity->getIdpacientepatologia()->setIdpaciente($paciente);
            $entity->getIdpacientepatologia()->setFechadiagnostico(new \DateTime('now'));

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modulomedico_consulta_patologias', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:patologias.html.twig', array(
            'id' => $id,
            'form'   => $form->createView(),
            'patologias' => $patologias,
            'deleteform' => null
        ));
    }

    private function createPatologiaForm($id, Diagnosticopatologia $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();
        $listapatologias = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->getNombrePatologiasByConsulta($idconsulta);

        $form = $this->createForm(new DiagnosticopatologiaType($listapatologias), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_patologias_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agregar', 'attr' => array('class' => 'round button blue small-button')));
        $form->get('idpacientepatologia')->remove('idpaciente');
        $form->get('idpacientepatologia')->remove('fechadiagnostico');
        return $form;
    }

    public function editPatologiaAction($id, $idpatologia)
    {
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();

        $entity = $em->getRepository('AsiClinicaBundle:Pacientepatologia')->findByPacientePatologiaAndIdConsulta($idpatologia, $idconsulta);
        $patologias = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->findByIdconsulta($idconsulta);
        if (!$entity) {
            throw $this->createNotFoundException('No existe este registro.');
        }

        $form = $this->updatePatologiaForm($id, $entity);
        $deleteform = $this->deletePatologiaForm($id, $idpatologia);

        return $this->render('AsiClinicaBundle:ModuloMedico:patologias.html.twig', array(
            'id' => $id,
            'patologias' => $patologias,
            'form'   => $form->createView(),
            'deleteform' => $deleteform->createView()
        ));
    }

    private function updatePatologiaForm($id, Pacientepatologia $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();
        $listapatologias = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->getPatologiasEdit($idconsulta, $entity->getIdpatologia());

        $form = $this->createForm(new PacientepatologiaType($listapatologias), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_patologias_update', array('id' => $id, 'idpatologia' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('idpaciente');
        $form->remove('fechadiagnostico');
        return $form;
    }

    public function updatePacientePatologiaAction($id, $idpatologia, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();

        $entity = $em->getRepository('AsiClinicaBundle:Pacientepatologia')->findByPacientePatologiaAndIdConsulta($idpatologia, $idconsulta);
        $patologias = $em->getRepository('AsiClinicaBundle:Diagnosticopatologia')->findByIdconsulta($idconsulta);

        $form = $this->updatePatologiaForm($id, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modulomedico_consulta_patologias', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:patologias.html.twig', array(
            'id' => $id,
            'patologias' => $patologias,
            'form'   => $form->createView(),
        ));
    }

    public function deletePacientePatologiaAction($id, $idpatologia, Request $request)
    {
        $form = $this->deletePatologiaForm($id, $idpatologia);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
            $entity = $em->getRepository('AsiClinicaBundle:Pacientepatologia')->findByPacientePatologiaAndIdConsulta($idpatologia, $idconsulta);

            if (!$entity) {
                throw $this->createNotFoundException('No existe este registro.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('modulomedico_consulta_patologias', array('id' => $id)));
    }

    private function deletePatologiaForm($id, $idpatologia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modulomedico_consulta_patologias_delete', array('id' => $id, 'idpatologia' => $idpatologia)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'round button blue small-button')))
            ->getForm()
        ;
    }

    /////Cosas de inmunizacion

    public function consultaInmunizacionesAction($id)
    {
        $cita = $this->citaDisponible($id);
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);

        $inmunizaciones = $em->getRepository('AsiClinicaBundle:Inmunizacion')->findByIdconsulta($idconsulta);
        

        $entity = new Inmunizacion();
        $form = $this->createInmunizacionForm($id ,$entity);

        return $this->render('AsiClinicaBundle:ModuloMedico:vacunas.html.twig', array(
            'id' => $id,
            'form' => $form->createView(),
            'inmunizaciones' => $inmunizaciones,
            'deleteform' => null
        ));
    }

    private function createInmunizacionForm($id, Inmunizacion $entity)
    {

        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();
        $listavacunas = $em->getRepository('AsiClinicaBundle:Vacuna')->findVacunasNotInConsulta($idconsulta);

        $form = $this->createForm(new InmunizacionType($listavacunas), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_inmunizaciones_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agregar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('idconsulta');
        $form->remove('idpaciente');
        $form->remove('fechatomada');
        return $form;
    }

    public function crearInmunizacionAction($id, Request $request)
    {
        $entity = new Inmunizacion();
        $form = $this->createInmunizacionForm($id, $entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);

        $inmunizaciones = $em->getRepository('AsiClinicaBundle:Inmunizacion')->findByIdconsulta($consulta->getId());
        
        if ($form->isValid()) {
            
            $paciente = $consulta->getIdcita()->getIdpaciente();
            
            $entity->setIdconsulta($consulta);
            $entity->setIdpaciente($paciente);
            $entity->setFechatomada(new \DateTime('now'));

            $factura = $consulta->getIdfactura();
            $servicio = $em->getRepository('AsiClinicaBundle:Vacuna')->findOneById($form->get('idvacuna')->getData())->getIdservicio();

            $detallefactura = new Detallefactura();

            $detallefactura->setIdfactura($factura);
            $detallefactura->setIdservicio($servicio);

            $detallefactura->setPrecio($servicio->getPrecio());
            $detallefactura->setDescuento(0);
            $detallefactura->setCantidad(1);
            $detallefactura->setFacturado(true);

            $em->persist($detallefactura);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modulomedico_consulta_inmunizaciones', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:vacunas.html.twig', array(
            'id' => $id,
            'form'   => $form->createView(),
            'inmunizaciones' => $inmunizaciones,
            'deleteform' => null
        ));
    }

    public function editInmunizacionAction($id, $idinmunizacion)
    {
        $em = $this->getDoctrine()->getManager();

        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);

        $inmunizaciones = $em->getRepository('AsiClinicaBundle:Inmunizacion')->findByIdconsulta($consulta->getId());
        
        $entity = $em->getRepository('AsiClinicaBundle:Inmunizacion')->findByInmunizacionAndIdConsulta($idinmunizacion, $consulta->getId());
        
        if (!$entity) {
            throw $this->createNotFoundException('No existe este registro.');
        }

        $form = $this->updateInmunizacionForm($id, $entity);
        $deleteform = $this->deleteInmunizacionForm($id, $idinmunizacion);

        return $this->render('AsiClinicaBundle:ModuloMedico:vacunas.html.twig', array(
            'id' => $id,
            'inmunizaciones' => $inmunizaciones,
            'form'   => $form->createView(),
            'deleteform' => $deleteform->createView()
        ));
    }

    private function updateInmunizacionForm($id, Inmunizacion $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $idconsulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id)->getId();
        
        $listavacunas = $em->getRepository('AsiClinicaBundle:Vacuna')->findVacunasNotInConsulta($idconsulta);
        $listavacunas[] = $em->getRepository('AsiClinicaBundle:Vacuna')->findOneById($entity->getIdvacuna()->getId());
        $form = $this->createForm(new InmunizacionType($listavacunas), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_inmunizaciones_update', array('id' => $id, 'idinmunizacion' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('idconsulta');
        $form->remove('idpaciente');
        $form->remove('fechatomada');
        return $form;
    }

    public function updateInmunizacionAction($id, $idinmunizacion, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);

        $entity = $em->getRepository('AsiClinicaBundle:Inmunizacion')->findByInmunizacionAndIdConsulta($idinmunizacion, $consulta->getId());
        $servicioactual = $entity->getIdvacuna()->getIdservicio();
        $inmunizaciones = $em->getRepository('AsiClinicaBundle:Inmunizacion')->findByIdconsulta($consulta->getId());

        $form = $this->updateInmunizacionForm($id, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $factura = $consulta->getIdfactura();
            
            //$servicionuevo = $em->getRepository('AsiClinicaBundle:Vacuna')->findOneById($form->get('idvacuna')->getData())->getIdservicio();
            $servicionuevo = $entity->getIdvacuna()->getIdservicio();

            $detallefactura = $em->getRepository('AsiClinicaBundle:Detallefactura')->findByServicioAndFactura($servicioactual->getId(), $factura->getId());
            
            $detallefactura->setIdservicio($servicionuevo);
            $detallefactura->setPrecio($servicionuevo->getPrecio());

            $em->persist($detallefactura);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modulomedico_consulta_inmunizaciones', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:vacunas.html.twig', array(
            'id' => $id,
            'inmunizaciones' => $inmunizaciones,
            'form'   => $form->createView(),
        ));
    }

    public function deleteInmunizacionAction($id, $idinmunizacion, Request $request)
    {
        $form = $this->deleteInmunizacionForm($id, $idinmunizacion);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
            $entity = $em->getRepository('AsiClinicaBundle:Inmunizacion')->findByInmunizacionAndIdConsulta($idinmunizacion, $consulta->getId());

            $servicioactual = $entity->getIdvacuna()->getIdservicio();
            $factura = $consulta->getIdfactura();

            $detallefactura = $em->getRepository('AsiClinicaBundle:Detallefactura')->findByServicioAndFactura($servicioactual->getId(), $factura->getId());

            if (!$entity) {
                throw $this->createNotFoundException('No existe este registro.');
            }

            $em->remove($detallefactura);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('modulomedico_consulta_inmunizaciones', array('id' => $id)));
    }

    private function deleteInmunizacionForm($id, $idinmunizacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modulomedico_consulta_inmunizaciones_delete', array('id' => $id, 'idinmunizacion' => $idinmunizacion)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'round button blue small-button')))
            ->getForm()
        ;
    }


    //////Cosas de examenes

    public function consultaExamenesAction($id)
    {
        $cita = $this->citaDisponible($id);
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $detalles = $em->getRepository('AsiClinicaBundle:Detallefactura')->findExamenesByFactura($factura->getId());
        

        $entity = new Detallefactura();
        $form = $this->addExamenForm($id ,$entity);

        return $this->render('AsiClinicaBundle:ModuloMedico:examenes.html.twig', array(
            'id' => $id,
            'form' => $form->createView(),
            'detalles' => $detalles,
            'deleteform' => null
        ));
    }

    private function addExamenForm($id, Detallefactura $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $listadetalles = $em->getRepository('AsiClinicaBundle:Servicio')->findExamenesNotInFactura($factura->getId());

        $form = $this->createForm(new DetallefacturaType($listadetalles), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_examenes_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agregar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('precio');
        $form->remove('descuento');
        $form->remove('cantidad');
        $form->remove('facturado');
        $form->remove('idfactura');

        return $form;
    }

    public function crearExamenAction($id, Request $request)
    {
        $entity = new Detallefactura();
        $form = $this->addExamenForm($id, $entity);

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $detalles = $em->getRepository('AsiClinicaBundle:Detallefactura')->findExamenesByFactura($factura->getId());
        
        if ($form->isValid()) {
            
            $entity->setPrecio($entity->getIdservicio()->getPrecio());
            $entity->setDescuento(0);
            $entity->setCantidad(1);
            $entity->setFacturado(true);
            $entity->setIdfactura($factura);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modulomedico_consulta_examenes', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:examenes.html.twig', array(
            'id' => $id,
            'form'   => $form->createView(),
            'detalles' => $detalles,
            'deleteform' => null
        ));
    }

    public function editExamenAction($id, $idexamen)
    {
        $em = $this->getDoctrine()->getManager();

        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $detalles = $em->getRepository('AsiClinicaBundle:Detallefactura')->findExamenesByFactura($factura->getId());
        
        $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->findOneById($idexamen);
        
        if (!$entity) {
            throw $this->createNotFoundException('No existe este registro.');
        }

        $form = $this->updateExamenForm($id, $entity);
        $deleteform = $this->deleteExamenForm($id, $idexamen);

        return $this->render('AsiClinicaBundle:ModuloMedico:examenes.html.twig', array(
            'id' => $id,
            'detalles' => $detalles,
            'form'   => $form->createView(),
            'deleteform' => $deleteform->createView()
        ));
    }

    private function updateExamenForm($id, Detallefactura $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $listadetalles = $em->getRepository('AsiClinicaBundle:Servicio')->findExamenesNotInFactura($factura->getId());
        $listadetalles[] = $em->getRepository('AsiClinicaBundle:Servicio')->findOneById($entity->getIdservicio()->getId());
        $form = $this->createForm(new DetallefacturaType($listadetalles), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_examenes_update', array('id' => $id, 'idexamen' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('precio');
        $form->remove('descuento');
        $form->remove('cantidad');
        $form->remove('facturado');
        $form->remove('idfactura');
        return $form;
    }

    public function updateExamenAction($id, $idexamen, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $detalles = $em->getRepository('AsiClinicaBundle:Detallefactura')->findExamenesByFactura($factura->getId());
        
        $detallefactura = $em->getRepository('AsiClinicaBundle:Detallefactura')->findOneById($idexamen);

        $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->findByServicioAndFactura($detallefactura->getIdservicio()->getId(), $factura->getId());
        
        if (!$entity) {
            throw $this->createNotFoundException('No existe este registro.');
        }

        $form = $this->updateExamenForm($id, $entity);
        $form->handleRequest($request);


        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modulomedico_consulta_examenes', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:examenes.html.twig', array(
            'id' => $id,
            'detalles' => $detalles,
            'form'   => $form->createView(),
        ));
    }

    public function deleteExamenAction($id, $idexamen, Request $request)
    {
        $form = $this->deleteExamenForm($id, $idexamen);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
            $factura = $consulta->getIdfactura();
            $detallefactura = $em->getRepository('AsiClinicaBundle:Detallefactura')->findOneById($idexamen);
            $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->findByServicioAndFactura($detallefactura->getIdservicio()->getId(), $factura->getId());

            if (!$entity) {
                throw $this->createNotFoundException('No existe este registro.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('modulomedico_consulta_examenes', array('id' => $id)));
    }

    private function deleteExamenForm($id, $idexamen)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modulomedico_consulta_examenes_delete', array('id' => $id, 'idexamen' => $idexamen)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'round button blue small-button')))
            ->getForm()
        ;
    }

    /////////////////Cosas de recetas

    public function consultaRecetaAction($id)
    {
        $cita = $this->citaDisponible($id);
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();

        $detalles = $em->getRepository('AsiClinicaBundle:Detallefactura')->findMedicamentosByFactura($factura->getId());
        

        $entity = new Detallefactura();
        $form = $this->addRecetaForm($id ,$entity);

        return $this->render('AsiClinicaBundle:ModuloMedico:receta.html.twig', array(
            'id' => $id,
            'form' => $form->createView(),
            'detalles' => $detalles,
            'deleteform' => null
        ));
    }

    private function addRecetaForm($id, Detallefactura $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $listadetalles = $em->getRepository('AsiClinicaBundle:Servicio')->findMedicamentosNotInFactura($factura->getId());

        $form = $this->createForm(new DetallefacturaType($listadetalles), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_receta_create', array('id' => $id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Agregar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('precio');
        $form->remove('descuento');
        $form->remove('facturado');
        $form->remove('idfactura');

        return $form;
    }

    public function crearRecetaAction($id, Request $request)
    {
        $entity = new Detallefactura();
        $form = $this->addRecetaForm($id, $entity);

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $detalles = $em->getRepository('AsiClinicaBundle:Detallefactura')->findMedicamentosByFactura($factura->getId());
        
        if ($form->isValid()) {
            // $entity->setPrecio($entity->getIdservicio()->getPrecio());
            // $entity->setDescuento(1);
            $entity->setFacturado(false);
            $entity->setIdfactura($factura);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modulomedico_consulta_receta', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:receta.html.twig', array(
            'id' => $id,
            'form'   => $form->createView(),
            'detalles' => $detalles,
            'deleteform' => null
        ));
    }

    public function editRecetaAction($id, $idreceta)
    {
        $em = $this->getDoctrine()->getManager();

        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $detalles = $em->getRepository('AsiClinicaBundle:Detallefactura')->findMedicamentosByFactura($factura->getId());
        
        $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->findOneById($idreceta);
        
        if (!$entity) {
            throw $this->createNotFoundException('No existe este registro.');
        }

        $form = $this->updateRecetaForm($id, $entity);
        $deleteform = $this->deleteRecetaForm($id, $idreceta);

        return $this->render('AsiClinicaBundle:ModuloMedico:receta.html.twig', array(
            'id' => $id,
            'detalles' => $detalles,
            'form'   => $form->createView(),
           'deleteform' => $deleteform->createView()
        ));
    }

    private function updateRecetaForm($id, Detallefactura $entity)
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $listadetalles = $em->getRepository('AsiClinicaBundle:Servicio')->findMedicamentosNotInFactura($factura->getId());
        $listadetalles[] = $em->getRepository('AsiClinicaBundle:Servicio')->findOneById($entity->getIdservicio()->getId());
        $form = $this->createForm(new DetallefacturaType($listadetalles), $entity, array(
            'action' => $this->generateUrl('modulomedico_consulta_receta_update', array('id' => $id, 'idreceta' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('precio');
        $form->remove('descuento');
        $form->remove('facturado');
        $form->remove('idfactura');
        return $form;
    }

    public function updateRecetaAction($id, $idreceta, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
        $factura = $consulta->getIdfactura();
        $detalles = $em->getRepository('AsiClinicaBundle:Detallefactura')->findMedicamentosByFactura($factura->getId());
        
        $detallefactura = $em->getRepository('AsiClinicaBundle:Detallefactura')->findOneById($idreceta);

        $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->findByServicioAndFactura($detallefactura->getIdservicio()->getId(), $factura->getId());
        
        if (!$entity) {
            throw $this->createNotFoundException('No existe este registro.');
        }

        $form = $this->updateRecetaForm($id, $entity);
        $form->handleRequest($request);


        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modulomedico_consulta_receta', array('id' => $id)));
        }

        return $this->render('AsiClinicaBundle:ModuloMedico:receta.html.twig', array(
            'id' => $id,
            'detalles' => $detalles,
            'form'   => $form->createView(),
        ));
    }

   public function deleteRecetaAction($id, $idreceta, Request $request)
    {
        $form = $this->deleteExamenForm($id, $idreceta);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($id);
            $factura = $consulta->getIdfactura();
            $detallefactura = $em->getRepository('AsiClinicaBundle:Detallefactura')->findOneById($idreceta);
            $entity = $em->getRepository('AsiClinicaBundle:Detallefactura')->findByServicioAndFactura($detallefactura->getIdservicio()->getId(), $factura->getId());

            if (!$entity) {
                throw $this->createNotFoundException('No existe este registro.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('modulomedico_consulta_examenes', array('id' => $id)));
    }

    private function deleteRecetaForm($id, $idreceta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modulomedico_consulta_receta_delete', array('id' => $id, 'idreceta' => $idreceta)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar', 'attr' => array('class' => 'round button blue small-button')))
            ->getForm()
        ;
    }

    /////////////Fase 3

    public function consultaConfirmarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cita = $this->citaDisponible($id);
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByIdcita($cita->getId());
        $examenes = $em->getRepository('AsiClinicaBundle:Detallefactura')->findExamenesByFactura($consulta->getIdfactura()->getId());
        $medicamentos = $em->getRepository('AsiClinicaBundle:Detallefactura')->findMedicamentosRecetadosByFactura($consulta->getIdfactura()->getId());


        return $this->render('AsiClinicaBundle:ModuloMedico:confirmar.html.twig', array(
            'id'      => $id,
            'consulta' => $consulta,
            'examenes' => $examenes,
            'medicamentos' => $medicamentos
        ));
    }

    public function consultaFinalizarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cita = $this->citaDisponible($id);
        $cita->setEstado('Facturando');

        $em->persist($cita);
        $em->flush();

        return $this->redirect($this->generateUrl('modulomedico_agenda'));
    }

}
