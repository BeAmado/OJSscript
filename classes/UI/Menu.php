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
use OJSscript\UI\Inquirer;

/**
 * Description of Menu
 *
 * @author bernardo
 */
class Menu
{
    /**
     *
     * @var Inquirer
     */
    private $inquirer;
    
    /**
     * 
     * @param Inquirer $inquirer
     */
    public function __construct($inquirer)
    {
        $this->inquirer = $inquirer;
    }
    
    /**
     * 
     * @param string $message
     * @return string
     */
    private function askForInput($message = 'Enter the desired option: ')
    {
        return $this->inquirer->inquire($message);
    }
    
    /**
     * 
     * @param string $input
     * @param array $assocArray
     * @return boolean
     */
    private function confirmInput($input, $assocArray = null)
    {
        /* @var $data string */
        $data = '';
        
        if ($assocArray !== null && is_array($assocArray)) {
            if (!array_key_exists($input, $assocArray)) {
                echo 'Invalid option "' . $input . '".' . PHP_EOL;
                return false;
            }
            $data = $assocArray[$input];
        } else {
            $data = $input;
        }
        
        $message = 'You chose "' . $data . '".'
            . 'Do you confirm your option? (Y/n) : ';
        
        $confirm = strtolower($this->inquirer->inquire($message));
        
        if ($confirm === 'n' || $confirm === 'no') {
            return false;
        }
        
        return true;
    }
    
    /**
     * 
     * @param array $options
     * @param string $optionsTitle
     * @param integer $indentationSize
     */
    private function showOptions(
        $options,
        $optionsTitle = null,
        $indentationSize = 0
    ) {
        
        if ($optionsTitle !== null) {
            echo PHP_EOL . '------ ' . $optionsTitle . ' ------' . PHP_EOL;
            $indentationSize += 4;
        }
        
        /* @var $indentation string */
        $indentation = '';
        
        for ($i = 0; $i < $indentationSize; $i++) {
            $indentation .= ' ';
        }
        
        foreach ($options as $key => $value) {
            echo $indentation . $key . ' - ' . $value . PHP_EOL;
	}
        
        echo PHP_EOL;
    }
    
    public function chooseAction()
    {
        $actions = array(
            1 => 'export',
            2 => 'import',
            3 => 'migrate',
            4 => 'copy files',
            //5 => 'correct charset',
	);
	
        $this->showOptions($actions);
        
        /* @var $index string */
	$index = $this->askForInput();
        
        while (!$this->confirmInput($index, $actions)) {
            $index = $this->askForInput();
        }
	
	return $actions[$index];
    }
    
    public function chooseJournal()
    {
        /* @var $journals array */
        $journals = Registry::get('JournalHandler')->fetchAll();
        
        /* @var $options array */
        $options = array();
        
        /* @var $journal \OJSscript\Entity\Abstraction\Entity */
        foreach ($journals as $journal) {
            $options[$journal->getProperty('journal_id')] = 
                $journal->getProperty('path');
        }
        
        $this->showOptions($options, 'Journals');
        
        /* @var $index string */
	$index = $this->askForInput('Select one journal: ');
        
        while (!$this->confirmInput($index, $options)) {
            $this->showOptions($options, 'Journals');
            $index = $this->askForInput('Select one journal: ');
        }
	
	return (int) $index;
    }
}
