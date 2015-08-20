<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Asi\ClinicaBundle\Entity\Cita;
use Symfony\Component\HttpFoundation\Response;

use Knp\SnappyBundle;

/**
 * Reporte controller.
 *
 */
class ReporteController extends Controller
{
	/**
     * Lists all Cita entities.
     *
     */
    public function viewAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AsiClinicaBundle:Cita')->findAll();

        $html = $this->renderView('AsiClinicaBundle:Reporte:view.html.twig', array(
        'entities' => $entities,
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }
}