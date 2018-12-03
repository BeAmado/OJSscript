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
use OJSscript\Entity\Abstraction\Entity;
use OJSscript\Entity\Abstraction\EntitySetting;
use OJSscript\Core\Registry;

/**
 * Description of StatementHandler
 *
 * @author Bernardo Amado
 */
class StatementHandler 
{
    
    /**
     * Tests if the data matches the parameters.
     * 
     * @param array $parameters
     * @param Entity $entity
     * @return boolean
     */
    private static function dataMatches($parameters, $entity) 
    {
        /* @var $parameter StatementParameter */
        foreach ($parameters as $parameter) {
            if (!$entity->hasProperty($parameter->getName())) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Binds a single parameter to a statement.
     * 
     * @param string $statementName
     * @param string $parameterName
     * @param mixed $parameterValue
     * @return boolean
     */
    public static function bindSingleParam(
        $statementName,
        $parameterName,
        $parameterValue
    ) {
        /* @var $statement Statement */
        $statement = Registry::get('StatementRegistry')->get($statementName);
        
        return $statement->bindParameter($parameterName, $parameterValue);
    }
    
    /**
     * Validates the parameters StatementParameter with the Entity or Entity setting.
     * 
     * @param Entity|EntitySetting $object
     * @param array $parameters - array of StatementParameter
     * @return boolean
     */
    private static function validateObjectAndParameters($object, $parameters)
    {
        if (!is_a($object, '\OJSscript\Entity\Abstraction\Entity') &&
            !is_a($object, '\OJSscript\Entity\Abstraction\EntitySetting')
        ) {
            return false;
        }
        
        if (is_a($object, '\OJSscript\Entity\Abstraction\Entity') &&
            !self::dataMatches($parameters, $object)
        ) {
            return false;
        }
        
        return true;
    }
    

        //FIXME: this method should probably throw Exception to give information
    // on what happened
    /**
     * Binds the object values to the specified statement.
     * 
     * @param string $statementName
     * @param Entity|EntitySetting $object
     * @return boolean
     */
    public static function bindParams($statementName, $object)
    {
        /* @var $statement Statement */
        $statement = Registry::get('StatementRegistry')->get($statementName);
        
        /* @var $parameters array */
        $parameters = $statement->getParametersList();
        
        if (!self::validateObjectAndParameters($object, $parameters)) {
            return false;
        }
        
        /* @var $parameter StatementParameter */
        foreach ($parameters as $parameter) {
           /* @var $bound boolean */
            $bound = $statement->bindParameter(
                $parameter->getName(), 
                $object->getProperty($parameter->getName())
            );
                    
            if (!$bound) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Executes the prepared statement.
     * 
     * @param string $statementName
     * @throws \Exception
     */
    public static function execute($statementName)
    {
        /* @var $statement Statement */
        $statement = Registry::get('StatementRegistry')->get($statementName);
        
        if ($statement->isPrepared()) {
            $statement->execute();
        } else {
            throw new \Exception('The statement "' . $statementName . '" is '
                . 'not prepared.');
        }
    }
    
    /**
     * Fetches all the records of the response of the database query.
     * 
     * @param string $statementName - The name of the statement.
     * 
     * @return array
     */
    public static function fetchRecords($statementName)
    {
        /* @var $statement Statement */
        $statement = Registry::get('StatementRegistry')->get($statementName);
        
        return $statement->fetchAll();
    }
    
    /**
     * Gets the next result set from the database query as an associative array.
     * 
     * @param string $statementName
     * @return array
     */
    public static function fetchNext($statementName)
    {
        /* @var $statement Statement */
        $statement = Registry::get('StatementRegistry')->get($statementName);
        
        return $statement->fetch();
    }
}
