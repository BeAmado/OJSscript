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
use OJSscript\Interfaces\ArrayRepresentation;
use OJSscript\Interfaces\Cloneable;
use OJSscript\Interfaces\LoadFromArray;
use OJSscript\Core\InputValidator;

/**
 * Description of EntitySetting
 *
 * @author bernardo
 */
class EntitySetting implements Cloneable, ArrayRepresentation, LoadFromArray
{
    /**
     * The Entity id
     * @var string|integer
     */
    private $id = '';
    
    /**
     * The type of the Entity. For example: article, user, section.
     * @var string
     */
    private $entityType;
    
    /**
     * The setting locale
     * @var string
     */
    private $locale = '';
    
    /**
     * The setting name
     * @var string
     */
    private $name = '';
    
    /**
     * The setting value
     * @var string
     */
    private $value = '';
    
    /**
     * The setting type
     * @var string
     */
    private $type = '';
    
    /**
     * The extra properties
     * @var array
     */
    private $extra;

    
    
    /**
     * Constructor of EntitySetting.
     * 
     * @param string $entityType - The name of the table, in its singular form, 
     * that the setting is about. Ex: article, user, section
     * @param boolean $hasExtraProperties
     * @throws \Exception
     */
    public function __construct($entityType, $hasExtraProperties = false) 
    {
        if (InputValidator::validate($entityType, 'string')) {
            $this->entityType = $entityType;
        } else {
            //TREAT BETTER
            $message = 'Invalid entity type "' . $entityType . '"';
            throw new \Exception($message);
        }
        
        if (InputValidator::validate($hasExtraProperties, 'boolean')) {
            $this->extra = ($hasExtraProperties) ? array() : null;
        } else {
            //TREAT BETTER
            $message = 'The 2nd argument for the EntitySetting constructor must '
                . 'be a boolean. The given type was "' 
                . gettype($hasExtraProperties) . '"';
            throw new \Exception($message);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getType()
    {
        return $this->type;
    }
    
    public function getEntityType()
    {
        return $this->entityType;
    }

    /**
     * Sets the id 
     * @param integer|string $id
     * @return boolean
     */
    public function setId($id)
    {
        if (InputValidator::validate($id, 'integer|string')) {
            $this->id = $id;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Set the locale of the setting.
     * 
     * @param string $locale
     * @return boolean
     */
    public function setLocale($locale)
    {
        if (InputValidator::validate($locale, 'string')) {
            $this->locale = $locale;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the name of the setting.
     * 
     * @param string $name
     * @return boolean
     */
    public function setName($name)
    {
        if (InputValidator::validate($name, 'string')) {
            $this->name = $name;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the value of the setting.
     * 
     * @param string $value
     * @return boolean
     */
    public function setValue($value)
    {
        if (InputValidator::validate($value, 'string')) {
            $this->value = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the type of the setting.
     * 
     * @param string $type
     * @return boolean
     */
    public function setType($type)
    {
        if (InputValidator::validate($type, 'string')) {
            $this->type = $type;
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Gets the specified extra property. 
     * If the property is not set returns false.
     * 
     * @param string $propertyName
     * @return mixed
     */
    public function getExtraProperty($propertyName)
    {
        if ($this->hasExtraProperty($propertyName)) {
            return $this->extra[$propertyName];
        } else {
            return false;
        }
    }

    /**
     * Checks if the extra property is set.
     * 
     * @param string $propertyName
     * @return boolean
     */
    public function hasExtraProperty($propertyName)
    {
        if (!$this->hasExtraProperties()) {
            return false;
        }
        
        if (array_key_exists($propertyName, $this->extra)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets some extra property to the setting.
     * 
     * @param string $propertyName
     * @param string $propertyValue
     * @return boolean
     */
    public function setExtraProperty($propertyName, $propertyValue)
    {
        if (!$this->hasExtraProperties()) {
            return false;
        }
        
        if (InputValidator::validate($propertyName, 'string') &&
            InputValidator::validate($propertyValue, 'string|integer|double')
        ) {
            $this->extra[$propertyName] = $propertyValue;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if the Entity has or must have extra properties.
     * 
     * @return boolean
     */
    public function hasExtraProperties()
    {
        return is_array($this->extra);
    }
    
    /**
     * Gets the specified setting property. Returns false if the property 
     * does not exist.
     * 
     * @param string $name
     * 
     * @return mixed
     */
    public function getProperty($name)
    {
        
        if ($this->hasExtraProperty($name)) {
            return $this->extra[$name];
        }
        
        /* @var $split_words array */
        $split_words = explode('_', $name);
        
        /* @var $propertyName string */
        $propertyName = $split_words[count($split_words) - 1]; //the last word
        
        if (isset($this->$propertyName)) {
            /* @var $method string */
            $method = 'get' . ucfirst($propertyName);
            
            return $this->$method();
        }
        
        return false;
    }
    
    /**
     * Sets the specified setting property. Returns true if successful and 
     * false otherwise.
     * 
     * @param string $name
     * @param mixed $value
     * 
     * @return boolean
     */
    public function setProperty($name, $value)
    {
        /* @var $split_words array */
        $split_words = explode('_', $name);
        
        /* @var $propertyName string */
        $propertyName = $split_words[count($split_words) - 1]; //the last word
        
        if ($name === 'extraProperties' && 
            $this->hasExtraProperties() &&
            InputValidator::validate($value,'array')
        ) {
            $this->extra = $value;
            return true;
        }
        
        if (isset($this->$propertyName)) {
            $method = 'set' . ucfirst($propertyName);
            return $this->$method($value);
        }
        
        return $this->setExtraProperty($name, $value);
    }
    
    /**
     * Returns an array representation of the EntitySetting
     * @return array
     */
    public function asArray()
    {
        /* @var $arrayRepresentation array */
        $arrayRepresentation = array(
            $this->entityType.'_id' => $this->getId(),
                           'locale' => $this->getLocale(),
                     'setting_name' => $this->getName(),
                    'setting_value' => $this->getValue(),
                     'setting_type' => $this->getType(),
        );
        
        if ($this->hasExtraProperties()) {
            $arrayRepresentation['extraProperties'] = $this->extra;
        }
        
        return $arrayRepresentation;
    }

    /**
     * Returns a new instance of the EntitySetting with same properties.
     * @return \OJSscript\Entity\EntitySetting
     */
    public function cloneInstance()
    {
        /* @var $instance EntitySetting */
        $instance = new EntitySetting(
            $this->getEntityType(),
            $this->hasExtraProperties()
        );
        
        $instance->setId($this->getName());
        $instance->setLocale($this->getLocale());
        $instance->setName($this->getName());
        $instance->setValue($this->getValue());
        $instance->setType($this->getType());
        
        if ($this->hasExtraProperties()) {
            foreach ($this->extra as $propertyName => $propertyValue) {
                $instance->setExtraProperty($propertyName, $propertyValue);
            }
        }
        
        return $instance;
    }
    
    /**
     * Returns a clone of the EntitySetting
     * @return \OJSscript\Entity\EntitySetting
     */
    public function __clone()
    {
        return $this->cloneInstance();
    }
    
    /**
     * 
     * @param array $array
     */
    public function loadArray($array)
    {
        /* @var $key string */
        /* @var $value mixed */
        foreach ($array as $key => $value) {
            $this->setProperty($key, $value);
        }
    }

}
