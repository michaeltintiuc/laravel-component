<?php

namespace Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use ReflectionClass;

abstract class TestCase extends BaseTestCase
{
    /**
     * Returns an accesible method for
     * a class using a Reflection Class.
     *
     * @param    string $methodName
     * @param    string $className
     * @return ReflectionMethod
     */
    protected static function getMethod(string $methodName, string $className)
    {
        $class = new ReflectionClass($className);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * Returns an accesible property for
     * a class using a Reflection Class.
     *
     * @param    string $propertyName
     * @param    string $className
     * @return ReflectionProperty
     */
    protected static function getProperty(string $propertyName, string $className)
    {
        $class = new ReflectionClass($className);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);
        return $property;
    }
}
