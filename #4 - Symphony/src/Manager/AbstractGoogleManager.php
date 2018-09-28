<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 13/06/2018
 * Time: 10:40
 */

namespace App\Manager;


use App\Annotation\GoogleEntity\Property;
use App\Utils\StringUtils;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpFoundation\Request;

class AbstractGoogleManager
{
    public function fromRequest(&$entity, Request $request): void {
        $annotationReader = new AnnotationReader();

        /** @var \Symfony\Component\HttpFoundation\ParameterBag $data */
        $data = $request->request;
        foreach ($data as $field => $value) {
            $setouAnnotation = false;
            $reflectionProperty = new \ReflectionProperty($entity, StringUtils::convertParam($field));
            /** @var Property $requestAnnotation */
            $requestAnnotation = $annotationReader->getPropertyAnnotation($reflectionProperty, 'App\Annotation\GoogleEntity\Request');
            if ($requestAnnotation) {
                if ($requestAnnotation->method) {
                    $reflectionMethod = new \ReflectionMethod($entity, $requestAnnotation->method);
                    $reflectionMethod->invoke($entity, $value);
                    $setouAnnotation = true;
                }
            }
            if (!$setouAnnotation) {
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($entity, $value);
            }
        }
    }

    public function fromGoogleEntity(&$entity, $googleEntity): void {

        $annotationReader = new AnnotationReader();
        $reflectionClass = new \ReflectionClass($entity);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE);
        foreach ($properties as $property) {
            $reflectionProperty = new \ReflectionProperty($entity, $property->getName());
            /** @var Property $propertyAnnotation */
            $propertyAnnotation = $annotationReader->getPropertyAnnotation($reflectionProperty, 'App\Annotation\GoogleEntity\Property');

            if ($propertyAnnotation) {
                if ($propertyAnnotation->schema) {
                    if (array_key_exists($propertyAnnotation->schema, $googleEntity->customSchemas) && array_key_exists($propertyAnnotation->googleFieldName, $googleEntity['customSchemas'][$propertyAnnotation->schema]))
                        $value = $googleEntity->customSchemas[$propertyAnnotation->schema][$propertyAnnotation->googleFieldName];
                    else {
                        $value = null;
                    }
                } else {
                    $value = $googleEntity[$propertyAnnotation->googleFieldName];

                }
                $property->setAccessible(true);
                $property->setValue($entity, $value);
            }
        }
    }

    public function toGoogleEntity(&$entity) {

        $annotationReader = new AnnotationReader();
        $reflectionClass = new \ReflectionClass($entity);

        /** @var Entity $classAnnotations */
        $classAnnotations = $annotationReader->getClassAnnotation($reflectionClass, 'App\Annotation\GoogleEntity\Entity');
        $googleClass = $classAnnotations->googleClass;

        $googleEntity = new $googleClass;
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE);
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $reflectionProperty = new \ReflectionProperty($entity, $property->getName());
            /** @var Property $propertyAnnotation */
            $propertyAnnotation = $annotationReader->getPropertyAnnotation($reflectionProperty, 'App\Annotation\GoogleEntity\Property');
            if ($propertyAnnotation) {
                $value = $property->getValue($entity);
                if ($propertyAnnotation->schema) {
                    $googleEntity->customSchemas[$propertyAnnotation->schema][$propertyAnnotation->googleFieldName] = $value;
                } else {
                    $googleEntity[$propertyAnnotation->googleFieldName] = $value;
                }
            }
        }

        return $googleEntity;
    }
}