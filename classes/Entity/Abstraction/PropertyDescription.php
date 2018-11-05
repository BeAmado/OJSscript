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
 * Description of PropertyDescription
 *
 * @author bernardo
 */
class PropertyDescription
{
    /**
     * The name of the property, which is the name of the related 
     * field in the database.
     * 
     * @var string
     */
    private $name;
    
    /**
     * The type of the property.
     * 
     * @var string
     */
    private $type;
    
    /**
     * Indicates whether the property might be null.
     * @var boolean
     */
    private $nullable;
    
    
    /**
     * The required constructor. All the values of the object must be set at
     * the creation and cannot be modified through any setter method.
     * @param string $name
     * @param string $type
     * @param boolean $nullable
     * @throws \Exception
     */
    public function __construct(
        $name,
        $type,
        $nullable
    ) {
        
        $this->validate('name', $name); 
        $this->name = $name;
        
        $this->validate('type', $type);
        $this->type = $type;
        
        $this->validate('nullable', $nullable);
        $this->nullable = $nullable;
        
    }
    
    /**
     * Validates the property type.
     * 
     * @param type $propertyName
     * @param type $propertyValue
     * @throws \Exception
     */
    protected function validate($propertyName, $propertyValue)
    {
        $propertyType = null;
        $valid = false;
        
        if (in_array($propertyName, array('name', 'type'))) {
            
            $propertyType = 'string';
            $valid = InputValidator::validate($propertyValue, 'string');
            
        } else if ($propertyName == 'nullable') {
            
            $propertyType = 'boolean';
            $valid = InputValidator::validate($propertyValue, 'boolean');
            
        } 
        
        $exceptionMessage = 'The PropertyDescription property "' 
                . $propertyName . '" value "' . print_r($propertyValue, true)
                . '" is not of type "' . $propertyType . '".' . PHP_EOL;
        
        if (!$valid) {
            throw new \Exception($exceptionMessage);
        }
        
    }
    
    /**
     * Gets the name of the property, which is the name of the related 
     * field in the database.
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * 
     * @return boolean
     */
    public function getNullable()
    {
        return $this->nullable;
    }

}
