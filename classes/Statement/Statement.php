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
 * @author bernardo
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
     * The query the prepared statement will execute
     * example:
     *     query = 'INSERT INTO table (parameter1_name, parameter2_name)
     *              VALUES (:parameter1Name, :parameter2Name)'
     * @var string
     */
    protected $query;
    
    /**
     * the parameters that are or will be bound to the prepared statement
     * example:
     *    parameters =  array(
     *        array(
     *            "name" => "parameter_name", 
     *            "placeholder" => ":parameterName",
     *        ),
     *        ... ,
     *    )
     * @var array
     */
    protected $parameters;
    
    public function getConnection(): PDOConnection
    {
        return $this->connection;
    }

    public function getStmt(): PDOStatement
    {
        return $this->stmt;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function setConnection(PDOConnection $connection)
    {
        $this->connection = $connection;
    }

    public function setStmt(PDOStatement $stmt)
    {
        $this->stmt = $stmt;
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }


}
