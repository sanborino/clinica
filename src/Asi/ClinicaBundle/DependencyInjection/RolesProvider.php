<?php
namespace Asi\ClinicaBundle\DependencyInjection;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityManager;

class RolesProvider 
{	
	protected $entityManager;
	protected $securityContext;

	private $pantallaAccesos;

	public function setEntityManager(EntityManager $entityManager, SecurityContext $securityContext)
	{
	   $this->entityManager = $entityManager;
	   $this->securityContext = $securityContext;

	   $this->_initPantallaAcceso();
	}

	private function _initPantallaAcceso(){
		
		$this->pantallaAccesos = array();

		$oAccesos = $this
						->entityManager
						->getRepository('AsiClinicaBundle:PantallaAcceso')
						->findAll();

        foreach ($oAccesos as $oAcceso) {
        	$aux = array(
        		'pantalla_id' => $oAcceso->getPantalla()->getId(),
        		'pantalla_route' => $oAcceso->getPantalla()->getDirpantalla(),
        		'tipo_usuario' => $oAcceso->getTipoUsuario()->getId()
    		);

    		$this->pantallaAccesos[] = $aux;

        }

	}


	public function getPossibleRoles(){
		
        $roles_db = $this->entityManager->getRepository('AsiClinicaBundle:TipoUsuario')->findAll();

        $roles = array();

        $roles[-1] = 'ROLE_USER';

        foreach ($roles_db as $role_db) {
            $roles[$role_db->getId()] = $this->getName($role_db->getNombre());
        }


		return $roles;
	}

	public function getRoleNameById($id){
		$role = $this->entityManager->getRepository('AsiClinicaBundle:TipoUsuario')->findOneById($id);

		if ($id == -1) return 'ROLE_USER';

		return $this->getName($role->getNombre());	

	}

	public function getUserIdRoles($user_roles){
		$roles_db = $this->getPossibleRoles();

		$roles_id = array();

		foreach ($user_roles as $user_role) {
			$roles_id[] = array_search($user_role, $roles_db);
		}

		return $roles_id;
	}

	private function getName($nombre){
		return 'ROLE_' . strtoupper($nombre);
	}

	public function hasRouteAccess($route){
		if ($this->securityContext->isGranted('ROLE_ADMINISTRADOR')) return TRUE;
		
        $es_permitido = FALSE;
        $count = 0;

        $tipoUsuarioId = NULL;

        foreach ($this->pantallaAccesos as $acceso) {
			
        	if ($acceso['pantalla_route'] == $route){
            	$count++;
	            
	            $user = $this->securityContext->getToken()->getUser();

	            $tipoUsuarioId = $user->getIdTipoUsuario()->getId();
            
	            if ($tipoUsuarioId == $acceso['tipo_usuario']){
	                $es_permitido = TRUE;
	                break;
	            }		
        	}
        }

        if ($count == 0 || $es_permitido == TRUE) return TRUE;

        if (!$es_permitido) return FALSE;
	}

}