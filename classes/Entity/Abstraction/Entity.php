<?php

/*
 * Copyright (C) 2018 Bernardo Amado
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace OJSscript\Entity\Abstraction;
use OJSscript\Interfaces\Cloneable;
use OJSscript\Interfaces\ArrayRepresentation;
use OJSscript\Core\InputValidator;

/**
 * Generic class to encapsulate an object properties. This class is to be 
 * extended by all of the classes that represent OJS data.
 *
 * @author bernardo
 */
class Entity implements Cloneable, ArrayRepresentation
{
    
    /**
     * Array that encapsulates the object's properties
     * @var array
     */
    protected $properties;
    
    /**
     * Initializes the entity's properties with as an empty array.
     * @return void
     */
    public function __construct()
    {
        $this->properties = array();
    }
    
    /**
     * Checks if the entity has the specified property.
     * @param string $propertyName
     * @return boolean
     */
    protected function hasProperty($propertyName)
    {
        return array_key_exists($propertyName, $this->properties);
    }
    
    /**
     * Get the specified entity's property. If the property does not exist
     * returns false.
     * @param string $propertyName
     * @return mixed
     */
    protected function getProperty($propertyName)
    {
        if ($this->hasProperty($propertyName)) {
            return $this->properties[$propertyName];
        } else {
            return false;
        }
    }
    
    /**
     * Sets the specified entity's property.
     * @param string $propertyName
     * @param mixed $propertyValue
     * @param string $propertyType
     * @param boolean $nullable
     * @param integer $maxSize
     * @return boolean
     */
    protected function setProperty(
        $propertyName,
        $propertyValue,
        $propertyType = null,
        $nullable = false,
        $maxSize = null
    ) {
        if (
            $propertyType !== null &&
            !InputValidator::validate($propertyValue, $propertyType)
        ) {
            return false;
        }
        
        if (!$nullable && ($propertyValue === null)) {
            return false;
        } 
        
        if (is_string($propertyValue) && $maxSize > 0) {
            $propertyValue = substr($propertyValue, 0, $maxSize);
        } 
        elseif (!$nullable && ($propertyType === 'integer')) {
            $propertyValue = (int) $propertyValue;
        }
        
        if (InputValidator::validate($propertyName, 'string')) {
            $this->properties[$propertyName] = $propertyValue;
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Returns an array with the entries 'operation' and 'tableName' 
     * @param string $methodName
     * @return array
     */
    protected function separateOperationAndTableName($methodName)
    {
        $matches = array();
        preg_match_all('/[A-Z][^A-Z]*/', $methodName, $matches);
        
        /* @var $Words array */
        $Words = $matches[0];
        
        //the stop position is the position of the first capital letter
        $stopPosition = strpos($methodName, $Words[0]);
        
        //the quantity of characters the substring must have
        $length = $stopPosition + 1;
        
        $operation = substr($methodName, 0, $length);
        
        //the array with the words in lowercase
        $words = array_map('strtolower', $Words);
        
        $tableName = implode('_', $words);
        
        return array('operation' => $operation, 'tableName' => $tableName);
    }
    
    /**
     * This method is implemented in order to avoid declare multiple getters for
     * the Entities.
     * @param string $name
     * @param mixed $arguments
     * @return mixed
     */
    public function __call($name, $arguments = null)
    {
        if (!empty($arguments)) {
            return false;
        }
        
        $arr = $this->separateOperationAndTableName($name);
        $operation = $arr['operation'];
        $tableName = $arr['tableName'];
        
        if ($operation === 'get') {
            return $this->getProperty($tableName);
        } else {
            return false;
        }
    }

    /**
     * Returns a new instance with the same properties.
     * @return Entity
     */
    public function cloneInstance()
    {
        $clone = new Entity();
        foreach ($this->properties as $propertyName => $propertyValue) {
            $clone->setProperty($propertyName, $propertyValue);
        }
        return $clone;
    }
    
    /**
     * Clones the Entity
     * @return Entity
     */
    public function __clone()
    {
        return $this->cloneInstance();
    }
    
    /**
     * Array representation of the Entity
     * @return array
     */
    public function asArray()
    {
        $arrReturn = array();
        foreach ($this->properties as $propertyName => $propertyValue) {
            if (is_a(
                $propertyValue,
                '\OJSscript\Entity\Abstraction\Entity'
            )) {
                /* @var $propertyValue Entity */
                $arrReturn[$propertyName] = $propertyValue->asArray();
                
            } elseif (is_a(
                $propertyValue,
                '\OJSscript\Entity\Abstraction\EntitySetting'
            )) {
                /* @var $propertyValue EntitySetting */
                $arrReturn[$propertyName] = $propertyValue->asArray();
                
            } else {
                $arrReturn[$propertyName] = $propertyValue;
            }
        }
        
        return $arrReturn;
    }

}
