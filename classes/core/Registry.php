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
 * @author bernardo
 */
class Registry {
    
    /**
     * The registered data
     * @var array
     */
    protected static $registry = array();
    
    /**
     * Tests if a named value is already registered
     * @param string $key
     * @return boolean
     */
    public function isRegistered($key) {
        return array_key_exists($key, self::$registry);
    }
    
    public function &get($key) {
        $value = null;
        if ($this->isRegistered($key)) {
            $value =& self::$registry[$key];
        }
        return $value;
    }
    
    public function set($key, &$value) {
        self::$registry[$key] =& $value;
    }
    
}
