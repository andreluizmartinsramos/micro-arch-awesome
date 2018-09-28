<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 02/05/2018
 * Time: 10:35
 */

namespace App\Tests;


use App\Utils\DateUtils;
use Symfony\Component\HttpFoundation\Response;

class CalendarioControllerCest
{
    private $calendarioId;

    private $eventoId;

    private $dataInicio;

    private $dataTermino;

    public function __construct() {
        $dataInicio = new \DateTime();
        $this->dataInicio = $dataInicio->format(\DateTime::RFC3339);

        $dataTermino = new \DateTime('+1 hour');
        $this->dataTermino = $dataTermino->format(\DateTime::RFC3339);
    }

    public function salvarCalendario(\ApiTester $I) {
        $I->sendPOST('/calendario/', [
            "titulo" => "Calendario Teste",
            "descricao" => "Descrição de Teste de Calendário",
            "local" => "Tubarão"
        ]);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseContainsJson([
            "titulo" => "Calendario Teste",
            "descricao" => "Descrição de Teste de Calendário",
            "local" => "Tubarão"
        ]);
        $calendario = json_decode($I->grabResponse());
        $this->calendarioId = $calendario->id;
    }

//    public function buscaCalendario(\ApiTester $I) {
//        $I->sendGET('/calendario/' . $this->calendarioId);
//        $I->seeResponseCodeIs(Response::HTTP_OK);
//        $I->seeResponseIsJson();
//        $I->canSeeResponseContainsJson([
//            "titulo" => "Calendario Teste",
//            "descricao" => "Descrição de Teste de Calendário",
//            "local" => "Tubarão"
//        ]);
//    }
//
//    public function alterarCalendario(\ApiTester $I) {
//        $I->sendPUT('/calendario/' . $this->calendarioId, [
//            "titulo" => "Calendario Teste 2",
//            "descricao" => "Descrição de Teste de Calendário 2",
//            "local" => "Tubarão 2"
//        ]);
//        $I->seeResponseCodeIs(Response::HTTP_OK);
//        $I->seeResponseIsJson();
//        $I->canSeeResponseContainsJson([
//            "titulo" => "Calendario Teste 2",
//            "descricao" => "Descrição de Teste de Calendário 2",
//            "local" => "Tubarão 2"
//        ]);
//    }

    public function salvarEventoNoCalendario(\ApiTester $I) {

        $I->sendPOST('/calendario/' . $this->calendarioId . '/evento', [
            "titulo" => "Prova 01",
            "inicio" => DateUtils::formatDateTime($this->dataInicio, 'America/Sao_Paulo'),
            "termino" => DateUtils::formatDateTime($this->dataTermino, 'America/Sao_Paulo'),
            "participantes" => [
                "email" => "elias.mendes@sc.docente.senai.br"
            ]
        ]);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseContainsJson([
            "titulo" => "Prova 01"
        ]);
        $evento = json_decode($I->grabResponse());
        $this->eventoId = $evento->id;
    }

    public function alteraEventoNoCalendario(\ApiTester $I) {
        $I->sendPUT('/calendario/' . $this->calendarioId . '/evento/' . $this->eventoId, [
            "titulo" => "Prova 01",
            "inicio" => DateUtils::formatDateTime($this->dataInicio, 'America/Sao_Paulo'),
            "termino" => DateUtils::formatDateTime($this->dataTermino, 'America/Sao_Paulo'),
            "participantes" => [
                "email" => "elias.mendes@sc.docente.senai.br"
            ]
        ]);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseContainsJson([
            "titulo" => "Prova 01",
            "inicio" => DateUtils::formatDateTime($this->dataInicio, 'America/Sao_Paulo'),
            "termino" => DateUtils::formatDateTime($this->dataTermino, 'America/Sao_Paulo'),
        ]);
    }

    public function buscaEventoNoCalendario(\ApiTester $I) {
        $I->sendGET('/calendario/' . $this->calendarioId . '/evento/' . $this->eventoId);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseContainsJson([
            "titulo" => "Prova 01",
            "inicio" => DateUtils::formatDateTime($this->dataInicio, 'America/Sao_Paulo'),
            "termino" => DateUtils::formatDateTime($this->dataTermino, 'America/Sao_Paulo'),
        ]);
    }

    public function removeEventoNoCalendario(\ApiTester $I) {
        $I->sendDELETE('/calendario/' . $this->calendarioId . '/evento/' . $this->eventoId);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
    }

    public function removeCalendario(\ApiTester $I) {
        $I->sendDELETE('/calendario/' . $this->calendarioId);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
    }
}