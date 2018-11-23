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
 * Description of EntityDescription
 *
 * @author bernardo
 */
class EntityDescription
{
    /**
     * The name of the table that the Entity represents.
     * 
     * @var string
     */
    private $tableName;
    
    /**
     * A boolean value indicating whether or not the entity has settings.
     * 
     * @var boolean
     */
    private $hasSettings;
    
    /**
     * A boolean value indicating whether or not the entity has other entities 
     * associated to it.
     * 
     * @var boolean
     */
    private $hasAssociatedEntities;
    
    /**
     * Array of objects from the class PropertyDescription
     * @var array
     */
    private $propertiesDescriptions;
    
    /**
     * Validates the tableName argument in the class constructor.
     * 
     * @param string $tableName
     * @throws \Exception
     */
    private function validateTableName($tableName)
    {
        if (!InputValidator::validate($tableName, 'string')) {
            $message = 'Constructor of the class EntityDescription:' . PHP_EOL
                . 'The first argument "$tableName" must be a string. The given'
                . ' type was "' . gettype($tableName) . '".' . PHP_EOL;
            
            throw new \Exception($message);
        }
    }
    
    /**
     * 
     * @param string $tableName
     * @param boolean $hasSettings
     * @param boolean $hasAssociatedEntities
     */
    private function validateConstructorParameters(
        $tableName,
        $hasSettings,
        $hasAssociatedEntities
    ) {
        $throwException = false;
        $message = 'Constructor of the class EntityDescription:' . PHP_EOL;
        
        if (!InputValidator::validate($tableName, 'string')) {
            $throwException = true;
            $message .= 'The first argument "$tableName" must be a string. The '
                . 'given type was "' . gettype($tableName) . '".' . PHP_EOL;
        }
        
        if (!InputValidator::validate($hasSettings, 'boolean')) {
            $throwException = true;
            $message .= 'The second argument "$hasSettings" must be a boolean. '
                . 'The given type was "' . gettype($hasSettings) . '".' . PHP_EOL;
        }
        
        if (!InputValidator::validate($hasAssociatedEntities, 'boolean')) {
            $throwException = true;
            $message .= 'The second argument "$hasAssociatedEntities" must be '
                . 'a boolean. The given type was "' 
                . gettype($hasAssociatedEntities) . '".' . PHP_EOL;
        }
        
        if ($throwException) {
            throw new Exception;
        }
    }
    
    /**
     * Constructor of the class EntityDescription.
     * 
     * @param string $tableName - The name of the table that the Entity 
     * represents.
     * 
     * @param boolean $hasSettings
     * 
     * @param boolean $hasAssociatedEntities
     * 
     * @return void
     * 
     * @throws \Exception
     */
    public function __construct(
        $tableName,
        $hasSettings = false,
        $hasAssociatedEntities = false
    ) {
        $this->validateTableName($tableName);
        $this->tableName = $tableName;
        
        if (InputValidator::validate($hasSettings, 'boolean')) {
            $this->hasSettings = $hasSettings;
        }
        
        if (InputValidator::validate($hasAssociatedEntities, 'boolean')) {
            $this->hasAssociatedEntities = $hasAssociatedEntities;
        }
        
        $this->propertiesDescriptions = array();
    }
    
    /**
     * Gets the name of the table that the Entity represents.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->tableName;
    }
    
    /**
     * Gets the array with the properties descriptions.
     * 
     * @return array
     */
    public function getPropertiesDecriptions()
    {
        return $this->propertiesDescriptions;
    }
    
    /**
     * Gets the names of the properties of the Entity.
     * 
     * @return array - The array with the names of the properties.
     */
    public function getPropertiesNames()
    {
        return array_keys($this->propertiesDescriptions);
    }
    
    /**
     * Adds the property description to the array of properties descriptions.
     * 
     * @param PropertyDescription $propertyDescription
     * @return boolean
     */
    public function addPropertyDescription($propertyDescription)
    {
        if (!is_a($propertyDescription, 
            '\OJSscript\Entity\Abstraction\PropertyDescription')
        ) {
            throw new \Exception('Not a proper instance of PropertyDescription'
                . ' when tyring to add a property description to the '
                . 'EntityDescription.');
        } else {
            $this->propertiesDescriptions[$propertyDescription->getName()] =
                $propertyDescription;
            return true;
        }
    }
    
    /**
     * Checks if a property belongs to the Entity.
     * 
     * It actually checks if the property name is in the array of properties 
     * descriptions.
     * 
     * @param string $propertyName - The name of the property to check if it 
     * is in the description.
     * 
     * @return boolean - True if the property belongs and false otherwise.
     */
    public function propertyBelongs($propertyName)
    {
        return array_key_exists($propertyName, $this->propertiesDescriptions);
    }
}
