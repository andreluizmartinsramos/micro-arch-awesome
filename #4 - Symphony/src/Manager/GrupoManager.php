<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 07/05/2018
 * Time: 14:51
 */

namespace App\Manager;


use Symfony\Component\HttpFoundation\Request;

class GrupoManager
{
    const NOME = "nome";

    const DESCRICAO = "descricao";

    const EMAIL = "email";

    public function getGrupoFromRequest(Request $request, \Google_Service_Directory_Group $curso = null): \Google_Service_Directory_Group {

        /** @var \Symfony\Component\HttpFoundation\ParameterBag $data */
        $data = $request->request;

        if (!isset($grupo)) {
            $grupo = new \Google_Service_Directory_Group();
        }

        if ($data->has(self::NOME))
            $grupo->setName($data->get(self::NOME));

        if ($data->has(self::DESCRICAO))
            $grupo->setDescription($data->get(self::DESCRICAO));

        if ($data->has(self::EMAIL))
            $grupo->setEmail($data->get(self::EMAIL));

        return $grupo;
    }
}