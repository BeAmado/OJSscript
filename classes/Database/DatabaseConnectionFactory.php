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
use OJSscript\Core\Factory;
use OJSscript\UI\InformationGatherer;

/**
 * Description of DatabaseConnectionFactory
 *
 * @author bernardo
 */
class DatabaseConnectionFactory extends Factory
{
    /**
     * Gathers and prepares the database information encapsulating it in an 
     * associative array.
     * @return array
     */
    protected static function prepareDatabaseInformation($args = array())
    {
        $infoGatherer = new InformationGatherer();
        
        /* @var $dbInfo array */
        $dbInfo = null;
        
        if (!empty($args)) {
            $dbInfo = $infoGatherer->gatherDatabaseInfo($args);
        } else {
            $dbInfo = $infoGatherer->gatherDatabaseInfo();
        }
        
        //MySQL will be the default database driver
        if (!array_key_exists('driver', $dbInfo)) {
            $dbInfo['driver'] = 'MySQL';
        }
        
        //utf8 will be the default charset
        if (!array_key_exists('charset', $dbInfo)) {
            $dbInfo['charset'] = 'utf8';
        }
        
        return $dbInfo;
    }
    
    /**
     * Creates a new DatabaseConnection with the default driver as MySQL.
     * @return \OJSscript\Database\DatabaseConnection
     */
    public static function create($args = array())
    {
        /* @var $dbInfo array */
        $dbInfo = self::prepareDatabaseInformation($args);
        
        /* @var $connection \OJSscript\Database\DatabaseConnection */
        $connection = new DatabaseConnection(
            $dbInfo['driver'],
            $dbInfo['host'],
            $dbInfo['user'],
            $dbInfo['password'],
            $dbInfo['name'],
            $dbInfo['charset']
        );
        
        $connection->connect();
        
        return $connection;
    }

}
