<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 27/04/2018
 * Time: 11:32
 */

use Symfony\Component\HttpFoundation\Response;


class UserControllerCest
{
    public function buscaUsuariosPorDominio(\ApiTester $I) {
        $I->sendGET('/user/dominio/sc.docente.senai.br');
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
    }

    public function salvaUsuarioEmDominioInvalido(\ApiTester $I) {
        $requestBody = [
            "email" => "teste-api@ac.docente.senai.br",
            "nome" => "Fulano",
            "sobre_nome" => "De Tal",
            "inativo" => false,
            "id_plataforma" => 11967,
            "unidade" => "SENAI/SC - Tubarão",
            "perfil" => "docente",
            "data_nascimento" => "1990-01-01",
            "cpf" => "250.593.980-21",
            "genero" => "M",
            "escolaridade" => "Ensino Fundamental",
            "cidade" => "Tubarão",
            "estado" => "Santa Catarina",
            "email_complementar" => "teste-api@ac.docente.senai.br"
        ];
        $I->sendPOST('/user/', $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_FORBIDDEN);
        $I->seeResponseIsJson();
    }

    public function salvaUsuarioEmDominioValido(\ApiTester $I) {
        $requestBody = [
            "email" => "teste-api@sc.docente.senai.br",
            "nome" => "Fulano",
            "sobre_nome" => "De Tal",
            "inativo" => false,
            "id_plataforma" => 11967,
            "unidade" => "SENAI/SC - Tubarão",
            "perfil" => "docente",
            "data_nascimento" => "1990-01-01",
            "cpf" => "250.593.980-21",
            "genero" => "M",
            "escolaridade" => "Ensino Fundamental",
            "cidade" => "Tubarão",
            "estado" => "Santa Catarina",
            "email_complementar" => "teste-api@sc.docente.senai.br",
            "password" => "SeNh@F0rT3"
        ];
        $I->sendPOST('/user/', $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseContainsJson([
            "email" => "teste-api@sc.docente.senai.br",
        ]);
    }

    public function alteraUsuarioEmDominioInvalido(\ApiTester $I) {
        $requestBody = [
            "nome" => "Fulano",
            "sobre_nome" => "De Tal 2",
            "inativo" => false,
            "id_plataforma" => 11967,
            "unidade" => "SENAI/SC - Tubarão",
            "perfil" => "docente",
            "data_nascimento" => "1990-01-01",
            "cpf" => "250.593.980-21",
            "genero" => "M",
            "escolaridade" => "Ensino Fundamental",
            "cidade" => "Tubarão",
            "estado" => "Santa Catarina",
            "email_complementar" => "teste-api@sc.docente.senai.br"
        ];
        $I->sendPUT('/user/teste-api@ac.docente.senai.br', $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_FORBIDDEN);
        $I->seeResponseIsJson();
    }

    public function alteraUsuarioEmDominioValido(\ApiTester $I) {
        $requestBody = [
            "nome" => "Fulano",
            "sobre_nome" => "De Tal 2",
            "inativo" => false,
            "id_plataforma" => 11967,
            "unidade" => "SENAI/SC - Tubarão",
            "perfil" => "docente",
            "data_nascimento" => "1990-01-01",
            "cpf" => "250.593.980-21",
            "genero" => "M",
            "escolaridade" => "Ensino Fundamental",
            "cidade" => "Tubarão",
            "estado" => "Santa Catarina",
            "email_complementar" => "teste-api@sc.docente.senai.br"
        ];
        $I->sendPUT('/user/teste-api@sc.docente.senai.br', $requestBody);
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseContainsJson([
            "email" => "teste-api@sc.docente.senai.br",
            "sobre_nome" => "De Tal 2"
        ]);
    }

    public function buscaUsuarioEmDominioInvalido(\ApiTester $I) {
        $I->sendGET('/user/teste-api@ac.docente.senai.br');
        $I->seeResponseCodeIs(Response::HTTP_FORBIDDEN);
        $I->seeResponseIsJson();
    }

    public function buscaUsuarioEmDominioValido(\ApiTester $I) {
        $I->sendGET('/user/teste-api@sc.docente.senai.br');
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
    }

    public function removeUsuarioEmDominioInvalido(\ApiTester $I) {
        $I->sendDELETE('/user/teste-api@ac.docente.senai.br');
        $I->seeResponseCodeIs(Response::HTTP_FORBIDDEN);
        $I->seeResponseIsJson();
    }

    public function removeUsuarioEmDominioValido(\ApiTester $I) {
        $I->sendDELETE('/user/teste-api@sc.docente.senai.br');
        $I->seeResponseCodeIs(Response::HTTP_OK);
        $I->seeResponseIsJson();
    }

}
