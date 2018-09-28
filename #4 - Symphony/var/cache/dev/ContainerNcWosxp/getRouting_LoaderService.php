<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the public 'routing.loader' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/config/FileLocatorInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/FileLocator.php';
include_once $this->targetDirs[3].'/vendor/symfony/http-kernel/Config/FileLocator.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/LoaderInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/Loader.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/FileLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/XmlFileLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/YamlFileLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/PhpFileLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/GlobFileLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/DirectoryLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/ObjectRouteLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/DependencyInjection/ServiceRouterLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/AnnotationClassLoader.php';
include_once $this->targetDirs[3].'/vendor/sensio/framework-extra-bundle/Routing/AnnotatedRouteControllerLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/AnnotationFileLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/routing/Loader/AnnotationDirectoryLoader.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Routing/Loader/RestRouteProcessor.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Routing/Loader/DirectoryRouteLoader.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Inflector/InflectorInterface.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Inflector/DoctrineInflector.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Routing/Loader/Reader/RestActionReader.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Routing/Loader/Reader/RestControllerReader.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Routing/Loader/RestRouteLoader.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Routing/Loader/RestYamlCollectionLoader.php';
include_once $this->targetDirs[3].'/vendor/friendsofsymfony/rest-bundle/Routing/Loader/RestXmlCollectionLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Routing/AnnotatedRouteControllerLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/LoaderResolverInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/LoaderResolver.php';
include_once $this->targetDirs[3].'/vendor/symfony/config/Loader/DelegatingLoader.php';
include_once $this->targetDirs[3].'/vendor/symfony/framework-bundle/Routing/DelegatingLoader.php';

$a = ($this->services['kernel'] ?? $this->get('kernel'));
$b = ($this->privates['annotations.cached_reader'] ?? $this->getAnnotations_CachedReaderService());
$c = ($this->privates['controller_name_converter'] ?? $this->privates['controller_name_converter'] = new \Symfony\Bundle\FrameworkBundle\Controller\ControllerNameParser($a));

$d = new \Symfony\Component\HttpKernel\Config\FileLocator($a, ($this->targetDirs[3].'/src/Resources'), array(0 => ($this->targetDirs[3].'/src')));

$e = new \Sensio\Bundle\FrameworkExtraBundle\Routing\AnnotatedRouteControllerLoader($b);

$f = new \FOS\RestBundle\Routing\Loader\RestRouteProcessor();

$g = new \Symfony\Bundle\FrameworkBundle\Routing\AnnotatedRouteControllerLoader($b);

$h = new \Symfony\Component\Config\Loader\LoaderResolver();
$h->addLoader(new \Symfony\Component\Routing\Loader\XmlFileLoader($d));
$h->addLoader(new \Symfony\Component\Routing\Loader\YamlFileLoader($d));
$h->addLoader(new \Symfony\Component\Routing\Loader\PhpFileLoader($d));
$h->addLoader(new \Symfony\Component\Routing\Loader\GlobFileLoader($d));
$h->addLoader(new \Symfony\Component\Routing\Loader\DirectoryLoader($d));
$h->addLoader(new \Symfony\Component\Routing\Loader\DependencyInjection\ServiceRouterLoader($this));
$h->addLoader($e);
$h->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($d, $e));
$h->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($d, $e));
$h->addLoader(new \FOS\RestBundle\Routing\Loader\DirectoryRouteLoader($d, $f));
$h->addLoader(new \FOS\RestBundle\Routing\Loader\RestRouteLoader($this, $d, $c, new \FOS\RestBundle\Routing\Loader\Reader\RestControllerReader(new \FOS\RestBundle\Routing\Loader\Reader\RestActionReader($b, ($this->privates['fos_rest.request.param_fetcher.reader'] ?? $this->getFosRest_Request_ParamFetcher_ReaderService()), new \FOS\RestBundle\Inflector\DoctrineInflector(), true, array('json' => false, 'html' => true), true), $b), NULL));
$h->addLoader(new \FOS\RestBundle\Routing\Loader\RestYamlCollectionLoader($d, $f, true, array('json' => false, 'html' => true), NULL));
$h->addLoader(new \FOS\RestBundle\Routing\Loader\RestXmlCollectionLoader($d, $f, true, array('json' => false, 'html' => true), NULL));
$h->addLoader($g);
$h->addLoader(new \Symfony\Component\Routing\Loader\AnnotationDirectoryLoader($d, $g));
$h->addLoader(new \Symfony\Component\Routing\Loader\AnnotationFileLoader($d, $g));

return $this->services['routing.loader'] = new \Symfony\Bundle\FrameworkBundle\Routing\DelegatingLoader($c, $h);
