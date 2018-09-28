<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 26/04/2018
 * Time: 14:26
 */

namespace App\Tests;

use Symfony\Component\HttpFoundation\Response;

class CursoControllerCest
{
    private $cursoId;

    public function salvarCursoDominioNaoPermitidoApi(\ApiTester $I) {
        $I->sendPOST('/curso/', [
            "nome" => "Matemética 2018/1",
            "turno" => "Matutino",
            "descricao_cabecalho" => "Matemética 2019",
            "descricao" => "Um importante campo na matemática aplicada é a estatística, que permite a descrição, análise e ...",
            "sala" => "215A",
            "id_dono_curso" => "elias.mendes@ac.docente.senai.br"
        ]);
        $I->seeResponseCodeIs(Response::HTTP_FORBIDDEN);
    }

    public function salvarCursoDominioPermitidoApi(\ApiTester $I) {
        $requestBody = [
            "nome" => "Matemética 2018/1",
            "turno" => "Matutino",
            "descricao_cabecalho" => "Matemética 2019",
            "descricao" => "Um importante campo na matemática aplicada é a estatística, que permite a descrição, análise e ...",
            "sala" => "215A",
            "id_dono_curso" => "elias.mendes@sc.docente.senai.br"
        ];
        $I->sendPOST('/curso/', $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->canSeeResponseContainsJson([
            "descricao_cabecalho" => "Matemética 2019"
        ]);
        $curso = json_decode($I->grabResponse());
        $this->cursoId = $curso->id;
    }

    public function alteraCursoDominioPermitidoApi(\ApiTester $I) {
        $requestBody = [
            "nome" => "Matemética 2018/1",
            "turno" => "Matutino",
            "descricao_cabecalho" => "Matemética 2018",
            "descricao" => "Um importante campo na matemática aplicada é a estatística, que permite a descrição, análise e ...",
            "sala" => "215A",
            "id_dono_curso" => "elias.mendes@sc.docente.senai.br"
        ];
        $I->sendPUT('/curso/' . $this->cursoId, $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->canSeeResponseContainsJson([
            "descricao_cabecalho" => "Matemética 2018"
        ]);
    }

    public function buscarCursoApi(\ApiTester $I) {
        $I->sendGET('/curso/' . $this->cursoId);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    public function removeCursoApi(\ApiTester $I) {
        $I->haveHttpHeader('Authorization', 'hN309FOdZZwRkS0iG5ncB6IE7PlMhWkm');
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendDELETE('/curso/' . $this->cursoId);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
    }
}