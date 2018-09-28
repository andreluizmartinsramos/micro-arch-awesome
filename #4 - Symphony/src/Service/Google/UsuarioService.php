<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 27/02/2018
 * Time: 09:56
 */

namespace App\Service\Google;

class UsuarioService extends AdminConsoleService
{
    public function getUsers(string $id, $pageToken = null, $maxResult = 100) {
        $optParams = [
            'domain' => $id,
            'customer' => self::DEFAULT_CUSTOMER,
            'pageToken' => $pageToken,
            'maxResults' => $maxResult,
            'projection' => 'full',
        ];
        return $this->getServiceDirectory()->users->listUsers($optParams);
    }

    public function getUser($userKey) {
        $optParams = [
            'projection' => 'full',
        ];
        return $this->getServiceDirectory()->users->get($userKey, $optParams);
    }

    public function insert(\Google_Service_Directory_User $user) {
        return $this->getServiceDirectory()->users->insert($user);
    }

    public function update(\Google_Service_Directory_User $user) {
        return $this->getServiceDirectory()->users->update($user->getPrimaryEmail(), $user);
    }

    public function deleteUser($userKey) {
        return $this->getServiceDirectory()->users->delete($userKey);
    }
}