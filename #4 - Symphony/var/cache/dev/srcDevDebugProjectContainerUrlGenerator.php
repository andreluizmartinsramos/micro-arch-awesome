<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = array(
        '_twig_error_test' => array(array('code', '_format'), array('_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code' => '\\d+'), array(array('variable', '.', '[^/]++', '_format'), array('variable', '/', '\\d+', 'code'), array('text', '/_error')), array(), array()),
        'app.swagger' => array(array(), array('_controller' => 'nelmio_api_doc.controller.swagger'), array(), array(array('text', '/doc.json')), array(), array()),
        'app.swagger_ui' => array(array(), array('_controller' => 'nelmio_api_doc.controller.swagger_ui'), array(), array(array('text', '/doc')), array(), array()),
        'app.home' => array(array(), array('_controller' => 'nelmio_api_doc.controller.swagger_ui'), array(), array(array('text', '/')), array(), array()),
        'app_api_calendario_get' => array(array('idCalendario'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::getAction'), array(), array(array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_post' => array(array(), array('_controller' => 'App\\Controller\\Api\\CalendarioController::postAction'), array(), array(array('text', '/api/calendario/')), array(), array()),
        'app_api_calendario_put' => array(array('idCalendario'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::putAction'), array(), array(array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_delete' => array(array('idCalendario'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::deleteAction'), array(), array(array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_getallevento' => array(array('idCalendario'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::getAllEventoAction'), array(), array(array('text', '/evento'), array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_getevento' => array(array('idCalendario', 'idEvento'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::getEventoAction'), array(), array(array('variable', '/', '[^/]++', 'idEvento'), array('text', '/evento'), array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_postevento' => array(array('idCalendario'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::postEventoAction'), array(), array(array('text', '/evento'), array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_putevento' => array(array('idCalendario', 'idEvento'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::putEventoAction'), array(), array(array('variable', '/', '[^/]++', 'idEvento'), array('text', '/evento'), array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_removeevento' => array(array('idCalendario', 'idEvento'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::removeEventoAction'), array(), array(array('variable', '/', '[^/]++', 'idEvento'), array('text', '/evento'), array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_postusuario' => array(array('idCalendario', 'idUsuario'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::postUsuarioAction'), array(), array(array('variable', '/', '[^/]++', 'idUsuario'), array('text', '/usuario'), array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_calendario_removeusuario' => array(array('idCalendario', 'idUsuario'), array('_controller' => 'App\\Controller\\Api\\CalendarioController::removeUsuarioAction'), array(), array(array('variable', '/', '[^/]++', 'idUsuario'), array('text', '/usuario'), array('variable', '/', '[^/]++', 'idCalendario'), array('text', '/api/calendario')), array(), array()),
        'app_api_curso_id' => array(array('idCurso'), array('_controller' => 'App\\Controller\\Api\\CursoController::idAction'), array(), array(array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_post' => array(array(), array('_controller' => 'App\\Controller\\Api\\CursoController::postAction'), array(), array(array('text', '/api/curso/')), array(), array()),
        'app_api_curso_put' => array(array('idCurso'), array('_controller' => 'App\\Controller\\Api\\CursoController::putAction'), array(), array(array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_delete' => array(array('idCurso'), array('_controller' => 'App\\Controller\\Api\\CursoController::deleteAction'), array(), array(array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_getestudante' => array(array('idCurso'), array('_controller' => 'App\\Controller\\Api\\CursoController::getEstudanteAction'), array(), array(array('text', '/estudante'), array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_postestudante' => array(array('idCurso'), array('_controller' => 'App\\Controller\\Api\\CursoController::postEstudanteAction'), array(), array(array('text', '/estudante'), array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_idestudante' => array(array('idCurso', 'idEstudante'), array('_controller' => 'App\\Controller\\Api\\CursoController::idEstudanteAction'), array(), array(array('variable', '/', '[^/]++', 'idEstudante'), array('text', '/estudante'), array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_deleteestudante' => array(array('idCurso', 'idEstudante'), array('_controller' => 'App\\Controller\\Api\\CursoController::deleteEstudanteAction'), array(), array(array('variable', '/', '[^/]++', 'idEstudante'), array('text', '/estudante'), array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_getprofessor' => array(array('idCurso'), array('_controller' => 'App\\Controller\\Api\\CursoController::getProfessorAction'), array(), array(array('text', '/professor'), array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_postprofessor' => array(array('idCurso'), array('_controller' => 'App\\Controller\\Api\\CursoController::postProfessorAction'), array(), array(array('text', '/professor'), array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_idprofessor' => array(array('idCurso', 'idProfessor'), array('_controller' => 'App\\Controller\\Api\\CursoController::idProfessorAction'), array(), array(array('variable', '/', '[^/]++', 'idProfessor'), array('text', '/professor'), array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_curso_deleteprofessor' => array(array('idCurso', 'idProfessor'), array('_controller' => 'App\\Controller\\Api\\CursoController::deleteProfessorAction'), array(), array(array('variable', '/', '[^/]++', 'idProfessor'), array('text', '/professor'), array('variable', '/', '[^/]++', 'idCurso'), array('text', '/api/curso')), array(), array()),
        'app_api_usuario_id' => array(array('id'), array('_controller' => 'App\\Controller\\Api\\UsuarioController::idAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/api/usuario')), array(), array()),
        'app_api_usuario_post' => array(array(), array('_controller' => 'App\\Controller\\Api\\UsuarioController::postAction'), array(), array(array('text', '/api/usuario/')), array(), array()),
        'app_api_usuario_update' => array(array('id'), array('_controller' => 'App\\Controller\\Api\\UsuarioController::updateAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/api/usuario')), array(), array()),
        'app_api_usuario_delete' => array(array('id'), array('_controller' => 'App\\Controller\\Api\\UsuarioController::deleteAction'), array(), array(array('variable', '/', '[^/]++', 'id'), array('text', '/api/usuario')), array(), array()),
    );
        }
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && (self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
            unset($parameters['_locale']);
            $name .= '.'.$locale;
        } elseif (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
