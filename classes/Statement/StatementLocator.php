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

/**
 * Locate the file with the prepared statement information
 *
 * @author Bernardo Amado
 */
class StatementLocator
{
    /**
     * Tries to get the location (full absolute path) of the file where the
     * prepared statement information data are stored
     * @param string $statementName
     * @return string
     */
    public static function getLocation($statementName) 
    {
        $path = '';
        
        $matches = array();
        preg_match_all('/[A-Z][^A-Z]*/', $statementName, $matches);
        $Words = $matches[0];
        
        //the array with the words in lowercase
        $words = array_map('strtolower', $Words);
        
        return $path;
    }
}
