<?php

namespace Asi\ClinicaBundle\Controller;
//namespace Knp\SnappyBundle\Snappy;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Knp\SnappyBundle\Snappy;
//use Knp\Bundle\SnappyBundle\Snappy\LoggableGenerator;

class ModuloReportesController extends Controller
{


// Genera un reporte de las citas entre las fechas indicadas
    public function citasFechaActionAction($fecha1,$fecha2)
    {

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT c FROM AsiClinicaBundle:Cita c JOIN c.idDisponibilidad
                                    d WHERE d.fecha BETWEEN :fecha1 AND :fecha2 ");
        // $query->setParameter('fecha1','2014-01-01');
       // $query->setParameter('fecha2','2014-11-30');
         $query->setParameter('fecha1',$fecha1);
       $query->setParameter('fecha2',$fecha2);
        $entities = $query->getResult();


       // $entities = $em->getRepository('AsiClinicaBundle:Cita')->findAll();

        $html = $this->renderView('AsiClinicaBundle:Reportes:citas_fechas.html.twig', array(
        'entities' => $entities));


        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'));
    }

    // formulario en el cual se ingresan las fechas para generar el reporte y genera el reporte si es valido


    public function formularioFechaAction(Request $request)
    {

        $defaultData = array('message'=> 'Ingrese el rago de Fechas');
        $form = $this->createFormBuilder($defaultData)
        ->add('fechaInicio','date',array('label' => 'Fecha Inicio','years' => range(2014, date('Y'))))
        ->add('fechaFinal','date',array('label' => 'Fecha Final','years' => range(2015, date('Y'))))
        ->add('Enviar','submit')
        ->getForm();


         $form->handleRequest($request);
 
    if ($form->isValid()) {
       
        $datos = $form->getData();


        $fecha1 = $datos['fechaInicio'];
        $fecha2 = $datos['fechaFinal'];




       $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT c FROM AsiClinicaBundle:Cita c JOIN c.idDisponibilidad
                                    d WHERE d.fecha BETWEEN :fecha1 AND :fecha2 ");
        // $query->setParameter('fecha1','2014-01-01');
       // $query->setParameter('fecha2','2014-11-30');
         $query->setParameter('fecha1',$fecha1);
       $query->setParameter('fecha2',$fecha2);
        $entities = $query->getResult();


        $html = $this->renderView('AsiClinicaBundle:Reportes:citas_fechas.html.twig', array(
        'entities' => $entities));


        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'));

    

    }


        return $this->render('AsiClinicaBundle:Reportes:form_citas_fechas.html.twig', array(
            'form' => $form->createView(),
            ));


    }





}


