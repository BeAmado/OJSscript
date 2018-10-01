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

/**
 * The main role of this class is to store the Prepared Statement data
 *
 * @author Bernardo Amado
 */
class Statement 
{
    
    /**
     * an alias for the connection used
     * @var PDOConnection
     */
    protected $connection;
    
    /**
     * The prepared statement to be executed
     * @var PDOStatement
     */
    protected $stmt;
    
    /**
     * Indicates whether the statement is prepared.
     * @var boolean
     */
    protected $isPrepared;


    /**
     * The query the prepared statement will execute
     * example:
     *     query = 'INSERT INTO table (parameter1_name, parameter2_name)
     *              VALUES (:parameter1Name, :parameter2Name)'
     * @var string
     */
    protected $query;
    
    /**
     * Array of OJSscript\Statement\StatementParameter 
     * @var array
     */
    protected $parameters;
    
    /**
     * Initializes the parameters as an empty array indicates that 
     * the Statement is not prepared.
     */
    public function __construct()
    {
        $this->parameters = array();
        $this->isPrepared = false;
    }

    /**
     * Gets the Statement's query string.
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Creates an array cloning the parameters of the Prepared Statement
     * @return array
     */
    public function getParametersList()
    {
        /* @var $parameters array */
        $parameters = array();
        
        /* @var $parameter StatementParameter */
        foreach ($this->parameters as $parameter) {
            $parameters[$parameter->getName()] = clone $parameter;
        }
        
        return $parameters;
    }
    
    /**
     * Counts the number of parameters the Statement has.
     * @return int
     */
    public function countParameters()
    {
        return count($this->parameters);
    }

    /**
     * Sets the Statement connection
     * @param \PDOConnection $connection
     * @return boolean
     */
    public function setConnection($connection)
    {
        if (is_a($connection, 'PDOConnection')) {
            $this->connection = $connection;
            return true;
        }
        
        return false;
    }

    /**
     * Sets the Statement's query.
     * @param string $query
     * @return boolean
     */
    public function setQuery($query)
    {
        if (is_string($query)) {
            $this->query = $query;
            return true;
        }
        
        return false;
    }
    
    /**
     * Adds the parameter to the parameters array. Returns a boolean indicating
     * whether or not the operation was successfull.
     * @param StatementParameter parameter
     * @return boolean
     */
    public function addParameter($parameter) 
    {
        /**
         * to support version prior to PHP 7.0 test if the parameter is a 
         * StatementParameter inside the method. Would be better to type hint
         * but in PHP 5 would generate a Fatal Error. 
         */
        if (!is_a($parameter, 'StatementParameter')) {
            /*
             * FIXME: Would be better to throw an exception
             */
            return false;
        }
        
        /* @var $parameter StatementParameter */
        
        $this->parameters[$parameter->getName()] = $parameter;
        return true;
    }
    
    /**
     * Tests if the property \PDOStatement $stmt is prepared.
     * @return boolean
     */
    public function isPrepared()
    {
        return $this->isPrepared;
    }

    /**
     * Prepares the property \PDOStatement $stmt
     * @return void
     */
    public function prepareItself() 
    {
        $this->stmt = $this->connection->prepare($this->query);
        if ($this->stmt) {
            $this->isPrepared = true;
        }
    }
    
    /**
     * Tests if the statement has the specified parameter
     * @param string $name
     * @return boolean
     */
    protected function hasParameter($name) 
    {
        return array_key_exists($name, $this->parameters);
    }
    
    /**
     * Sets the parameter value
     * @param string $name
     * @param mixed $value
     * @return boolean
     */
    protected function setParameter($name, $value) 
    {
        if ($this->hasParameter($name)) {
            
            /* @var $parameter StatementParameter */
            $parameter =& $this->parameters[$name];
            
            $parameter->setValue($value);
            
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
     * Binds the value to the Prepared Statement parameter specified by the 
     * argument "$name".
     * @param string $name
     * @param mixed $value
     * @return boolean
     */
    public function bindParameter($name, $value)
    {
        if (!$this->hasParameter($name)) {
            return false;
        }
        
        /* @var $parameter StatementParameter */
        $parameter =& $this->parameters[$name];
        
        /* @var $stmt \PDOStatement */
        $stmt =& $this->stmt;
        
        $bound = $stmt->bindParam($parameter->getPlaceholder(), $value);
        
        if ($bound) {
            $parameter->setValue($value);
            return true;
        }
        
        return false;
    }
    
    /**
     * Executes the prepared statement
     * @return boolean
     */
    public function execute()
    {
        /* @var $stmt \PDOStatement */
        $stmt =& $this->stmt;
        return $stmt->execute();
    }
}
