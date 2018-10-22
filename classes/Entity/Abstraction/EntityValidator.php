<?php

/*
 * Copyright (C) 2018 bernardo
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
use OJSscript\Core\InputValidator;

/**
 * Description of EntityValidator
 *
 * @author bernardo
 */
class EntityValidator
{
    /**
     * The name of the database table that the Entity represents
     * 
     * @var string
     */
    private $tableName;
    
    /**
     * The descriptions of the properties that the Entity to be validated has.
     * 
     * This property (attribute) is an array of object from the class 
     * PropertyDescription.
     * 
     * @var array 
     */
    private $propertiesDescriptions;
    
    /**
     * An array with the names of the associated entities that are allowed in 
     * the Entity to be validated.
     * 
     * @var array
     */
    private $allowedAssociatedEntities;
    
    /**
     * Initializes the EntityValidator, configuring it.
     * 
     * @param string $tableName - The name of the table that the entity 
     * represents.
     * 
     * @param array $propertiesDescriptions - The description of the entity's 
     * properties.
     */
    public function __construct($tableName, $propertiesDescriptions = null)
    {
        $this->tableName = $tableName;
        $this->propertiesDescriptions = $propertiesDescriptions;
    }
    
    /**
     * Returns the specified property description.
     * 
     * @param string $propertyName
     * @return mixed
     */
    private function getPropertyDescription($propertyName)
    {
        /* @var $propertyDescription PropertyDescription */
        foreach ($this->propertiesDescriptions as $propertyDescription) {
            if ($propertyDescription->getName() === $propertyName) {
                return $propertyDescription;
            }
        }
        
        return false;
    }
    
    /**
     * 
     * @param string $type
     * @param mixed $value
     * @return array  
     */
    private function validateVarchar($type, &$value)
    {
        /* @var $isValid boolean */
        $isValid = true;
        
        /* @var $message string */
        $message = '';
        
        if (!InputValidator::validate($value, 'string')) {
            $isValid = false;
            $message .= 'The property value must be of type "string".' 
                . PHP_EOL;
        }

        $openParens = strpos($type, '(');
        $closeParens = strpos($type, ')');
        $digits = $closeParens - $openParens - 1;
        $size = (int) substr($type, $openParens + 1, $digits);

        if (strlen($value) > $size) {
            $propertyValue = substr($propertyValue, 0, $size);
        }
        
        return array('isValid' => $isValid, 'message' => $message);
    }
    
    /**
     * 
     * @param string $type
     * @param mixed $value
     * @return array
     */
    private function validateInteger($type, &$value)
    {
        /* @var $isValid boolean */
        $isValid = true;
        
        /* @var $message string */
        $message = '';
        
        $openParens = strpos($type, '(');
        $closeParens = strpos($type, ')');
        /* @var $digits int */
        $digits = $closeParens - $openParens - 1;
        
        /* @var $maxSize int */
        $maxSize = (int) substr($type, $openParens + 1, $digits);
        
        /* @var $actualSize int */
        $actualSize = strlen("$value");
        
        if ($actualSize > $maxSize) {
            $isValid = false;
            $message .= "The number is too big. Its has $actualSize digits "
                . "while it must have at most $maxSize." . PHP_EOL;
        } elseif (is_string($value) && !is_numeric($value)) {
            $isValid = false;
            $message .= 'The value "' . $value . '" is NOT a numeric string.'
                . PHP_EOL;
        } elseif (!InputValidator::validate($value, 'integer')) {
            $isValid = false;
            $message .= 'The value "' . $value . '" is NOT a valid integer.'
                . PHP_EOL;
        }
        
        return array('isValid' => $isValid, 'message' => $message);
    }
    
