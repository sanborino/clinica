<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ModuloHistorialController extends Controller
{
    public function indexAction()
    {
        return $this->render('AsiClinicaBundle:ModuloHistorial:index.html.twig');
    }

    public function pacientesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clinicas = $this->getUsuarioClinicas();

        $entities = $em->getRepository('AsiClinicaBundle:Paciente')->findAllByClinicas($clinicas);
        return $this->render('AsiClinicaBundle:ModuloHistorial:pacientes.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function consultasAction()
    {
        $em = $this->getDoctrine()->getManager();

		$clinicas = $this->getUsuarioClinicas();

        $entities = $em->getRepository('AsiClinicaBundle:Consulta')->findAllByClinicas($clinicas);
        return $this->render('AsiClinicaBundle:ModuloHistorial:consultas.html.twig', array(
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

    public function datosConsultaAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
        $consulta = $em->getRepository('AsiClinicaBundle:Consulta')->findOneByClinicasAndConsulta($this->getUsuarioClinicas(), $id);
        if (!$consulta) {
            throw new AccessDeniedHttpException("Denegado");
        }
        $examenes = $em->getRepository('AsiClinicaBundle:Detallefactura')->findExamenesByFactura($consulta->getIdfactura()->getId());
        $medicamentos = $em->getRepository('AsiClinicaBundle:Detallefactura')->findMedicamentosRecetadosByFactura($consulta->getIdfactura()->getId());
        
        return $this->render('AsiClinicaBundle:ModuloHistorial:datosconsulta.html.twig', array(
            'consulta' => $consulta,
            'examenes' => $examenes,
            'medicamentos' => $medicamentos
        ));
    }

    public function datosFacturaAction($id)
    {
    	$em = $this->getDoctrine()->getManager();

    	$factura = $em->getRepository('AsiClinicaBundle:Factura')->findOneById($id);
    	return $this->render('AsiClinicaBundle:ModuloHistorial:datosfactura.html.twig', array(
            'factura' => $factura
        ));
    }

    public function datosPacienteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $paciente = $em->getRepository('AsiClinicaBundle:Paciente')->findOneByClinicasAndPaciente($this->getUsuarioClinicas(), $id);

        if (!$paciente) {
            throw new AccessDeniedHttpException("Denegado");
        }
        return $this->render('AsiClinicaBundle:ModuloHistorial:datospaciente.html.twig', array(
            'paciente' => $paciente
        ));
    }
}
