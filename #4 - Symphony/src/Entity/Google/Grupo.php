<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 07/05/2018
 * Time: 11:21
 */

namespace App\Entity\Google;

use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;

class Grupo
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Id google do Grupo.", example="1234567890", readOnly=true)
     */
    private $id;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Nome do Grupo.", example="Grupo de professores de matemática")
     */
    private $nome;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Descrição do grupo.", example="Grupo de professores comunicação de matemática")
     */
    private $descricao;

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Email do grupo.", example="professores_matematica-2018b@sc.docente.senai.br", required={"true"})
     */
    private $email;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Grupo
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     * @return Grupo
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao() {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     * @return Grupo
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Grupo
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public static function fromGoogle(\Google_Service_Directory_Group $group): Grupo {
        $grupo = new Grupo();

        $grupo->setId($group->getId())
            ->setEmail($group->getEmail())
            ->setDescricao($group->getDescription())
            ->setNome($group->getName());

        return $grupo;
    }

}