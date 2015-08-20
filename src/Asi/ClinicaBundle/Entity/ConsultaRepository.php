<?php

namespace Asi\ClinicaBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ConsultaRepository
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConsultaRepository extends EntityRepository
{
	public function findAllByClinicas($clinicas)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT co FROM AsiClinicaBundle:Consulta co INNER JOIN AsiClinicaBundle:Cita c WHERE co.idcita = c.id INNER JOIN AsiClinicaBundle:Disponibilidad d WHERE c.idDisponibilidad = d.id INNER JOIN AsiClinicaBundle:Clinica cl WHERE d.idclinica = cl.id INNER JOIN AsiClinicaBundle:Personalclinica pcl WHERE pcl.idclinica = cl.id AND pcl IN(:clinicas) AND c.estado=\'Finalizada\'')
            ->setParameter("clinicas", $clinicas)
            ->getResult();
    }

    public function findOneByClinicasAndConsulta($clinicas, $consulta)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT co FROM AsiClinicaBundle:Consulta co INNER JOIN AsiClinicaBundle:Cita c WHERE co.idcita = c.id INNER JOIN AsiClinicaBundle:Disponibilidad d WHERE c.idDisponibilidad = d.id INNER JOIN AsiClinicaBundle:Clinica cl WHERE d.idclinica = cl.id INNER JOIN AsiClinicaBundle:Personalclinica pcl WHERE pcl.idclinica = cl.id AND pcl IN(:clinicas) AND c.estado=\'Finalizada\' AND co.id = :consulta')
            ->setParameter("clinicas", $clinicas)
            ->setParameter("consulta", $consulta)
            ->getOneOrNullResult();
    }
}