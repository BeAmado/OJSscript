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
use OJSscript\Core\Factory;

/**
 * Description of EntityValidatorFactory
 *
 * @author bernardo
 */
class EntityValidatorFactory extends Factory
{
    /**
     * 
     * @param array $args
     * 
     * @return mixed Returns an instance of the specified EntityValidator, or
     * false if it cannot create one.
     */
    public static function create($args = array())
    {
        /* @var $tableName string */
        $tableName = '';
        
        if (array_key_exists('tableName', $args)) {
            $tableName = $args['tableName'];
        } elseif (array_key_exists('entityType', $args)) {
            /*@var $entityType string */
            $entityType = $args['entityType'];
            if (substr($entityType, 0, -1) === 's') {
                $tableName = $entityType;
            } elseif (substr($entityType, -1) === 'y') {
                $tableName = substr($entityType, 0, -1) . 'ies';
            } else {
                $tableName = $entityType . 's';
            }
        } else {
            return false;
        }
        
        return new EntityValidator($tableName);
    }

}
