<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 02/05/2018
 * Time: 08:19
 */

namespace App\Manager;


use App\Entity\Google\Calendario;
use App\Entity\Google\Usuario;
use Doctrine\ORM\EntityManagerInterface;

class CalendarioManager extends AbstractGoogleManager
{

    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function getGoogleCalendarioById(string $id) {
        return $this->em->getRepository("App:Google\Calendario")
            ->find($id);
    }

    public function postGoogleCalendario(Calendario $calendario): void {
        $this->em->persist($calendario);
        $this->em->flush();
    }

    public function removeGoogleCalendario(Calendario $calendario): void {
        $this->em->remove($calendario);
        $this->em->flush();
    }

    public function addUsuarioCalendario(Calendario $calendario, Usuario $usuario): void {
        $usuario->addCalendario($calendario);
        $this->em->flush();
    }

    public function addUsuarioCalendarioById(string $idCalendario, string $idUsuario): void {
        $calendario = $this->getGoogleCalendarioById($idCalendario);
        $usuario = $this->em->getRepository("App:Google\Usuario")
            ->findOneByEmail($idUsuario);

        $this->addUsuarioCalendario($calendario, $usuario);
    }

    public function removeUsuarioCalendario(Calendario $calendario, Usuario $usuario): void {
        $usuario->removeCalendario($calendario);
        $this->em->flush();
    }

    public function removeUsuarioCalendarioById(string $idCalendario, string $idUsuario): void {
        $calendario = $this->getGoogleCalendarioById($idCalendario);
        $usuario = $this->em->getRepository("App:Google\Usuario")
            ->findOneByEmail($idUsuario);

        $this->removeUsuarioCalendario($calendario, $usuario);
    }
}