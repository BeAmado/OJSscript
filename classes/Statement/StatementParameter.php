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

namespace OJSscript\Statement;
use OJSscript\Cloneable;

/**
 * Encapsulates the Prepared Statement parameters
 *
 * @author bernardo
 */
class StatementParameter implements Cloneable
{
    /**
     * The Prepared Statement parameter's placeholder
     * @var string
     */
    protected $placeholder;
    
    /**
     * The value bound to the Prepared Statement
     * @var mixed
     */
    protected $value;
    
    /**
     * integer|string
     * @var string
     */
    protected $type;
    
    /**
     * The parameter's name
     * @var string
     */
    protected $name;
    
    public function __construct(
            $name, 
            $placeholder, 
            $value = null, 
            $type = null
    ) {
        $this->setName($name);
        
        $this->setPlaceholder($placeholder);
        
        $this->setValue($value);
        
        if ($type !== null) {
            $this->setType($type);
        } elseif ($value !== null) {
            $this->setType(gettype($value));
        } else {
            $this->setType('string');
        }
    }
    
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function cloneInstance()
    {
        return new StatementParameter(
                $this->getName(), 
                $this->getPlaceholder(), 
                $this->getValue(),
                $this->getType()
        );
    }
    
    public function __clone()
    {
        return $this->cloneInstance();
    }
    
    /**
     * Returns an array representation
     * @return array
     */
    public function asArray()
    {
        return array(
            'name' => $this->getName(),
            'placeholder' => $this->getPlaceholder(),
            'value' => $this->getValue(),
            'type' => $this->getType(),
        );
    }

}
