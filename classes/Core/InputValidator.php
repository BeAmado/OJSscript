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

    /**
     * Validates the input data according to the specified type.
     * @param mixed $data
     * @param string $type
     * @return boolean
     */
    public static function validate($data, $type)
    {
        if (!in_array($type, self::$validTypes)) {
            return false;
        }
        
        /* @var $method string */
        $method = 'validate' . ucfirst($type);
        
        return self::$method($data);
    }
}
