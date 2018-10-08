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

namespace OJSscript\Database;
use OJSscript\Core\InputValidator;

/**
 * Description of DatabaseConnection
 *
 * @author bernardo
 */
class DatabaseConnection
{
    /**
     * The database driver, which must be one of the following:
     * MySQL (default)
     * PostgreSQL , not tested
     * 
     * @var string
     */
    protected $databaseDriver;
    
    /**
     * The database host
     * @var string
     */
    protected $host;
    
    /**
     * The database user
     * @var string
     */
    protected $user;
    
    /**
     * The password for the defined user
     * @var string
     */
    protected $password;
    
    /**
     * The name of the database
     * @var string
     */
    protected $name;
    
    /**
     * The database character set
     * @var string
     */
    protected $charset;
    
    /**
     * The actual PDO connection
     * @var \PDO
     */
    protected $connection;
    
    public function __construct(
        $dbDriver = null,
        $dbHost = null,
        $dbUser = null,
        $dbPassword = null,
        $dbName = null,
        $dbCharset = null
    ) {
        $this->setDatabaseDriver($dbDriver);
        $this->setHost($dbHost);
        $this->setUser($dbUser);
        $this->setPassword($dbPassword);
        $this->setName($dbName);
        $this->setCharset($dbCharset);
    }
    
    public function getDatabaseDriver()
    {
        return $this->databaseDriver;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getCharset()
    {
        return $this->charset;
    }
    
    /**
     * Gets the actual database connection.
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }


    /**
     * Sets the database driver. Returns true on success and false otherwise.
     * @param string $databaseDriver
     * @return boolean
     */
    public function setDatabaseDriver($databaseDriver)
    {
        switch($databaseDriver) {
            case 'MySQL':
            case 'PostgreSQL':
                $this->databaseDriver = $databaseDriver;
                return true;
                
            default :
                return false;
        }
    }

    /**
     * Sets the database host. Returns true on success and false otherwise.
     * @param string $host
     * @return boolean
     */
    public function setHost($host)
    {
        if (InputValidator::validate($host, 'string')) {
            $this->host = $host;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the database user. Returns true on success and false otherwise.
     * @param string $user
     * @return boolean
     */
    public function setUser($user)
    {
        if (InputValidator::validate($user, 'string')) {
            $this->user = $user;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the database password. Returns true on success and false otherwise.
     * @param string $password
     * @return boolean
     */
    public function setPassword($password)
    {
        if (InputValidator::validate($password, 'string')) {
            $this->password = $password;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the database name returning true on success and false otherwise.
     * @param string $name
     * @return boolean
     */
    public function setName($name)
    {
        if (InputValidator::validate($name, 'string')) {
            $this->name = $name;
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Sets the database character set, returning true on success and 
     * false otherwise.
     * @param string $charset
     * @return boolean
     */
    public function setCharset($charset)
    {
        if (InputValidator::validate($charset, 'string')) {
            $this->charset = $charset;
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Sets the actual PDO connection
     * @param \PDO $connection
     * @return boolean
     */
    protected function setConnection($connection)
    {
        if (is_a($connection, '\PDO')) {
            $this->connection = $connection;
            return true;
        }
        return false;
    }

    /**
     * Creates the Data Source Name in order to create a PDO object.
     * @return string
     */
    protected function createDSN()
    {
        $dsn = null;

        switch ($this->getDatabaseDriver()) {
            case 'MySQL':
                $dsn = 'mysql:'
                     . 'dbname=' . $this->getName() . ';'
                     . 'host=' . $this->getHost();
                break;

            case 'PostgreSQL':
                $dsn = 'pgsql:'
                     . 'dbname=' . $this->getName() . ';'
                     . 'host=' . $this->getHost();
                break;
        }
        
        return $dsn;
    }
    
    /**
     * Tests if the \PDOConnection is set.
     * @return boolean
     */
    public function isConnected()
    {
        return is_a($this->getConnection(), '\PDOConnection');
    }
    
    /**
     * Creates the \PDOConnection if it was not already connected.
     * @return boolean
     */
    public function connect()
    {
        if ($this->isConnected()) {
            return true;
        }
        
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES '
                                            . $this->getCharset(),
        );
        
        $conn = new \PDO(
            $this->createDSN(), 
            $this->getUser(),
            $this->getPassword(),
            $options
        );
        
        return $this->setConnection($conn);
    }
    
    /**
     * Wrapper method to create a prepared statement using the PDO::prepare
     * @param string $query
     * @return \PDOStatement
     */
    public function prepare($query)
    {
        /* @var $conn \PDO */
        $conn = $this->getConnection();
        
        return $conn->prepare($query);
    }
    
    /**
     * Begins a transaction one was not already in course.
     * @return void
     */
    public function beginTransaction()
    {
        /* @var $conn \PDO */
        $conn = $this->getConnection();
        if (!$conn->inTransaction()) {
            $conn->beginTransaction();
        }
    }
    
    /**
     * Rolls backs if a transaction is in course.
     * @return void
     */
    public function rollback()
    {
        /* @var $conn \PDO */
        $conn = $this->getConnection();
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
    }
    
    /**
     * Commits the changes if a transaction is in course.
     * @return void
     */
    public function commit()
    {
        /* @var $conn \PDO */
        $conn = $this->getConnection();
        if ($this->inTransaction()) {
            $conn->commit();
        }
    }
}
