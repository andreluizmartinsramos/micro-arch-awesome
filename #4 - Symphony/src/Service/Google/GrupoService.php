<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 07/05/2018
 * Time: 14:51
 */

namespace App\Service\Google;


class GrupoService extends AdminConsoleService
{
    public function get($idGroup): \Google_Service_Directory_Group {
        return $this->getServiceDirectory()->groups->get($idGroup);
    }

    public function post(\Google_Service_Directory_Group $postBody): \Google_Service_Directory_Group {
        return $this->getServiceDirectory()->groups->insert($postBody);
    }

    public function update($idGroup, \Google_Service_Directory_Group $postBody): \Google_Service_Directory_Group {
        return $this->getServiceDirectory()->groups->update($idGroup, $postBody);
    }

    public function delete($idGroup) {
        return $this->getServiceDirectory()->groups->delete($idGroup);
    }
}