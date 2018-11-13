<?php

/*
 * Copyright (C) 2018 Bernardo Amado
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

namespace OJSscript\Statement;
use OJSscript\BASE_DIR;
use OJSscript\LINKS_DIR;

/**
 * Locate the file with the prepared statement information
 *
 * @author Bernardo Amado
 */
class StatementLocator
{
    /**
     * Form the base name of the file where the statement information might be 
     * found. For example:
     * formStatementFilename('SelectArticleFiles') will return the string
     * 'select_article_files'.
     * 
     * @param string $statementName
     * @return string
     */
    private static function formStatementFilename($statementName)
    {
        $matches = array();
        preg_match_all('/[A-Z][^A-Z]*/', $statementName, $matches);
        $Words = $matches[0];
        
        //the array with the words in lowercase
        $words = array_map('strtolower', $Words);
        
        return implode('_', $words);
    }
    
    /**
     * Gets the full path name of the file where the location of the file 
     * containing the statement information might be found. For example:
     * getLink('SelectEditDecisions') must return 
     * 'path/to/links/select_edit_decisions_LINK.php'
     * If the link is not found, en empty string is returned.
     * 
     * @param string $statementName
     * @return string
     */
    private static function getLink($statementName)
    {
       
        $filename = self::formStatementFilename($statementName) . "_LINK.php";
        $link = '';
        
        if (is_file(LINKS_DIR . '/' . $filename)) {
            $link = LINKS_DIR . '/' . $filename;
        }
        
        return $link;
    }
    
    /**
     * Forms the absolute path of the file, based on the given statement name.
     * @param string $statementName
     * @return string
     */
    private static function formFullPath($statementName)
    {
        $filename = self::formStatementFilename($statementName);
        
        /* @var $words array */
        $words = explode('_', $filename);
        
        /* @var $operationDir string */
        $operationDir = '';
        
        switch ($words[0]) {
            case 'select':
            case 'insert':
            case 'update':
                $operationDir = $words[0];
                break;
            
            default :
                //do nothing
                break;
        }
        
        /* @var $entityDir string */
        $entityDir = $words[1];
        
        //put the entityDir in singular
        if (substr($entityDir, -1) === 's') {
            $entityDir = substr($entityDir, 0, -1);
        }
        
        $fullpath = BASE_DIR . '/queries/' . $operationDir . '/' . $entityDir
            . '/' . $filename . '.php';
        
        return $fullpath;
    }
    
    /**
     * Gets the statement location using the statement link file.
     * @param string $statementName
     * @return string
     */
    private static function getLocationByLink($statementName)
    {
        /* @var $path string */
        $path = '';
        
        /* @var $link string */
        $link = self::getLink($statementName);
        
//        echo PHP_EOL . 'The statement name is "' . $statementName . '".';
//        echo PHP_EOL . 'The link is "' . $link . '".' . PHP_EOL;
        
        /* @var $arrLocation array */
        $arrLocation = include $link;

        if (
            array_key_exists('location', $arrLocation) && 
            is_file($arrLocation['location'])
        ) {
            $path = $arrLocation['location'];
        }
        
        return $path;
    }
    
    /**
     * Tries to get the location (full absolute path) of the file where the
     * prepared statement information data are stored
     * @param string $statementName
     * @return string
     */
    public static function getLocation($statementName) 
    {
        $path = '';
        
        $fullpath = self::formFullPath($statementName);
        
        //echo PHP_EOL . 'The fullpath is ' . $fullpath . PHP_EOL;
        
        if (is_file($fullpath)) {
            $path = $fullpath;
        } else {
            $path = self::getLocationByLink($statementName);
        }
        
        return $path;
    }
}
