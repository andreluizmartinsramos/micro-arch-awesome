<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 07/05/2018
 * Time: 16:11
 */

namespace App\Tests;


use Symfony\Component\HttpFoundation\Response;

class GrupoControllerCest
{
    private $grupoId;

    public function salvaGrupoEmDominioValido(\ApiTester $I) {
        $requestBody = [
            "nome" => "Grupo TESTE de professores de matemática",
            "descricao" => "Grupo TESTE de professores comunicação de matemática",
            "email" => "professores_matematica-2018b-teste@sc.docente.senai.br"
        ];
        $I->sendPOST('/grupo/', $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->canSeeResponseContainsJson([
            "nome" => "Grupo TESTE de professores de matemática",
            "descricao" => "Grupo TESTE de professores comunicação de matemática",
            "email" => "professores_matematica-2018b-teste@sc.docente.senai.br"
        ]);
        $I->seeResponseIsJson();
        $grupo = json_decode($I->grabResponse());
        $this->grupoId = $grupo->id;
    }

    public function salvaGrupoEmDominioInvalido(\ApiTester $I) {
        $requestBody = [
            "nome" => "Grupo TESTE de professores de matemática",
            "descricao" => "Grupo TESTE de professores comunicação de matemática",
            "email" => "professores_matematica-2018b-teste@ac.docente.senai.br"
        ];
        $I->sendPOST('/grupo/', $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_FORBIDDEN);
        $I->seeResponseIsJson();
    }

    public function alteraGrupoEmDominioValido(\ApiTester $I) {
        $requestBody = [
            "nome" => "Grupo TESTE de professores de matemática 2",
            "descricao" => "Grupo TESTE de professores comunicação de matemática 2",
            "email" => "professores_matematica-2018b-teste@sc.docente.senai.br"
        ];
        $I->sendPUT('/grupo/' . $this->grupoId, $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->canSeeResponseContainsJson([
            "nome" => "Grupo TESTE de professores de matemática 2",
            "descricao" => "Grupo TESTE de professores comunicação de matemática 2",
            "email" => "professores_matematica-2018b-teste@sc.docente.senai.br"
        ]);
        $I->seeResponseIsJson();
    }

    public function removeGrupoEmDominioValido(\ApiTester $I) {
        $I->sendDELETE('/grupo/' . $this->grupoId);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
    }
}