    /**
     * 
     * @param string $propertyName The name of the property to be validated.
     * @param mixed $propertyValue The value of the property to be validated.
     * 
     * @return array The entries of the array are: 
     * 'isValid' -> boolean value indicating if the property value is valid.
     * 'message' -> a message indicating what went wrong if not valid.
     *
     */
    public function validateProperty($propertyName, &$propertyValue)
    {
        /* @var $isValid boolean */
        $isValid = true;
        
        /* @var $message string */
        $message = 'Property name: "' . $propertyName . '"';
        
        if (!InputValidator::validate($propertyName, 'string')) {
            $isValid = false;
            $message .= 'The property\'s name must be a string.' . PHP_EOL;
        }
        
        /* @var $propertyDescription PropertyDescription */
        $propertyDescription = $this->getPropertyDescription($propertyName);
        
        if (!$propertyDescription->getNullable() && ($propertyValue === null)) {
            $isValid = false;
            $message .= 'The property must not be null.' . PHP_EOL;
        }
        
        /* @var $type string */
        $type = $propertyDescription->getType();
        
        /* @var $validationMethod string */
        $validationMethod = null;
        
        if (strpos($type, 'varchar') !== false) {
            $validationMethod = 'validateVarchar';
        } elseif (strpos($type, 'int') !== false) {
            $validationMethod = 'validateInteger';
        } 
        
        /* @var $result array */
        $result = $this->$validationMethod($type, $propertyValue);
        if (!$result['isValid']) {
            $isValid = false;
        }
        $message .= $result['message'];
        
        return array('isValid' => $isValid, 'message' => $message);
        
    }
    
    /**
     * Returns an array with the names of the entities that are allowed.
     * 
     * @return array
     */
    public function getAllowedAssociatedEntitiesNames()
    {
        return $this->allowedAssociatedEntities;
    }
    
    /**
     * Validates the entity data.
     * 
     * @param Entity $entity
     * 
     * @param boolean $verbose
     * 
     * @return array
     */
    public function validateEntity($entity)
    {
        if (!is_a($entity, '\OJSscript\Entity\Abstraction\Entity') ||
            $this->tableName !== $entity->getName()) {
            return false;
        }
        
        /*@var $message string */
        $message = '';
        
        /*@var $isValid boolean */
        $isValid = true;
        
        /*@var $propertyDescription PropertyDescription */
        foreach ($this->propertiesDescriptions as $propertyDescription) {
            if ($entity->hasProperty($propertyDescription->getName())) {
                
            } else if (!$propertyDescription->getNullable()){
                $message .= 'The property "' . $propertyDescription . '", '
                    . 'which cannot be null, is missing.' . PHP_EOL;
                $isValid = false;
            }
        }
        
        return array('isValid' => $isValid, 'message' => $message);
        
    }
    
    /**
     * Check if the array is valid for loading entity's information.
     * 
     * @param array $array
     * 
     * @param boolean $verbose
     * 
     * @return array
     */
    public function validateArray($array)
    {
        if (!is_array($array) || empty($array)) {
            return false;
        }
        
        /* @var $message string */
        $message = '';
        
        /* @var $isValid boolean */
        $isValid = true;
        
        /* @var $propertiesNames array */
        $propertiesNames = array();
        
        /*@var $propertyDescription PropertyDescription */
        foreach ($this->propertiesDescriptions as $propertyDescription) {
            
            $propertiesNames[] = $propertyDescription->getName();
            
            if (array_key_exists($propertyDescription->getName(), $array)) {
                
            } else if (!$propertyDescription->getNullable()){
                $message .= 'The property "' . $propertyDescription . '", '
                    . 'which cannot be null, is missing.' . PHP_EOL;
                $isValid = false;
            }
        }
        
        foreach ($array as $key => $value) {
            if (!in_array($key, $propertiesNames) && 
                !in_array($key, $this->allowedAssociatedEntities)
            ) {
                $isValid = false;
                $message .= 'The key "' . $key . '" is invalid.' . PHP_EOL;
            }
        }
        
        return array('isValid' => $isValid, 'message' => $message);
    }
}
