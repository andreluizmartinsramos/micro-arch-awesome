<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 27/02/2018
 * Time: 16:13
 */

namespace App\Utils;


use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class GoogleMessagesError
{
    const MESSAGE_RESOURCE_NOT_FOUND = '';

    private $translator;

    public function __construct(TranslatorInterface $translator) {
        $this->translator = $translator;
    }

    public function trans(\Exception $exception) {
        $message = (json_decode($exception->getMessage())) ? json_decode($exception->getMessage()) : $exception->getMessage();

        if (isset($message) && isset($message->error) && isset($message->error->message))
            $erroMessage = $message->error->message;

        if (isset($erroMessage))
            return $this->translator->trans($erroMessage);
        return $message;
    }
}