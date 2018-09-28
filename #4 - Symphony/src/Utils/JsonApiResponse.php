<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 12/04/2018
 * Time: 15:51
 */

namespace App\Utils;

use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonApiResponse
{
    private $googleMessagesError;

    public function __construct(GoogleMessagesError $googleMessagesError) {
        $this->googleMessagesError = $googleMessagesError;
    }

    public function getJsonError(\Exception $exception): JsonResponse {
        $message = $this->googleMessagesError->trans($exception);
        $error = [
            "error" => [
                "code" => $exception->getCode(),
                "message" =>  $message
            ]
        ];

        return new JsonResponse(json_encode($error), $exception->getCode(), [], true);
    }

    static public function getJsonSucesso(string $code, string $message): JsonResponse {
        $success = [
            "success" => [
                "code" => $code,
                "message" => $message
            ]
        ];

        return new JsonResponse(json_encode($success), $code, [], true);
    }


}