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

namespace OJSscript\Core;

/**
 * Standard Registry
 *
 * @author Bernardo Amado
 */
class Registry 
{
    
    /**
     * The registered data.
     * 
     * @var array
     */
    protected static $registry = array();
    
    /**
     * Tests if a record identifier is already registered
     * 
     * @param string $key
     * @return boolean
     */
    public static function isRegistered($key) 
    {
        return array_key_exists($key, self::$registry);
    }
    
    /**
     * Gets the value recorded
     * 
     * @param string $key - The record identifier
     * @return mixed
     */
    public static function get($key)
    {
        $value = null;
        if (self::isRegistered($key)) {
            $value = self::$registry[$key];
        }
        return $value;
    }
    
    /**
     * Gets the value recorded by reference.
     * 
     * @param string $key - the record identifier
     * @return mixed - A reference to the recorded value.
     */
    public static function &getByReference($key) 
    {
        $value = null;
        if (self::isRegistered($key)) {
            $value =& self::$registry[$key];
        }
        return $value;
    }
    
    /**
     * Sets the value for the identified record which will either be created or 
     * updated.
     * 
     * @param string $key
     * @param mixed $value
     */
    public static function set($key, $value) 
    {
        self::$registry[$key] = $value;
    }
    
    /**
     * Sets a record by reference. 
     * 
     * @param string $key - The record identifier
     * @param mixed $value - The value to be registered
     */
    public static function setByReference($key, &$value) 
    {
        self::$registry[$key] =& $value;
    }
    
    /**
     * Deletes the specified item from the registry.
     * 
     * @param string $key - The record identifier
     */
    public static function delete($key)
    {
        if (self::isRegistered($key)) {
            unset(self::$registry[$key]);
        }
    }
    
    /**
     * Deletes all the records in the registry.
     */
    public static function clear()
    {
        foreach (array_keys(self::$registry) as $key) {
            unset(self::$registry[$key]);
        }
    }
    
}
