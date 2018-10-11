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
     * @var string
     */
    protected $name;
    
    /**
     * The type of the property
     * @var string
     */
    protected $type;
    
    /**
     * Indicates whether the property might be null.
     * @var boolean
     */
    protected $nullable;
    
    /**
     * Indicates if the property is a primary key (PRI) or is a foreign key or 
     * an index (MUL). An empty string indicates that the property is none of
     * the aforementioned.
     * @var string
     */
    protected $key;
    
    /**
     * The default value of the property
     * @var mixed
     */
    protected $default;
    
    /**
     * The extra comments
     * @var string
     */
    protected $extra;
    
    /**
     * The required constructor. All the values of the object must be set at
     * the creation and cannot be modified through any setter method.
     * @param string $name
     * @param string $type
     * @param boolean $nullable
     * @param string $key
     * @param mixed $default
     * @param string $extra
     * @throws \Exception
     */
    public function __construct(
        $name,
        $type,
        $nullable,
        $key = '',
        $default = null,
        $extra = ''
    ) {
        
        $exceptionMessage = $this->validate('name', $name) 
            . $this->validate('type', $type)
            . $this->validate('nullable', $nullable)
            . $this->validate('key', $key)
            . $this->validate('default', $default)
            . $this->validate('extra', $extra);
        
        if ($exceptionMessage === '') {
            $this->name = $name;
            $this->type = $type;
            $this->nullable = $nullable;
            $this->key = $key;
            $this->default = $default;
            $this->extra = $extra;
        } else {
            throw new \Exception($exceptionMessage);
        }
        
    }
    
    /**
     * Validates the instance properties.
     * @param string $propertyName
     * @param mixed $propertyValue
     * @return string
     */
    protected function validate($propertyName, $propertyValue)
    {
        $exceptionMessage = '';
        $propertyType = null;
        $valid = false;
        switch ($propertyName) {
            case 'name':
            case 'type':
            case 'key':
            case 'extra':
                $propertyType = 'string';
                $valid = InputValidator::validate($propertyValue, 'string');
                break;
            
            case 'nullable':
                $propertyType = 'boolean';
                $valid = InputValidator::validate($propertyValue, 'boolean');
                break;
            
            case 'default':
                $propertyType = 'null|string|integer|double';
                $valid = ($propertyValue === null) || 
                    InputValidator::validate($propertyValue, 'string') ||
                    InputValidator::validate($propertyValue, 'integer') ||
                    InputValidator::validate($propertyValue, 'double');
                break;
        }
        
        if (!$valid) {
            $exceptionMessage = 'The PropertyDescription property "' 
                . $propertyName . '" value "' . print_r($propertyValue, true)
                . '" is not of type "' . $propertyType . '".' . PHP_EOL;
        }
        
        return $exceptionMessage;
    }
    
    /**
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

    /**
     * 
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * 
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * 
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }


}
