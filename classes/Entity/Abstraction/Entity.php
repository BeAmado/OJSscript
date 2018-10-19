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
use OJSscript\Interfaces\LoadFromArray;
use OJSscript\Core\InputValidator;

/**
 * Generic class to encapsulate an object properties. This class is to be 
 * extended by all of the classes that represent OJS data.
 *
 * @author bernardo
 */
class Entity implements Cloneable, ArrayRepresentation, LoadFromArray
{
    
    /**
     * Array that encapsulates the object's properties.
     * 
     * @var array
     */
    protected $properties;
    
    /**
     * Array that encapsulates the Entities, or array of Entities, that are 
     * logical children of the object. 
     * 
     * For example: if the Entity is an article then the childProperties would 
     * be array of article_files, array of article_galleys(array) and so on...
     * 
     * @var array
     */
    protected $childEntities;


    /**
     * Array that stores the names of the properties that cannot be null.
     * 
     * @var array
     */
    protected $notNullableProperties;


    /**
     * Initializes the entity's properties with as an empty array.
     * @return void
     */
    public function __construct()
    {
        $this->properties = array();
        $this->notNullableProperties = array();
    }
    
    /**
     * Checks if the entity has the specified property.
     * 
     * @param string $propertyName - The name of the property being searched.
     * @return boolean
     */
    public function hasProperty($propertyName)
    {
        return array_key_exists($propertyName, $this->properties);
    }
    
    /**
     * Checks if the entity is well formed.
     * 
     * The Entity is considered _well formed_ if *it has all its required 
     * properties* and *not any of them is null*.
     * By default this functions returns a boolean which indicates whether or 
     * not the Entity is _well formed_. If an argument is passed and it is 
     * evaluated as a boolean true value, then an array with the fields 
     * 'wellFormed' and 'informations' is returned. 
     * 
     * @param boolean $returnInformations - Whether or not to return an array 
     * with informations. The default is _false_.
     * 
     * @return boolean|array
     */
    public function isWellFormed($returnInformations = false)
    {
        $info = '';
        $wellFormed = true;
        foreach ($this->notNullableProperties as $notNullableProperty) {
            if (!$this->hasProperty($notNullableProperty)) {
                $info .= 'Missing the required property "'
                    . $notNullableProperty . '".' . PHP_EOL;
                $wellFormed = false;
            }
            elseif ($this->getProperty($notNullableProperty) === null) {
                $info .= 'The property "' . $notNullableProperty . '" cannot '
                    . 'be null.' . PHP_EOL;
                $wellFormed = false;
            }
        }
        
        if ($wellFormed) {
            $info .= 'The Entity is well formed.' . PHP_EOL;
        }
        
        if ($returnInformations) {
            return array(
                'wellFormed' => $wellFormed,
                'informations' => $info,
            );
        } else {
            return $wellFormed;
        }
    }
    
    /**
     * Get the specified entity's property. If the property does not exist
     * returns false.
     * 
     * @param string $propertyName
     * @return mixed
     */
    public function getProperty($propertyName)
    {
        if ($this->hasProperty($propertyName)) {
            return $this->properties[$propertyName];
        } else {
            return false;
        }
    }
    
    /**
     * Sets the specified entity's property.
     * 
     * @param string $propertyName
     * @param mixed $propertyValue
     * @param string $propertyType
     * @param boolean $nullable
     * @param integer $maxSize
     * @return boolean
     */
    public function setProperty(
        $propertyName,
        $propertyValue,
        $propertyType = null,
        $nullable = false,
        $maxSize = null
    ) {
        if (!$nullable && ($propertyValue === null)) {
            return false;
        } 
        elseif (!$nullable && ($propertyType === 'integer')) {
            /*
             * coerce the type to an integer. This way the integers fetched from
             *xml data, which might come as strings, can be directly pass as
             *arguments
             */
            $propertyValue = (int) $propertyValue;
        }
        elseif (
            is_string($propertyValue)           && 
            $maxSize > 0                        && 
            strlen($propertyValue) > $maxSize
        ) {
            //Cut the string to fit the size that is accepted by tthe database
            $propertyValue = substr($propertyValue, 0, $maxSize);
        } 
        
        if (
            $propertyType !== null &&
            !InputValidator::validate($propertyValue, $propertyType)
        ) {
            return false;
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
     * Check if the array is valid for loading entity's information.
     * 
     * @param array $array
     * @return boolean
     */
    protected function arrayIsValid($array)
    {
        if (!is_array($array) || empty($array)) {
            return false;
        }
       
        $fields = array_keys($array);
        
        $intersection = array_intersect($this->notNullableProperties, $fields);
        
        if (count($intersection) === count($this->notNullableProperties)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Array representation of the Entity
     * 
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

    public function loadArray($array)
    {
        
    }

}
