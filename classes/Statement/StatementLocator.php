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
    
    private static function formStatementFilename($statementName)
    {
        $matches = array();
        preg_match_all('/[A-Z][^A-Z]*/', $statementName, $matches);
        $Words = $matches[0];
        
        //the array with the words in lowercase
        $words = array_map('strtolower', $Words);
        
        return implode('_', $words);
    }
    
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
     * Tries to get the location (full absolute path) of the file where the
     * prepared statement information data are stored
     * @param string $statementName
     * @return string
     */
    public static function getLocation($statementName) 
    {
        $path = '';
        
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
                return self::getLink($statementName);
        }
        
        /* @var $entityDir string */
        $entityDir = $words[1];
        
        $fullpath = BASE_DIR . '/queries/' . $operationDir . '/' . $entityDir
                . $filename . '.php';
        
        if (is_file($fullpath)) {
            $path = $fullpath;
        }
        else {
            $path = self::getLink($statementName);
        }
        
        return $path;
    }
}
