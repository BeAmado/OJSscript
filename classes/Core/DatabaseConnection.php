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

namespace OJSscript\Core;

/**
 * Description of DatabaseConnection
 *
 * @author bernardo
 */
class DatabaseConnection
{
    /**
     * The database driver, which must be one of the following:
     * MySql (default)
     * PostgreSql (not tested)
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

    public function setDatabaseDriver($databaseDriver)
    {
        $this->databaseDriver = $databaseDriver;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setName($name)
    {
        $this->name = $name;
    }


}
