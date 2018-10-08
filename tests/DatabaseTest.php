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

namespace OJSscript\Tests;
use OJSscript\Database\DatabaseConnectionFactory;
use OJSscript\Core\Registry;
use OJSscript\Database\DatabaseConnection;

/**
 * Description of DatabaseTest
 *
 * @author bernardo
 */
class DatabaseTest extends \PHPUnit\Framework\TestCase
{
    public function __construct(
        $name = null,
        array $data = array(),
        $dataName = ''
    ) {
        parent::__construct($name, $data, $dataName);
        
        $runningTest = true;
        if (!Registry::isRegistered('RUNNING_TEST')) {
            Registry::set('RUNNING_TEST', $runningTest);
        }
        
        $databaseInformation = array(
                'host' => 'localhost',
                'user' => 'test',
            'password' => 'test',
                'name' => 'humanas',
        );
        
        if (!Registry::isRegistered('database_information')) {
            Registry::set('database_information', $databaseInformation);
        }
    }
    
    public function testCreate()
    {
        $databaseConnection = DatabaseConnectionFactory::create();
        $this->assertInstanceOf(
            '\OJSscript\Database\DatabaseConnection',
            $databaseConnection
        );
        
    }
    
    /*public function testDatabaseInformation()
    {
        $info = DatabaseConnectionFactory::prepareDatabaseInformation();
        $this->assertArrayHasKey('name', $info);
        $this->assertEquals('humanas', $info['name']);
        
        $this->assertArrayHasKey('user', $info);
        $this->assertEquals('test', $info['user']);
        
        $this->assertArrayHasKey('driver', $info);
        $this->assertEquals('MySQL', $info['driver']);
        
        $this->assertArrayHasKey('host', $info);
        $this->assertEquals('localhost', $info['host']);
        
        $this->assertArrayHasKey('password', $info);
        $this->assertEquals('test', $info['password']);
        
    }
    
    public function testCreateDSN()
    {
        $info = DatabaseConnectionFactory::prepareDatabaseInformation();
        $dbConnection = new DatabaseConnection(
            $info['driver'],
            $info['host'],
            $info['user'],
            $info['password'],
            $info['name']
        );
        $this->assertEquals('MySQL', $dbConnection->getDatabaseDriver());
        $this->assertEquals('localhost', $dbConnection->getHost());
        $this->assertEquals('test', $dbConnection->getUser());
        $this->assertEquals('test', $dbConnection->getPassword());
        $this->assertEquals('humanas', $dbConnection->getName());
        
        $dsn = $dbConnection->createDSN();
        
        $db = $dbConnection->getName();
        $host = $dbConnection->getHost();
        $expectedDSN = "mysql:dbname=$db;host=$host";
        
        $this->assertEquals($expectedDSN, $dsn);
    }*/
}
