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
use OJSscript\Statement\StatementFactory;
use OJSscript\Statement\StatementLocator;
use OJSscript\Core\Registry;
use OJSscript\Statement\Statement;
use OJSscript\Database\DatabaseConnectionFactory;
require_once '../includes/bootstrap.php';

/**
 * Description of StatementFactoryTest
 *
 * @author bernardo
 */
class StatementFactoryTest extends \PHPUnit\Framework\TestCase
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
        //SelectUsernameCount Statement
        $statement = StatementFactory::create(
            array('name' => 'SelectUsernameCount')
        );
        $this->assertInstanceOf('\OJSscript\Statement\Statement', $statement);

        $this->assertTrue($statement->isPrepared());
    }
    
    public function testGetStatementInfo() {
        //SelectUsernameCount Statement
        $location = StatementLocator::getLocation('SelectUsernameCount');
        $this->assertTrue(is_file($location));
    }
}
