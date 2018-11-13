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
use OJSscript\Core\Registry;
use OJSscript\UI\Inquirer;
use OJSscript\UI\Menu;
use OJSscript\Core\SchemaHandler;
use OJSscript\Entity\Journal\JournalHandler;
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
    
    /**
     *
     * @var Menu
     */
    private $menu;
    
    /**
     * The names of the tables that will be used.
     * 
     * @var array
     */
    private $tablesToUse;
    
    public function __construct()
    {
        $this->inquirer = new Inquirer();
        $this->menu = new Menu($this->inquirer);
        $this->ojsVersion = '2.4.8-2';
        $this->tablesToUse = array();
    }
    
    protected function showDescriptions()
    {
        echo 'The entities descriptions: ' . PHP_EOL;
        
        $descriptions = array();
        
        $descriptions[] = EntityDescriptionRegistry::get('articles');
        $descriptions[] = EntityDescriptionRegistry::get('article_settings');
        $descriptions[] = EntityDescriptionRegistry::get('users');
        $descriptions[] = EntityDescriptionRegistry::get('sections');
        $descriptions[] = EntityDescriptionRegistry::get('review_assignments');
        
        /* @var $entityDescription \OJSscript\Entity\Abstraction\EntityDescription */
        foreach ($descriptions as $entityDescription) {
            /* @var $properties array */
            $properties = $entityDescription->getPropertiesDecriptions();
            echo PHP_EOL . $entityDescription->getName() . ':' . PHP_EOL;

            /* @var $propertyDescription \OJSscript\Entity\Abstraction\PropertyDescription */
            foreach ($properties as $propertyDescription) {
                echo '    ' . $propertyDescription->getName() . ': ';
                echo $propertyDescription->getType() . '  ';
                echo ($propertyDescription->getNullable()) ? '': 'NOT NULL';
                echo PHP_EOL;
            }
        }
        
    }
    
    protected function fetchData()
    {
        
    }
    
    protected function begin()
    {
        echo 'Application begin' . PHP_EOL;
        
        $this->tablesToUse[] = 'articles';
        $this->tablesToUse[] = 'journals';
        
        //use the SchemaHandler to form the EntityDescription objects.
        $schemaHandler = new SchemaHandler($this->tablesToUse);
        $schemaHandler->registerEntitiesDescriptions();
        
        /* @var $journalHandler JournalHandler */
        $journalHandler = new JournalHandler();
        Registry::set('journalHandler', $journalHandler);
        
        
        
    }
    
    protected function end()
    {
        echo 'Application end' . PHP_EOL;
        
        
    }

    public function run($args = array())
    {
        $this->begin();
        
        /* @var $journalId integer */
        $journalId = $this->menu->chooseJournal();
        
        echo PHP_EOL . 'The journal_id chosen was "' . $journalId . '".';
        
        $this->end();
        
        return 0;
    }
}
