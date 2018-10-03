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
use OJSscript\Core\Registry;

/**
 * Description of StatementFactory
 *
 * @author Bernardo Amado
 */
class StatementFactory 
{
    /**
     * Validates the prepared statement information structure.
     * @param array $statementInfo
     * @return boolean
     */
    private static function isValidStatementInfo($statementInfo) {
        if (!is_array($statementInfo)) {
            return false;
        }
        
        if (!array_key_exists('query', $statementInfo)) {
            return false;
        } elseif (!is_string($statementInfo['query'])) {
            return false;
        }       
        
        if (!array_key_exists('params', $statementInfo)) {
            return false;
        } elseif ($statementInfo['params'] !== null &&
                !is_array($statementInfo['params'])) {
            return false;
        }
        
        return true;
    }


    /**
     * Tries to set the statement parameters, throwing an exception if the
     * Statement could not add any of the parameters.
     * @param \OJSscript\Statement\Statement $statement
     * @param array $statementInfo
     * @throws \Exception
     * @return void
     */
    private static function addStatementParameters(&$statement, $statementInfo) 
    {
        if (!self::isValidStatementInfo($statementInfo)) {
            throw new \Exception('Invalid structure for the prepared statement '
                    . 'information.');
        }
        
        foreach ($statementInfo['params'] as $name => $placeholder) {
            /* @var $parameter StatementParameter */
            $parameter = new StatementParameter($name, $placeholder);
            if (!$statement->addParameter($parameter)) {
                $message = 'Could not add the parameter "' 
                        . $parameter->getName() . '".';
                throw new \Exception($message);
            }
        }
    }
    
    /**
     * Tries to get the statement information
     * @param string $statementName
     * @return array
     * @throws \Exception
     */
    private static function getStatementInfo($statementName)
    {
        $errorMessage = '';
        
        $filename = StatementLocator::getLocation($statementName);
        if ($filename === '') {
            $errorMessage .= 'Could not locate the file where the statement'
                    . ' information are.';
            throw new \Exception($errorMessage);
        }
        
        if (!is_file($filename)) {
            $errorMessage = 'The filename "' . $filename . '" is not a file.';
            throw new \Exception($errorMessage);
        }
        
        $statementInfo = include $filename;
        if ($statementInfo['name'] !== $statementName) {
            $errorMessage .= 'The name in the statement information "'
                    . $statementInfo['name'] . '" does not match with the '
                    . 'one provided "' . $statementName . '".';
            throw new \Exception($errorMessage);
        }
        
        return $statementInfo;
    }


    /**
     * Tries to create an instance of \OJSscript\Statement\Statement
     * and configurate it. If any of the steps in the configuration process
     * fails, it returns false. Otherwise it returns the instance created.
     * @param string $statementName
     * @return boolean|\OJSscript\Statement\Statement
     */
    public static function create($statementName) 
    {
        try {
            $statement = new Statement();
//            $statementInfo = self::getStatementInfo($statementName);
//            self::addStatementParameters($statement, $statementInfo);
//            
//            $statement->setQuery($statementInfo['query']);
//            $statement->setConnection(Registry::get('connection'));
//            
//            $statement->prepareItself();
        
            return $statement;
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
}
