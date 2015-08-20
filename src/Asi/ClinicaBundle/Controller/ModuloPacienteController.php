<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ModuloPacienteController extends Controller
{
    public function indexAction()
    {
    	if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.context')->getToken()->getUser();
            $tipo_usuario = $user->getIdTipoUsuario()->getNombre();

            if ($tipo_usuario == 'Paciente'){
            	if ($user->getIdpaciente() == NULL){
            		return $this->redirect($this->generateUrl('registropaciente'));
            	}
            }
        }

        return $this->render('AsiClinicaBundle:ModuloPaciente:index.html.twig');
    }

}