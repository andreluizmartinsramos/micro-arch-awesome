<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 15/02/2018
 * Time: 15:37
 */

namespace App\Manager;


use App\Entity\CustomSchemaMSD;
use App\Entity\Google\Usuario;
use App\Exception\DominioException;
use App\Utils\PasswordUtils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Utils\StringUtils;
use Symfony\Component\HttpFoundation\Response;

class UsuarioManager
{
    private $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    const MAIN_DOMAIN = 'edu.senai.br';

    public function geraDadosIniciais(Usuario &$usuario, \App\Entity\Usuario $usuarioLogado) {
        $usuario->setAlteraEmailPrimeiroLogin(true);
        $usuario->setEmail($this->geraEmailUsuario($usuario, $usuarioLogado));
        $usuario->setPassword(PasswordUtils::gerarSenha(8, true, true, true, false));
    }

    public function listGoogleUserToListUser($list): ArrayCollection {
        $collection = new ArrayCollection();
        foreach ($list->users as $user) {
            $collection->add(Usuario::fromGoogle($user));
        }
        return $collection;
    }

    public function postGoogleUsuario(Usuario $usuario) {
        $this->em->persist($usuario);
        $this->em->flush();
    }

    public function removeGoogleUsuario(Usuario $usuario) {
        $this->em->remove($usuario);
        $this->em->flush();
    }

    public function getGoogleUsuarioByEmail(string $email): ?Usuario {
        return $this->em->getRepository('App:Google\Usuario')
            ->findByEmail($email);
    }

    private function geraEmailUsuario(Usuario $usuario, \App\Entity\Usuario $usuarioLogado) {
        if ($usuario->isEstudante()) {
            $dominio = $usuarioLogado->getDr()->getDominioPrincipalEstudante();
            if (!isset($dominio))
                throw new DominioException(Response::HTTP_CONFLICT, 'Sem domínio principal para este tipo de usuário');
            return StringUtils::geraEmailUsuario($usuario->getNome(), $dominio);
        } else if ($usuario->isDocente()) {
            $dominio = $usuarioLogado->getDr()->getDominioPrincipalDocente();
            if (!isset($dominio))
                throw new DominioException(Response::HTTP_CONFLICT, 'Sem domínio principal para este tipo de usuário');
            return StringUtils::geraEmailUsuario($usuario->getNome(), $dominio);
        }
    }

}