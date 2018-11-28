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
class RegistryNotStatic 
{
    
    /**
     * The registered data.
     * 
     * @var array
     */
    protected $registry;
    
    public function __construct()
    {
        $this->registry = array();
    }
    
    /**
     * Tests if a record identifier is already registered
     * 
     * @param string $key
     * @return boolean
     */
    public function isRegistered($key) 
    {
        return array_key_exists($key, $this->registry);
    }
    
    /**
     * Gets the value recorded
     * 
     * @param string $key - The record identifier
     * @return mixed
     */
    public function get($key)
    {
        $value = null;
        if ($this->isRegistered($key)) {
            $value = $this->registry[$key];
        }
        return $value;
    }
    
    /**
     * Gets the value recorded by reference.
     * 
     * @param string $key - the record identifier
     * @return mixed - A reference to the recorded value.
     */
    public function &getByReference($key) 
    {
        $value = null;
        if ($this->isRegistered($key)) {
            $value =& $this->registry[$key];
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
    public function set($key, $value) 
    {
        $this->registry[$key] = $value;
    }
    
    /**
     * Sets a record by reference. 
     * 
     * @param string $key - The record identifier
     * @param mixed $value - The value to be registered
     */
    public function setByReference($key, &$value) 
    {
        $this->registry[$key] =& $value;
    }
    
    /**
     * Deletes the specified item from the registry.
     * 
     * @param string $key - The record identifier
     */
    public function delete($key)
    {
        if ($this->isRegistered($key)) {
            unset($this->registry[$key]);
        }
    }
    
    /**
     * Deletes all the records in the registry.
     */
    public function clear()
    {
        foreach (array_keys($this->registry) as $key) {
            unset($this->registry[$key]);
        }
    }
    
}
