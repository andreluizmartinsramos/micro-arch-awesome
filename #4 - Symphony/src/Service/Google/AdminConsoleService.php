<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 27/02/2018
 * Time: 09:54
 */

namespace App\Service\Google;


class AdminConsoleService
{
    const DEFAULT_CUSTOMER = 'my_customer';

    /**
     * https://admin.google.com/AdminHome?chromeless=1#OGX:ManageOauthClients
     */
    const SCOPES = [
        \Google_Service_Directory::ADMIN_DIRECTORY_USER_ALIAS,
        \Google_Service_Directory::ADMIN_DIRECTORY_USER,
        \Google_Service_Directory::ADMIN_DIRECTORY_CUSTOMER,
        \Google_Service_Directory::ADMIN_DIRECTORY_ORGUNIT,
        \Google_Service_Directory::ADMIN_DIRECTORY_USERSCHEMA,
        \Google_Service_Directory::ADMIN_DIRECTORY_DOMAIN,
        \Google_Service_Classroom::CLASSROOM_COURSES,
        \Google_Service_Classroom::CLASSROOM_ROSTERS,
        \Google_Service_Classroom::CLASSROOM_PROFILE_EMAILS,
        \Google_Service_Classroom::CLASSROOM_PROFILE_PHOTOS,
        \Google_Service_Calendar::CALENDAR,
        \Google_Service_Directory::ADMIN_DIRECTORY_GROUP
    ];

    /** @var \Google_Client  */
    private $googleClient;

    /** @var \Google_Service_Directory  */
    private $serviceDirectory;

    /** @var \Google_Service_Classroom  */
    private $serviceClassroom;

    public function __construct(\Google_Client $googleClient) {
        $this->googleClient = $googleClient;
        $this->googleClient->setScopes(self::SCOPES);

        $this->serviceDirectory = new \Google_Service_Directory($this->googleClient);
        $this->serviceClassroom = new \Google_Service_Classroom($this->googleClient);
    }

    public function getServiceDirectory(): \Google_Service_Directory {
        return $this->serviceDirectory;
    }

    public function getServiceClassroom(): \Google_Service_Classroom {
        return $this->serviceClassroom;
    }

    public function setSubject($subject) {
        $this->googleClient->setSubject($subject);
        return $this;
    }

    /**
     * @return \Google_Client
     */
    public function getGoogleClient(): \Google_Client {
        return $this->googleClient;
    }



}