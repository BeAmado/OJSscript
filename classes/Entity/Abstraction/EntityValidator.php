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
     * The names of the entities that may be associated with the entity on 
     * which this validator acts.
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
     * Returns an array with the tables' names of the entities that might be 
     * associated to the one to be validated.
     * 
     * @return array
     */
    private function getAssociatedEntitiesNames()
    {
        /* @var $assocEntitiesFile string */
        $assocEntitiesFile = dirname(__FILE__) . '/associatedEntities.json';
        
        /* @var $fileContent string */
        $fileContent = file_get_contents($assocEntitiesFile);
        
        /* @var $assocEntities array */
        $assocEntities = json_decode($fileContent, true);
        
        if (array_key_exists($this->tableName, $assocEntities)) {
            return $assocEntities[$this->tableName];
        } else {
            return array();
        }
    }
    
    /**
     *  Constructor for the EntityValidator.
     * 
     *  @param string $tableName
     */
    public function __construct($tableName) 
    {
        $this->tableName = $tableName;
        $this->exceptionMessages = array();
        $this->propertiesDescriptions = EntityDescriptionRegistry::get(
            $this->tableName)->getPropertiesDescriptions();
        $this->allowedAssociatedEntities = $this->getAssociatedEntitiesNames();
    }
    
    
    /**
     * Adds a message to the exceptionMessage array.
     * 
     * @param string $message
     */
    private function addExceptionMessage($message)
    {
        if ($message != null && InputValidator::validate($message, 'string')) {
            $this->exceptionMessages[] = $message;
        }
    }
    
    /**
     * Throws an exception if there is a message logged in the array 
     * exceptionMessages.
     * 
     * @throws \Exception
     */
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
    
    /**
     *  Resets the array exceptionMessages.
     */
    private function clearExceptionMessages()
    {
        $this->exceptionMessages = array();
    }
    
    /**
     * Gets the maximum size specified for a database type.
     * 
     * For example: 
     * int(13) would return 13,
     * varchar(243) would return 243.
     * 
     * @param string $type
     * 
     * @return integer
     */
    private function getMaxSize($type)
    {
        $openingParensPos = strpos($type, '(');
        $closingParensPos = strpos($type, ')');
        /* @var $length integer */
        $length = $closingParensPos - $openingParensPos - 1;
        
        /* @var $startPos integer */
        $startPos = $openingParensPos + 1;
        
        if ($closingParensPos && $openingParensPos && ($length > 0)) {
            return (int) substr($type, $startPos, $length);
        } else {
            return false;
        }
        
    }
    
    /**
     * Validates the value for a property whose description is given.
     * 
     * @param mixed $propertyValue
     * @param PropertyDescription $propertyDescription
     */
    private function validatePropertyValue($propertyValue, $propertyDescription)
    {
        /* @var $msg string */
        $msg = null;
        
        /* @var $type string */
        $type = strtolower($propertyDescription->getType());
        
        if (in_array($type, array('date', 'datetime'))) {
            $msg = (InputValidator::validate($propertyValue, $type)) ? null :
                'Incorrect "' . $type . '" value for the property "' 
              . $propertyDescription->getName() . '".';
            
        } elseif ($type === 'double' && !is_numeric($propertyValue)) {
            $msg = 'Incorrect type "' . gettype($propertyValue) . '" for '
                . 'the property "'. $propertyDescription->getName() . '".';
            
        } else {
            /* @var $maxSize integer */
            $maxSize = $this->getMaxSize($type);
            
            /* @var $strValue string */
            $strValue = "$propertyValue";
            
            $msg = (strlen($strValue) > $maxSize) ? null : 'The property "' 
                . $propertyDescription->getName() . '" must be at most ' 
                . $maxSize . ' characters long.';
            
        }
        
        $this->addExceptionMessage($msg);
    }
    
    /**
     * Validates if the specified property for the entity.
     * 
     * @param string $propertyName
     * @param string|integer $propertyValue
     */
    private function validateEntityProperty(
        $propertyName,
        $propertyValue
    ) {
        if (array_key_exists($propertyName, $this->propertiesDescriptions)) {
             /* @var $propertyDescription PropertyDescription */
            $propertyDescription = $this->propertiesDescriptions[$propertyName];
            
            $this->validatePropertyValue($propertyValue, $propertyDescription);
            
        } else {
           $this->addExceptionMessage('The property "' . $propertyName 
                . '" is not declared in the OJS schema.');
        }
    }
    
    /**
     * Validates if the parameter **$entity** is an instance of
     * \OJSscript\Entity\Abstraction\Entity.
     * 
     * @param \OJSscript\Entity\Abstraction\Entity $entity
     */
    private function validateEntityInstance($entity)
    {
        if (!is_a($entity, '\OJSscript\Entity\Abstraction\Entity')) {
            
            $this->addExceptionMessage('Not an instance of Entity.');
            
        } elseif ($this->tableName !== $entity->getTableName()) {
            
            $this->addExceptionMessage('The entity\'s name "' 
                . $entity->getTableName() .'" does not match with the '
                . 'validator\'s "' . $this->tableName . '".'
            );
            
        }
        
        $this->throwIfAny();
    }
    
    /**
     * Validates all the properties of the Entity object given.
     * 
     * @param \OJSscript\Entity\Abstraction\Entity $entity
     */
    private function validateEntityProperties($entity)
    {
        /*@var $propertyDescription PropertyDescription */
        foreach ($this->propertiesDescriptions as $propertyDescription) {
            if ($entity->hasProperty($propertyDescription->getName())) {
                $this->validateEntityProperty(
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
        
        $this->throwIfAny();
    }
    
    /**
     * Validates the associated entities of the given Entity object.
     * 
     * @param \OJSscript\Entity\Abstraction\Entity $entity
     */
    private function validateAssociatedEntities($entity)
    {
        /* @var $assocEntityName string */
        /* @var $assocEntities array */
        foreach ($entity->getAssociatedEntitites() 
            as $assocEntityName => $assocEntities) {
            
            if (!in_array($assocEntityName, $this->allowedAssociatedEntities)) {
                $this->addExceptionMessage(
                    'The entity "' . $assocEntityName . '" is not allowed to '
                    . 'be associated to "' . $entity->getTableName() . '".'
                );
                break;
            } 
            
            /* @var $validator EntityValidator */
            $validator = EntityValidatorRegistry::get($assocEntityName);
            
            /* @var $assocEntity \OJSscript\Entity\Abstraction\Entity */
            foreach ($assocEntities as $assocEntity) {
                $validator->validateEntity($assocEntity);
            }
        }
    }
    
    /**
     * Validates the entity data, being the properties, settings and associated 
     * entities.
     * 
     * @param \OJSscript\Entity\Abstraction\Entity $entity
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
        $this->clearExceptionMessages();
    }
    
    /**
     * Validates one specified property for the entity.
     * 
     * @param string $propertyName
     * @param mixed $propertyValue
     */
    public function validateProperty($propertyName, $propertyValue)
    {
        $this->clearExceptionMessages();
        
        $this->validateEntityProperty($propertyName, $propertyValue);
        
        $this->throwIfAny();
        $this->clearExceptionMessages();
    }
    
    /**
     * Validates the EntitySetting.
     * 
     * @param \OJSscript\Entity\Abstraction\EntitySetting $setting
     * 
     * @throws \Exception
     */
    public function validateSetting($setting)
    {
        /* @var $msg string */
        $msg = null;
        
        if (!is_a($setting, '\OJSscript\Entity\Abstraction\EntitySetting')) {
            $msg = 'The object passed to the method "addSetting" is not an '
                . 'instance of \OJSscript\Entity\Abstraction\EntitySetting.';
        }
        
        if ($msg != null) {
            throw new \Exception($msg);
        }
    }
    
}
