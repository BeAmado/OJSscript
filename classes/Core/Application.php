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
use OJSscript\UI\Inquirer;
use OJSscript\Core\SchemaHandler;
use OJSscript\Entity\Abstraction\EntityDescriptionRegistry;

/**
 * Description of Application
 *
 * @author bernardo
 */
class Application
{
    /**
     * The version of the OJS upon which the program is running.
     * 
     * @var string 
     */
    private $ojsVersion;
    
    /**
     * The application inquirer, which will ask the user for input and will
     * return its response.
     * 
     * @var Inquirer
     */
    private $inquirer;
    
    public function __construct()
    {
        $this->inquirer = new Inquirer();
        $this->ojsVersion = '2.4.8-2';
    }
    
    protected function begin()
    {
        echo 'Application begin' . PHP_EOL;
        
        //use the SchemaHandler to form the EntityDescription objects.
        $schemaHandler = new SchemaHandler();
        $schemaHandler->registerEntitiesDescriptions();
    }
    
    protected function end()
    {
        echo 'Application end' . PHP_EOL;
        
        
    }

    public function run($args = array())
    {
        $this->begin();
        
        echo 'The entities descriptions: ' . PHP_EOL;
        /* @var $articleDescription EntityDescription */
        $articlesDescription = EntityDescriptionRegistry::get('articles');
        echo 'articles:' . PHP_EOL;
        print_r($articlesDescription);
        
        $this->end();
        
        return 0;
    }
}
