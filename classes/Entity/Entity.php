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

namespace OJSscript\Entity;

/**
 * Generic class to encapsulate an object properties. This class is to be 
 * extended by all of the classes that represent OJS data.
 *
 * @author bernardo
 */
class Entity 
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
    public function hasProperty($propertyName)
    {
        return array_key_exists($propertyName, $this->properties);
    }
    
    /**
     * Get the specified entity's property. If the property does not exist
     * returns false.
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
     * @param string $propertyName
     * @param mixed $propertyValue
     * @return void
     */
    public function setProperty($propertyName, $propertyValue)
    {
        $this->properties[$propertyName] = $propertyValue;
    }
}
