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
     * Array of objects from the class PropertyDescription
     * @var array
     */
    private $propertiesDescriptions;
    
    /**
     * Constructor of the class EntityDescription.
     * 
     * @param string $tableName - The name of the table that the Entity 
     * represents.
     * 
     * @return void
     * 
     * @throws \Exception
     */
    public function __construct($tableName)
    {
        if (!InputValidator::validate($tableName, 'string')) {
            $message = 'Constructor of the class EntityDescription:' . PHP_EOL
                . 'The first argument "$tableName" must be a string. The given'
                . ' type was "' . gettype($tableName) . '".' . PHP_EOL;
            
            throw new \Exception($message);
        }
        $this->tableName = $tableName;
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
            return false;
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
