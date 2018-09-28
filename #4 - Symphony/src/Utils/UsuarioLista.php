<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 01/03/2018
 * Time: 09:58
 */

namespace App\Utils;

use Swagger\Annotations as SWG;
use JMS\Serializer\Annotation as Serializer;
use App\Entity\Google\Usuario;

class UsuarioLista
{

    /**
     * @var string
     * @Serializer\Type("string")
     * @SWG\Property(description="Token da próxima página")
     */
    private $nextPageToken;

    /**
     * @var Usuario[]
     * @Serializer\Type("array<App\Entity\Google\Usuario>")
     */
    private $users;

    /**
     * @return mixed
     */
    public function getNextPageToken() {
        return $this->nextPageToken;
    }

    /**
     * @param mixed $nextPageToken
     * @return UsuarioLista
     */
    public function setNextPageToken($nextPageToken) {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsers() {
        return $this->users;
    }

    /**
     * @param mixed $users
     * @return UsuarioLista
     */
    public function setUsers($users) {
        $this->users = $users;
        return $this;
    }

}