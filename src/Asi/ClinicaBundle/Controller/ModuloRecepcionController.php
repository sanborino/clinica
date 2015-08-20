<?php

namespace Asi\ClinicaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ModuloRecepcionController extends Controller
{
    public function indexAction()
    {
        return $this->render('AsiClinicaBundle:ModuloRecepcion:index.html.twig');
    }

}
