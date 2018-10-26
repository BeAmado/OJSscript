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
use OJSscript\Interfaces\ExtraProperties;
use OJSscript\Interfaces\ExtraPropertiesIndicator;

/**
 * Description of EntitySettingWithExtraProperties
 *
 * @author bernardo
 */
class EntitySettingWithExtraProperties extends EntitySetting
    implements ExtraProperties,
               ExtraPropertiesIndicator
{
    /**
     * The extra properties
     * @var array
     */
    private $extra;

    /**
     * Gets the specified extra property. 
     * If the property is not set returns false.
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
     * @param string $propertyName
     * @return boolean
     */
    public function hasExtraProperty($propertyName)
    {
        if (array_key_exists($propertyName, $this->extra)) {
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
     * Always returns true.
     * @return boolean
     */
    public function hasExtraProperties()
    {
        return true;
    }
    
    /**
     * Return an array representation of the EntitySetting
     * @return array
     */
    public function asArray()
    {
        /* @var $arrayRepresentation array */
        $arrayRepresentation = parent::asArray();
        
        //insert the extra properties
        foreach ($this->extra as $key => $value) {
            $arrayRepresentation[$key] = $value;
        }
        
        return $arrayRepresentation;
    }

}
