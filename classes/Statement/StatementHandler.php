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

namespace OJSscript\Statement;
use OJSscript\Entity\Entity;

/**
 * Description of StatementHandler
 *
 * @author Bernardo Amado
 */
class StatementHandler 
{
    
    /**
     * Tests if the data matches the parameters info
     * @param array $parameters
     * @param OJSscript\Entity $entity
     * @return boolean
     */
    private static function dataMatches($parameters, Entity $entity) {
        /* @var $parameter StatementParameter */
        foreach ($parameters as $parameter) {
            if (!$entity->hasProperty($parameter->getName())) {
                return false;
            }
        }
        
        return true;
    }


    //FIXME: this method should probably throw Exception to give information
    // on what happened
    /**
     * 
     * @param string $statementName
     * @param Entity $entity
     * @return boolean
     */
    public static function bindParams($statementName, $entity) {
        if (!is_a($entity, 'Entity')) {
            return false;
        }
        
        /* @var $statement Statement */
        $statement =& StatementRegistry::get($statementName);
        
        /* @var $parametersInfo array */
        $parameters = $statement->getParametersList();
        
        if (!self::dataMatches($parameters, $entity)) {
            return false;
        }
        
        /* @var $parameter StatementParameter */
        foreach ($parameters as $parameter) {
           
            $bound = $statement->bindParameter(
                    $parameter->getPlaceholder(), 
                    $entity->getProperty($parameter->getName())
            );
                    
            if (!$bound) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Executes the prepared statement
     * @param string $statementName
     * @return boolean
     */
    public static function execute($statementName) {
        /* @var $statement Statement */
        $statement =& StatementRegistry::get($statementName);
        
        if ($statement->isPrepared()) {
            return $statement->execute();
        }
        
        return false;
    }
}
