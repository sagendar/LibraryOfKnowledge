<?php

namespace M151\LibraryOK\Model;

use  Psr\Container\ContainerInterface;


/**
 * Class ArrayObject
 * @package M151\LibraryOK\Model
 */
abstract class ArrayObject
{
    protected $properties;

    /**
     * @var ContainerInterface
     */
    public $container;

    /**
     * ArrayObject constructor.
     * @param $container
     */
    public function __construct($container = null)
    {
        if($container){
            $this->container = $container;
        }
    }


    /**
     * @return array
     */
    public function getArrayCopy()
    {
        $ret = [];

        foreach ($this->getProperties() as $prop) {
            if (is_object($this->{$prop}) && method_exists($this->{$prop}, 'getArrayCopy')) {
                $ret[$prop] = $this->{$prop}->getArrayCopy();
            } else {
                $ret[$prop] = $this->{$prop};
            }
        }
        return $ret;
    }

    /**
     * @param array $data
     */
    public function exchangeArray($data)
    {
        foreach ($this->getProperties() as $prop) {
            if(!$data) {
                continue;
            }
            if (array_key_exists($prop, $data)) {
                $this->{$prop} = $data[$prop];
            }
        }
    }

    /**
     * @return array
     */
    private function getProperties()
    {
        if (!is_null($this->properties)) {
            return $this->properties;
        }
        $this->properties = [];
        $refl = new \ReflectionClass($this);
        /** @var \ReflectionProperty $reflProp */
        foreach ($refl->getProperties(\ReflectionProperty::IS_PUBLIC) as $reflProp) {
            $this->properties[] = $reflProp->getName();
        }
        return $this->properties;
    }


}