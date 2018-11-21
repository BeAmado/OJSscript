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
//use OJSscript\Core\Registry;
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
     *  Constructor for the EntityValidator.
     *  @param string $tableName
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->exceptionMessages = array();
    }
    
    /**
     * 
     * @param string $tableName
     */
    private function setPropertiesDescriptions($tableName)
    {
        $this->propertiesDescriptions = EntityDescriptionRegistry::get(
            $tableName)->getPropertiesDescriptions();
    }
    
    /**
     * 
     * @param string $tableName
     * @return array
     */
    private function getPropertiesDescriptions($tableName)
    {
        if (!isset($this->propertiesDescriptions)) {
            $this->setPropertiesDescriptions($tableName);
        }
        
        return $this->propertiesDescriptions;
    }
    
    private function unsetPropertiesDescriptions()
    {
        $this->propertiesDescriptions = null;
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
        /*$allowedAssocEntities = Registry::get('allowedAssociatedEntities');
        
        if (is_array($allowedAssocEntities) && 
            array_key_exists($tableName, $allowedAssocEntities)
        ) {
            return $allowedAssocEntities[$tableName];
        } else {
            return array();
        }*/
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
        
        if ($msg != null) {
            $this->addExceptionMessage($msg);
        } 
    }
    
    /**
     * 
     * @param string $tableName
     * @param string $propertyName
     * @param string|integer $propertyValue
     */
    private function validateEntityProperty(
        $tableName,
        $propertyName,
        $propertyValue
    ) {
        /* @var $propertiesDescriptions array */
        $propertiesDescriptions = $this->getPropertiesDescriptions($tableName);
        
        if (!in_array($propertyName, array_keys($propertiesDescriptions))) {
            $this->addExceptionMessage('The property "' . $propertyName 
                . '" is not declared in the OJS schema.');
        } else {
            
            /* @var $propertyDescription PropertyDescription */
            $propertyDescription = $propertiesDescriptions[$propertyName];
            
            $this->validatePropertyValue($propertyValue, $propertyDescription);
            
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
                . $entity->getTableName() .'" does not match with the '
                . 'validator\'s "' . $this->tableName . '".'
            );
            
        }
        
        $this->throwIfAny();
    }
    
    /**
     * 
     * @param Entity $entity
     */
    private function validateEntityProperties($entity)
    {
        /*@var $propertyDescription PropertyDescription */
        foreach ($this->getPropertiesDescriptions($entity->getTableName()) 
                 as $propertyDescription) {
            if ($entity->hasProperty($propertyDescription->getName())) {
                $this->validateEntityProperty(
                    $entity->getTableName(),
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
            
            $this->throwIfAny();
            
            /* @var $assocEntity Entity */
            foreach ($assocEntities as $assocEntity) {
                $this->unsetPropertiesDescriptions();
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
        $this->unsetPropertiesDescriptions();
        
        $this->validateEntityInstance($entity);
        
        $this->validateEntityProperties($entity);
        
        if ($entity->hasAssociatedEntities()) {
            $this->validateAssociatedEntities($entity);
        }
        
        $this->throwIfAny();
    }
    
    /**
     * 
     * @param string $tableName
     * @param string $propertyName
     * @param mixed $propertyValue
     */
    public function validateProperty(
        $tableName,
        $propertyName,
        $propertyValue
    ) {
        $this->unsetPropertiesDescriptions();
        $this->validateEntityProperty(
            $tableName,
            $propertyName,
            $propertyValue
        );
    }
}
