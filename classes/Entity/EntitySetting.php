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

namespace OJSscript\Entity;
use OJSscript\Interfaces\ArrayRepresentation;
use OJSscript\Interfaces\Cloneable;
use OJSscript\Core\InputValidator;

/**
 * Description of EntitySetting
 *
 * @author bernardo
 */
class EntitySetting implements Cloneable, ArrayRepresentation
{
    /**
     * The Entity id
     * @var integer
     */
    protected $id;
    
    /**
     * The setting locale
     * @var string
     */
    protected $locale;
    
    /**
     * The setting name
     * @var string
     */
    protected $name;
    
    /**
     * The setting value
     * @var string
     */
    protected $value;
    
    /**
     * The setting type
     * @var string
     */
    protected $type;
    
    /**
     * Extra fields in the setting structure. For example the user_setting
     * table has the fields assoc_id and assoc_type in OJS 2.4.8
     * @var array
     */
    protected $extra;
    
    public function __construct(
        $id = null,
        $locale = null,
        $name = null,
        $value = null,
        $type = null
    ) {
        $this->extra = array();
        $this->setId($id);
        $this->setLocale($locale);
        $this->setName($name);
        $this->setType($type);
        $this->setValue($value);
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

    public function getExtraProperty($propertyName)
    {
        if ($this->hasExtraProperty($propertyName)) {
            return $this->extra[$propertyName];
        }
        return false;
    }
    
    
    public function hasExtraProperty($propertyName)
    {
        if (array_key_exists($propertyName, $this->extra)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function hasExtraProperties()
    {
        if (empty($this->extra)) {
            return false;
        } else {
            return true;
        }
    }
    
    public function listExtraProperties()
    {
        return array_keys($this->extra);
    }

    /**
     * Sets the id 
     * @param integer $id
     * @return boolean
     */
    public function setId($id)
    {
        if (InputValidator::validate($id, 'integer')) {
            $this->id = $id;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Set the locale of the setting
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
     * Sets the name of the setting
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
     * Sets the value of the setting
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
     * Sets the type of the setting
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
     * Sets some extra property to the setting
     * @param string $propertyName
     * @param string $propertyValue
     * @return boolean
     */
    public function setExtraProperty($propertyName, $propertyValue)
    {
        if (InputValidator::validate($propertyName, 'string')) {
            $this->extra[$propertyName] = $propertyValue;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns an array representation of the EntitySetting
     * @return array
     */
    public function asArray()
    {
        /* @var $arrReturn array */
        $arrReturn = array(
                'id' => $this->getId(),
            'locale' => $this->getLocale(),
              'name' => $this->getName(),
             'value' => $this->getValue(),
              'type' => $this->getType(),
        );
        
        foreach ($this->extra as $key => $value) {
            $arrReturn[$key] = $value;
        }
        
        return $arrReturn;
    }

    /**
     * Returns a new instance of the EntitySetting with same properties.
     * @return \OJSscript\Entity\EntitySetting
     */
    public function cloneInstance()
    {
        /* @var $instance EntitySetting */
        $instance = new EntitySetting(
            $this->getId(),
            $this->getLocale(),
            $this->getName(),
            $this->getValue(),
            $this->getType()
        );
        
        foreach ($this->extra as $propertyName => $propertyValue) {
            $instance->setExtraProperty($propertyName, $propertyValue);
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

}
