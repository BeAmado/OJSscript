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
use OJSscript\UI\Menu;
use OJSscript\Entity\Journal\JournalHandler;
use OJSscript\Entity\Article\ArticleHandler;
use OJSscript\Entity\Abstraction\EntityDescriptionRegistry;
use OJSscript\Entity\Abstraction\EntityValidatorRegistry;

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
    
    private function setRegistries()
    {
        Registry::set('EntityValidatorRegistry', new EntityValidatorRegistry());
        Registry::set(
            'EntityDescriptionRegistry',
            new EntityDescriptionRegistry()
        );
    }
    
    protected function setTablesToUse()
    {
        $this->tablesToUse[] = 'articles';
        $this->tablesToUse[] = 'journals';
        $this->tablesToUse[] = 'roles';
        $this->tablesToUse[] = 'users';
    }
    
    protected function registerEntityHandlers()
    {
        Registry::set('JournalHandler', new JournalHandler());
        Registry::set('ArticleHandler', new ArticleHandler());
    }
    
    protected function begin()
    {
        echo PHP_EOL . 'Application begin' . PHP_EOL;
        
        $this->setRegistries();
        
        $this->setTablesToUse();
        
        //use the SchemaHandler to form the EntityDescription objects.
        $schemaHandler = new SchemaHandler($this->tablesToUse);
        $schemaHandler->registerEntitiesDescriptions();
        
        $this->registerEntityHandlers();
        
    }
    
    protected function end()
    {
        echo PHP_EOL . 'Application end' . PHP_EOL;
    }

    public function run($args = array())
    {
        $this->begin();
        
        /* @var $journalId integer */
        $journalId = $this->menu->chooseJournal();
        
        /* @var $articles array */
        $articles = Registry::get('ArticleHandler')->fetchUnpublishedArticles(
            $journalId
        );
        
        echo PHP_EOL . 'The amount of unpublished articles is ' 
            . count($articles) . PHP_EOL;
        
        $this->end();
        
        return 0;
    }
}
