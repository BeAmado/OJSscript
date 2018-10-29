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
use OJSscript\Core\Registry;

/**
 * Description of EntityValidatorRegistry
 *
 * @author bernardo
 */
class EntityValidatorRegistry extends Registry
{
    /**
     * 
     * @param string $key
     * @param EntityValidator $value
     * @return boolean
     */
    public static function set($key, $value)
    {
        $validator = $value;
        $register = false;
        if (is_a($validator, '\OJSscript\Entity\Abstraction\EntityValidator')) {
            $register = true;
            parent::set($key, $value);
        } 
        
        return $register;
        
    }
    
    public static function get($key)
    {
        if (!self::isRegistered($key)) {
            $tableName = '';
            if (substr($tableName, 0, -1) === 's') {
                $tableName = $tableName;
            } elseif (substr($tableName, -1) === 'y') {
                $tableName = substr($tableName, 0, -1) . 'ies';
            } else {
                $tableName = $tableName . 's';
            }
            
            $validator = EntityValidatorFactory::create(
                array('tableName' => $tableName));
            
            self::set($tableName, $validator);
        }
        
        return parent::get($key);
    }


}
