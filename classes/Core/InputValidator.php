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

namespace OJSscript\Core;

/**
 * Description of InputValidator
 *
 * @author bernardo
 */
class InputValidator
{
    /**
     * The allowed types to be validated
     * @var array
     */
    protected static $validTypes = array(
        'boolean',
        'integer',
        'double',
        'string',
        'array',
        'object',
        'resource',
        'arrayOfString',
        'date',
        'datetime',
    );
    
    protected static function validateBoolean($data)
    {
        return is_bool($data);
    }
    
    protected static function validateInteger($data)
    {
        return is_int($data);
    }
    
    protected static function validateDouble($data)
    {
        return is_double($data);
    }
    
    protected static function validateString($data)
    {
        return is_string($data);
    }
    
    protected static function validateArray($data)
    {
        return is_array($data);
    }
    
    protected static function validateObject($data)
    {
        return is_object($data);
    }
    
    protected static function validateResource($data)
    {
        return is_resource($data);
    }
    
    protected static function validateArrayOfString($data)
    {
        if (!self::validateArray($data)) {
            return false;
        }
        
        foreach ($data as $value) {
            if (!self::validateString($value)) {
                return false;
            }
        }
        
        return true;
    }
    
    protected static function validateDate($data)
    {
        
        if (!self::validateString($data)) {
            return false;
        }
        
        return \DateTime::createFromFormat('Y-m-d', $data) !== false;
    }
    
    protected static function validateDatetime($data)
    {
        if (!self::validateString($data)) {
            return false;
        }
        
        return \DateTime::createFromFormat('Y-m-d H:i:s', $data) !== false;
    }

    /**
     * Validates the input data according to the specified type. 
     * 
     * If more than one type is to be accepted their values must be 
     * separated by "|". 
     * For example: "integer|string" or "boolean|integer|double".
     * 
     * @param mixed $data - The data to be validated.
     * @param string $type - The type the data must be.
     *  
     * @return boolean
     * 
     * @throws \Exception
     */
    public static function validate($data, $type)
    {
        
        /* @var $chosenTypes array */
        $chosenTypes = explode('|', $type);
        
        /* @var $chosenType string */
        foreach ($chosenTypes as $chosenType) {
            if (!in_array($chosenType, self::$validTypes)) {
                throw new \Exception('The type "' . $chosenType . '" is not '
                    . 'one of the valid types.');
            }

            /* @var $method string */
            $method = 'validate' . ucfirst($chosenType);
            
            if (self::$method($data)) {
                return true;
            }
        }
        
        return false;
    }
}
