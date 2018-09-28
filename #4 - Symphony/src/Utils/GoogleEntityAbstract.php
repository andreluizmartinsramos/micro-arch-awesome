<?php
/**
 * Created by PhpStorm.
 * User: rafael.s.ribeiro
 * Date: 28/05/2018
 * Time: 14:59
 */

namespace App\Utils;


use App\Annotation\GoogleEntity\Entity;
use App\Annotation\GoogleEntity\Property;
use App\Entity\Api\Registro;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpFoundation\Request;


abstract class GoogleEntityAbstract extends Registro
{
    public function fromRequest(Request $request) {
        $annotationReader = new AnnotationReader();

        /** @var \Symfony\Component\HttpFoundation\ParameterBag $data */
        $data = $request->request;
        foreach ($data as $field => $value) {
            $setouAnnotation = false;
            $reflectionProperty = new \ReflectionProperty($this, StringUtils::convertParam($field));
            /** @var Property $requestAnnotation */
            $requestAnnotation = $annotationReader->getPropertyAnnotation($reflectionProperty, 'App\Annotation\GoogleEntity\Request');
            if ($requestAnnotation) {
                if ($requestAnnotation->method) {
                    $reflectionMethod = new \ReflectionMethod($this, $requestAnnotation->method);
                    $reflectionMethod->invoke($this, $value);
                    $setouAnnotation = true;
                }
            }
            if (!$setouAnnotation) {
                $reflectionProperty->setAccessible(true);
                $reflectionProperty->setValue($this, $value);
            }
        }
        return $this;
    }

    public function fromGoogleEntity($googleEntity) {

        $annotationReader = new AnnotationReader();
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE);
        foreach ($properties as $property) {
            $reflectionProperty = new \ReflectionProperty($this, $property->getName());
            /** @var Property $propertyAnnotation */
            $propertyAnnotation = $annotationReader->getPropertyAnnotation($reflectionProperty, 'App\Annotation\GoogleEntity\Property');

            if ($propertyAnnotation) {
                if ($propertyAnnotation->schema) {
                    if (array_key_exists($propertyAnnotation->schema, $googleEntity->customSchemas) && array_key_exists($propertyAnnotation->googleFieldName, $googleEntity['customSchemas'][$propertyAnnotation->schema]))
                        $value = $googleEntity->customSchemas[$propertyAnnotation->schema][$propertyAnnotation->googleFieldName];
                    else
                        $value = null;
                } else {
                    $value = $googleEntity[$propertyAnnotation->googleFieldName];
                }
                $property->setAccessible(true);
                $property->setValue($this, $value);
            }
        }
        return $this;
    }

    public function toGoogleEntity() {

        $annotationReader = new AnnotationReader();
        $reflectionClass = new \ReflectionClass($this);

        /** @var Entity $classAnnotations */
        $classAnnotations = $annotationReader->getClassAnnotation($reflectionClass, 'App\Annotation\GoogleEntity\Entity');
        $googleClass = $classAnnotations->googleClass;

        $googleEntity = new $googleClass;
        $properties = $reflectionClass->getProperties(\ReflectionProperty::IS_PRIVATE);
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $reflectionProperty = new \ReflectionProperty($this, $property->getName());
            /** @var Property $propertyAnnotation */
            $propertyAnnotation = $annotationReader->getPropertyAnnotation($reflectionProperty, 'App\Annotation\GoogleEntity\Property');
            if ($propertyAnnotation) {
                $value = $property->getValue($this);
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