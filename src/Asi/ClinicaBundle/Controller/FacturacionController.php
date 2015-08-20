<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use  Asi\ClinicaBundle\Entity\Factura;
use Asi\ClinicaBundle\Form\DetallefacturaType;
use Asi\ClinicaBundle\Entity\Detallefactura;
use Symfony\Component\HttpFoundation\Response;

class FacturacionController extends Controller
{
    


	// Muestra las facturas de las clinicas a las cuales tiene acceso la secretaria
    public function mostrarFacturasAction()
    {

   
    	$em =  $this->getDoctrine()->getManager();
         $idPersonal = $this->getUser()->getIdpersonal()->getId();
   

    	// obteniendo las facturas por clinica con el estado Facturando de Cita
    	$query = $em->createQuery(" SELECT co FROM  AsiClinicaBundle:Consulta co INNER JOIN  AsiClinicaBundle:Factura f WHERE f.id = co.idfactura INNER JOIN AsiClinicaBundle:Cita ci WHERE
    		ci.id = co.idcita  INNER JOIN AsiClinicaBundle:Disponibilidad d WHERE ci.idDisponibilidad = d.id  INNER JOIN AsiClinicaBundle:Clinica cl WHERE cl.id = d.idclinica INNER JOIN AsiClinicaBundle:Personalclinica pe WHERE pe.idclinica = cl.id  AND ci.estado = 'Facturando' AND pe.idpersonal = :idpersonal  ");
    	$query->setParameter('idpersonal',$idPersonal);
    

    	$facturas = $query->getResult();

    	return $this->render('AsiClinicaBundle:Facturacion:facturasClinica.html.twig', array(
            'entities' => $facturas,
        ));

    }





  


    // elimina un servicio del detalle factura
    // $id: id del servicio que se eliminara de la factura

    public function facturaEditBorrarAction($id) {

        $em = $this->getDoctrine()->getManager();

        // obteniendo el objeto que se va eliminar 
        $servicio = $em->getRepository('AsiClinicaBundle:Detallefactura')->find($id);
        $factura = $servicio->getIdfactura();

        $idFactura = $factura->getId();

      $em->remove($servicio);
      $em->flush();


     return $this->redirect($this->generateUrl('recepcion_factura_edit', array('id'=>$idFactura)));



    } 


    //Emite la factura y le cambia de estado

    public function facturaEmisionAction($id){

        $em = $this->getDoctrine()->getManager();

        // obteniendo el objeto que se va eliminar 
        $factura = $em->getRepository('AsiClinicaBundle:Factura')->find($id);
        
         $cita =  $factura->getIdconsulta()->getIdcita();

         $cita->setEstado('Finalizada');

        $em->persist($cita);
        $em->flush();


        return $this->redirect($this->generateUrl('facturacion_clinicas'));

    }




    // editanto la factura para agregarles mas servicios
    // $id : Id de la factura a editar


    public function facturaEditAction($id,Request $request)
    {

    	$em = $this->getDoctrine()->getManager();


    	// creando formulario
    	$entity = new Detallefactura();

        $Servicios = $em->getRepository('AsiClinicaBundle:Servicio')->findAll();
        $form = $this->createForm(new DetallefacturaType($Servicios), $entity, array(
            'method' => 'POST',));
        $factura = $em->getRepository('AsiClinicaBundle:Factura')->find($id);

        $form->add('submit', 'submit', array('label' => 'Agregar', 'attr' => array('class' => 'round button blue small-button')));
        $form->remove('facturado');
        $form->remove('idfactura');

        $form->handleRequest($request);


        if ($form->isValid()) {
            
            $entity->setFacturado(1);
            $entity->setIdfactura($factura);
            $em->persist($entity);
            $em->flush();

           
        }
        
    	
    	$query = $em->createQuery("SELECT df FROM AsiClinicaBundle:Detallefactura df WHERE df.idfactura = :idfactura AND df.facturado = 1");
    	$query->setParameter('idfactura',$id);

    	$detalleFactura = $query->getResult();

        return $this->render('AsiClinicaBundle:Facturacion:factura_edit.html.twig', array(
            'factura' => $factura,
            'form'   => $form->createView(),
            'detalle' => $detalleFactura,
        ));

   

    }

    public function reporteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $factura = $em->getRepository('AsiClinicaBundle:Factura')->find($id);
        $query = $em->createQuery("SELECT df FROM AsiClinicaBundle:Detallefactura df WHERE df.idfactura = :idfactura AND df.facturado = 1");
        $query->setParameter('idfactura',$id);

        $detalleFactura = $query->getResult();

        $html = $this->renderView('AsiClinicaBundle:Reportes:factura.html.twig', array(
            'factura' => $factura,
            'detalle' => $detalleFactura,
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Factura'.$id.'.pdf"'
            )
        );

    }
    
}

