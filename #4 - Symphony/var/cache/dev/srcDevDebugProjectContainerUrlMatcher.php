<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcDevDebugProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = $allowSchemes = array();
        if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
            return $ret;
        }
        if ($allow) {
            throw new MethodNotAllowedException(array_keys($allow));
        }
        if (!in_array($this->context->getMethod(), array('HEAD', 'GET'), true)) {
            // no-op
        } elseif ($allowSchemes) {
            redirect_scheme:
            $scheme = $this->context->getScheme();
            $this->context->setScheme(key($allowSchemes));
            try {
                if ($ret = $this->doMatch($pathinfo)) {
                    return $this->redirect($pathinfo, $ret['_route'], $this->context->getScheme()) + $ret;
                }
            } finally {
                $this->context->setScheme($scheme);
            }
        } elseif ('/' !== $pathinfo) {
            $pathinfo = '/' !== $pathinfo[-1] ? $pathinfo.'/' : substr($pathinfo, 0, -1);
            if ($ret = $this->doMatch($pathinfo, $allow, $allowSchemes)) {
                return $this->redirect($pathinfo, $ret['_route']) + $ret;
            }
            if ($allowSchemes) {
                goto redirect_scheme;
            }
        }

        throw new ResourceNotFoundException();
    }

    private function doMatch(string $rawPathinfo, array &$allow = array(), array &$allowSchemes = array()): ?array
    {
        $allow = $allowSchemes = array();
        $pathinfo = rawurldecode($rawPathinfo);
        $context = $this->context;
        $requestMethod = $canonicalMethod = $context->getMethod();

        if ('HEAD' === $requestMethod) {
            $canonicalMethod = 'GET';
        }

        switch ($pathinfo) {
            default:
                $routes = array(
                    '/doc.json' => array(array('_route' => 'app.swagger', '_controller' => 'nelmio_api_doc.controller.swagger'), null, array('GET' => 0), null),
                    '/doc' => array(array('_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'), null, array('GET' => 0), null),
                    '/' => array(array('_route' => 'app.home', '_controller' => 'nelmio_api_doc.controller.swagger_ui'), null, array('GET' => 0), null),
                    '/api/calendario/' => array(array('_route' => 'app_api_calendario_post', '_controller' => 'App\\Controller\\Api\\CalendarioController::postAction'), null, array('POST' => 0), null),
                    '/api/curso/' => array(array('_route' => 'app_api_curso_post', '_controller' => 'App\\Controller\\Api\\CursoController::postAction'), null, array('POST' => 0), null),
                    '/api/usuario/' => array(array('_route' => 'app_api_usuario_post', '_controller' => 'App\\Controller\\Api\\UsuarioController::postAction'), null, array('POST' => 0), null),
                );

                if (!isset($routes[$pathinfo])) {
                    break;
                }
                list($ret, $requiredHost, $requiredMethods, $requiredSchemes) = $routes[$pathinfo];

                $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                    if ($hasRequiredScheme) {
                        $allow += $requiredMethods;
                    }
                    break;
                }
                if (!$hasRequiredScheme) {
                    $allowSchemes += $requiredSchemes;
                    break;
                }

                return $ret;
        }

        $matchedPathinfo = $pathinfo;
        $regexList = array(
            0 => '{^(?'
                    .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                    .'|/api/(?'
                        .'|c(?'
                            .'|alendario/([^/]++)(?'
                                .'|(*:75)'
                                .'|/(?'
                                    .'|evento(?'
                                        .'|(*:95)'
                                        .'|/([^/]++)(?'
                                            .'|(*:114)'
                                        .')'
                                        .'|(*:123)'
                                    .')'
                                    .'|usuario/([^/]++)(?'
                                        .'|(*:151)'
                                    .')'
                                .')'
                            .')'
                            .'|urso/([^/]++)(?'
                                .'|(*:178)'
                                .'|/(?'
                                    .'|estudante(?'
                                        .'|(*:202)'
                                        .'|/([^/]++)(?'
                                            .'|(*:222)'
                                        .')'
                                    .')'
                                    .'|professor(?'
                                        .'|(*:244)'
                                        .'|/([^/]++)(?'
                                            .'|(*:264)'
                                        .')'
                                    .')'
                                .')'
                            .')'
                        .')'
                        .'|usuario/([^/]++)(?'
                            .'|(*:296)'
                        .')'
                    .')'
                .')$}sD',
        );

        foreach ($regexList as $offset => $regex) {
            while (preg_match($regex, $matchedPathinfo, $matches)) {
                switch ($m = (int) $matches['MARK']) {
                    case 75:
                        $matches = array('idCalendario' => $matches[1] ?? null);

                        // app_api_calendario_get
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_calendario_get') + $matches, array('_controller' => 'App\\Controller\\Api\\CalendarioController::getAction'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_app_api_calendario_get;
                        }

                        return $ret;
                        not_app_api_calendario_get:

                        // app_api_calendario_put
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_calendario_put') + $matches, array('_controller' => 'App\\Controller\\Api\\CalendarioController::putAction'));
                        if (!isset(($a = array('PUT' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_calendario_put;
                        }

                        return $ret;
                        not_app_api_calendario_put:

                        // app_api_calendario_delete
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_calendario_delete') + $matches, array('_controller' => 'App\\Controller\\Api\\CalendarioController::deleteAction'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_calendario_delete;
                        }

                        return $ret;
                        not_app_api_calendario_delete:

                        break;
                    case 114:
                        $matches = array('idCalendario' => $matches[1] ?? null, 'idEvento' => $matches[2] ?? null);

                        // app_api_calendario_getevento
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_calendario_getevento') + $matches, array('_controller' => 'App\\Controller\\Api\\CalendarioController::getEventoAction'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_app_api_calendario_getevento;
                        }

                        return $ret;
                        not_app_api_calendario_getevento:

                        // app_api_calendario_putevento
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_calendario_putevento') + $matches, array('_controller' => 'App\\Controller\\Api\\CalendarioController::putEventoAction'));
                        if (!isset(($a = array('PUT' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_calendario_putevento;
                        }

                        return $ret;
                        not_app_api_calendario_putevento:

                        // app_api_calendario_removeevento
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_calendario_removeevento') + $matches, array('_controller' => 'App\\Controller\\Api\\CalendarioController::removeEventoAction'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_calendario_removeevento;
                        }

                        return $ret;
                        not_app_api_calendario_removeevento:

                        break;
                    case 151:
                        $matches = array('idCalendario' => $matches[1] ?? null, 'idUsuario' => $matches[2] ?? null);

                        // app_api_calendario_postusuario
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_calendario_postusuario') + $matches, array('_controller' => 'App\\Controller\\Api\\CalendarioController::postUsuarioAction'));
                        if (!isset(($a = array('POST' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_calendario_postusuario;
                        }

                        return $ret;
                        not_app_api_calendario_postusuario:

                        // app_api_calendario_removeusuario
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_calendario_removeusuario') + $matches, array('_controller' => 'App\\Controller\\Api\\CalendarioController::removeUsuarioAction'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_calendario_removeusuario;
                        }

                        return $ret;
                        not_app_api_calendario_removeusuario:

                        break;
                    case 178:
                        $matches = array('idCurso' => $matches[1] ?? null);

                        // app_api_curso_id
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_id') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::idAction'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_id;
                        }

                        return $ret;
                        not_app_api_curso_id:

                        // app_api_curso_put
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_put') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::putAction'));
                        if (!isset(($a = array('PUT' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_put;
                        }

                        return $ret;
                        not_app_api_curso_put:

                        // app_api_curso_delete
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_delete') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::deleteAction'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_delete;
                        }

                        return $ret;
                        not_app_api_curso_delete:

                        break;
                    case 202:
                        $matches = array('idCurso' => $matches[1] ?? null);

                        // app_api_curso_getestudante
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_getestudante') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::getEstudanteAction'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_getestudante;
                        }

                        return $ret;
                        not_app_api_curso_getestudante:

                        // app_api_curso_postestudante
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_postestudante') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::postEstudanteAction'));
                        if (!isset(($a = array('POST' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_postestudante;
                        }

                        return $ret;
                        not_app_api_curso_postestudante:

                        break;
                    case 222:
                        $matches = array('idCurso' => $matches[1] ?? null, 'idEstudante' => $matches[2] ?? null);

                        // app_api_curso_idestudante
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_idestudante') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::idEstudanteAction'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_idestudante;
                        }

                        return $ret;
                        not_app_api_curso_idestudante:

                        // app_api_curso_deleteestudante
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_deleteestudante') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::deleteEstudanteAction'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_deleteestudante;
                        }

                        return $ret;
                        not_app_api_curso_deleteestudante:

                        break;
                    case 244:
                        $matches = array('idCurso' => $matches[1] ?? null);

                        // app_api_curso_getprofessor
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_getprofessor') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::getProfessorAction'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_getprofessor;
                        }

                        return $ret;
                        not_app_api_curso_getprofessor:

                        // app_api_curso_postprofessor
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_postprofessor') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::postProfessorAction'));
                        if (!isset(($a = array('POST' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_postprofessor;
                        }

                        return $ret;
                        not_app_api_curso_postprofessor:

                        break;
                    case 264:
                        $matches = array('idCurso' => $matches[1] ?? null, 'idProfessor' => $matches[2] ?? null);

                        // app_api_curso_idprofessor
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_idprofessor') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::idProfessorAction'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_idprofessor;
                        }

                        return $ret;
                        not_app_api_curso_idprofessor:

                        // app_api_curso_deleteprofessor
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_curso_deleteprofessor') + $matches, array('_controller' => 'App\\Controller\\Api\\CursoController::deleteProfessorAction'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_curso_deleteprofessor;
                        }

                        return $ret;
                        not_app_api_curso_deleteprofessor:

                        break;
                    case 296:
                        $matches = array('id' => $matches[1] ?? null);

                        // app_api_usuario_id
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_usuario_id') + $matches, array('_controller' => 'App\\Controller\\Api\\UsuarioController::idAction'));
                        if (!isset(($a = array('GET' => 0))[$canonicalMethod])) {
                            $allow += $a;
                            goto not_app_api_usuario_id;
                        }

                        return $ret;
                        not_app_api_usuario_id:

                        // app_api_usuario_update
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_usuario_update') + $matches, array('_controller' => 'App\\Controller\\Api\\UsuarioController::updateAction'));
                        if (!isset(($a = array('PUT' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_usuario_update;
                        }

                        return $ret;
                        not_app_api_usuario_update:

                        // app_api_usuario_delete
                        $ret = $this->mergeDefaults(array('_route' => 'app_api_usuario_delete') + $matches, array('_controller' => 'App\\Controller\\Api\\UsuarioController::deleteAction'));
                        if (!isset(($a = array('DELETE' => 0))[$requestMethod])) {
                            $allow += $a;
                            goto not_app_api_usuario_delete;
                        }

                        return $ret;
                        not_app_api_usuario_delete:

                        break;
                    default:
                        $routes = array(
                            35 => array(array('_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'), array('code', '_format'), null, null),
                            95 => array(array('_route' => 'app_api_calendario_getallevento', '_controller' => 'App\\Controller\\Api\\CalendarioController::getAllEventoAction'), array('idCalendario'), array('GET' => 0), null),
                            123 => array(array('_route' => 'app_api_calendario_postevento', '_controller' => 'App\\Controller\\Api\\CalendarioController::postEventoAction'), array('idCalendario'), array('POST' => 0), null),
                        );

                        list($ret, $vars, $requiredMethods, $requiredSchemes) = $routes[$m];

                        foreach ($vars as $i => $v) {
                            if (isset($matches[1 + $i])) {
                                $ret[$v] = $matches[1 + $i];
                            }
                        }

                        $hasRequiredScheme = !$requiredSchemes || isset($requiredSchemes[$context->getScheme()]);
                        if ($requiredMethods && !isset($requiredMethods[$canonicalMethod]) && !isset($requiredMethods[$requestMethod])) {
                            if ($hasRequiredScheme) {
                                $allow += $requiredMethods;
                            }
                            break;
                        }
                        if (!$hasRequiredScheme) {
                            $allowSchemes += $requiredSchemes;
                            break;
                        }

                        return $ret;
                }

                if (296 === $m) {
                    break;
                }
                $regex = substr_replace($regex, 'F', $m - $offset, 1 + strlen($m));
                $offset += strlen($m);
            }
        }
        if ('/' === $pathinfo && !$allow) {
            throw new Symfony\Component\Routing\Exception\NoConfigurationException();
        }

        return null;
    }
}
