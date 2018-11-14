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
use OJSscript\Core\Registry;
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
     * An array storing the messages of the Exceptions to be thrown.
     * 
     * @var array
     */
    private $exceptionMessages;
    
    /**
     *  Constructor for the EntityValidator.
     */
    public function __construct()
    {
        $this->exceptionMessages = array();
    }
    
    /**
     * 
     * @param string $message
     */
    private function addExceptionMessage($message)
    {
        if (InputValidator::validate($message, 'string')) {
            $this->exceptionMessages[] = $message;
        }
    }
    
    private function throwIfAny()
    {
        if (!empty($this->exceptionMessages)) {
            $message = '';
            /* @var $exceptionMsg string */
            foreach ($this->exceptionMessages as $exceptionMsg) {
                $message .= $exceptionMsg . PHP_EOL;
            }
            
            throw new \Exception($message);
        }
    }
    
    private function clearExceptionMessages()
    {
        $this->exceptionMessages = array();
    }
    
    /**
     * 
     * @param string $tableName
     * 
     * @return array
     */
    private function getAllowedAssociatedEntities($tableName)
    {
        /* @var $allowedAssocEntities array */
        $allowedAssocEntities = Registry::get('allowedAssociatedEntities');
        
        if (is_array($allowedAssocEntities) && 
            array_key_exists($tableName, $allowedAssocEntities)
        ) {
            return $allowedAssocEntities[$tableName];
        } else {
            return array();
        }
    }
    
    /**
     * 
     * @param string $type
     * 
     * @return integer
     */
    private function getMaxSize($type)
    {
        $openingParensPos = strpos($type, '(');
        $closingParensPos = strpos($type, ')');
        $length = $closingParensPos - $openingParensPos - 1;
        $startPos = $openingParensPos + 1;
        
    }
    
    /**
     * 
     * @param mixed $propertyValue
     * @param PropertyDescription $propertyDescription
     */
    private function validatePropertyValue($propertyValue, $propertyDescription)
    {
        /* @var $type string */
        $type = strtolower($propertyDescription->getType());
        if (in_array($type, array('date', 'datetime'))) {
            if (!InputValidator::validate($propertyValue, $type)) {
                $this->addExceptionMessage('Incorrect "' . $type . '" value '
                    . 'for the property "' 
                    . $propertyDescription->getName() . '".'
                );
            }
        } elseif ($type === 'double') {
            if (!is_numeric($propertyValue)) {
                $this->addExceptionMessage('Incorrect type "' 
                    . gettype($propertyValue) . '" for the property "'
                    . $propertyDescription->getName() . '".');
            }
        }
    }
    
    /**
     * 
     * @param string $tableName
     * @param string $propertyName
     * @param string|integer $propertyValue
     */
    public function validateProperty($tableName, $propertyName, $propertyValue)
    {
        /* @var $propertiesDescriptions array */
        $propertiesDescriptions = EntityDescriptionRegistry::get(
            $tableName)->getPropertiesDescriptions();
        
        if (!in_array($propertyName, array_keys($propertiesDescriptions))) {
            $this->addExceptionMessage('The property "' . $propertyName 
                . '" is not declared in the OJS schema.');
        } else {
            
            /* @var $propertyDescription PropertyDescription */
            $propertyDescription = $propertiesDescriptions[$propertyName];
            
            
            
        }
        
        $this->throwIfAny();
    }
    
    /**
     * 
     * @param Entity $entity
     */
    private function validateEntityInstance($entity)
    {
        if (!is_a($entity, '\OJSscript\Entity\Abstraction\Entity')) {
            
            $this->addExceptionMessage('Not an instance of Entity.');
            
        } elseif ($this->tableName !== $entity->getTableName()) {
            
            $this->addExceptionMessage('The entity\'s name "' 
                . $entity->getTableName() .'" does not math with the '
                . 'validator\'s "' . $this->tableName . '".'
            );
            
        }
    }
    
    /**
     * 
     * @param Entity $entity
     */
    private function validateEntityProperties($entity)
    {
        /*@var $propertyDescription PropertyDescription */
        foreach ($this->propertiesDescriptions as $propertyDescription) {
            if ($entity->hasProperty($propertyDescription->getName())) {
                $this->validateProperty(
                    $propertyDescription->getName(), 
                    $entity->getProperty($propertyDescription->getName())
                );
            } else if (!$propertyDescription->getNullable()){
                $this->addExceptionMessage('The property "' 
                    . $propertyDescription->getName()
                    . '", which cannot be null, is missing.'
                );
            }
        }
    }
    
    /**
     * 
     * @param Entity $entity
     */
    private function validateAssociatedEntities($entity)
    {
        /* @var $assocEntityName string */
        /* @var $assocEntities array */
        foreach ($entity->getAssociatedEntitites() 
            as $assocEntityName => $assocEntities) {
            
            if (!in_array(
                    $assocEntityName,
                    $this->getAllowedAssociatedEntities($entity->getTableName())
            )) {
                $this->addExceptionMessage(
                    'The entity "' . $assocEntityName . '" is not allowed to '
                    . 'be associated to "' . $entity->getTableName() . '".'
                );
                break;
            } 
            
            /* @var $assocEntity Entity */
            foreach ($assocEntities as $assocEntity) {
                $this->validateEntity($assocEntity);
            }
        }
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
        $this->clearExceptionMessages();
        
        $this->validateEntityInstance($entity);
        
        $this->validateEntityProperties($entity);
        
        if ($entity->hasAssociatedEntities()) {
            $this->validateAssociatedEntities($entity);
        }
        
        $this->throwIfAny();
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
