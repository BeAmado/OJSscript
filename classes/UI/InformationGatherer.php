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

namespace OJSscript\UI;
use OJSscript\Core\Registry;

/**
 * Description of InformationGatherer
 *
 * @author bernardo
 */
class InformationGatherer
{
    
    protected $inquirer;
    
    public function __construct()
    {
        $this->inquirer = new Inquirer();
    }
    
    /**
     * Gathers information on the database parameters needed to stablish a 
     * connection.
     * @param array $args
     * @return array
     */
    public function gatherDatabaseInfo(
        $args = array('host', 'user', 'password', 'name')
    ) {
        $returnData = array();
       
        if (Registry::get('RUNNING_TEST')) {
            $returnData = Registry::get('database_information');
        } else {
            foreach ($args as $item) {
                $question = 'Enter the database ' . $item . ' : ';
                $returnData[$item] = $this->inquirer->inquire($question);
            }
        }
        
        return $returnData;
    }
}
