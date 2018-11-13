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
use OJSscript\Entity\Abstraction\PropertyDescription;
use OJSscript\Entity\Abstraction\EntityDescriptionRegistry;

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
     * @param array $allowedAssocEntities - The names of the entities that 
     * might be associated with this one.
     */
    public function __construct($tableName, $allowedAssocEntities = array())
    {
        $this->tableName = $tableName;
        $this->propertiesDescriptions = 
            EntityDescriptionRegistry::get($tableName);
        $this->allowedAssociatedEntities = $allowedAssocEntities;
    }
    
    /**
     * 
     * @param string $propertyName
     * @param string|integer $propertyValue
     */
    public function validateProperty($propertyName, $propertyValue)
    {
        $message = '';
        $valid = true;
        
        if (!in_array($propertyName, array_keys($this->propertiesDescriptions))) {
            $valid = false;
            $message = 'The property "' . $propertyName . '" is not declared '
                . 'in the OJS schema.';
        }
        
        return array('valid' => $valid, 'message' => $message);
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
        /*if (!is_a($entity, '\OJSscript\Entity\Abstraction\Entity') ||
            $this->tableName !== $entity->getTableName()) {
            $message = 'The entity\'s name "' . $entity->getTableName() 
                . '" does not math with the validator\'s "' . $this->tableName 
                . '".';
            return array(
                'isValid' => false,
                'message' => $message,
            );
        }*/
        
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
        $valid = true;
        
        /* @var $propertyDescription PropertyDescription */
        foreach ($this->propertiesDescriptions as $propertyDescription) {
            if (!$propertyDescription->getNullable() &&
                !in_array($propertyDescription->getName(), $array)
            ) {
                $message .= 'The property "' . $propertyDescription->getName()
                    . '" which must NOT be null is missing.';
                
                $valid = false;
            }
        }
        
        /* @var $key string */
        /* @var $value mixed */
        foreach ($array as $key => $value) {
            /* @var $validation array */
            $validation = $this->validateProperty($key, $value);
            if (!$validation['valid']) {
                $valid = false;
                $message .= $validation['message'] . PHP_EOL;
            }
        }
        
        return array('valid' => $valid, 'message' => $message);
    }
}
