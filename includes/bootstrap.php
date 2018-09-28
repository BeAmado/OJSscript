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

namespace OJSscript;

if (!defined('BASE_DIR')) {
    define('BASE_DIR', dirname(__FILE__) . '/../');
}

//the autoload function
function myAutoload($className) {
    $parts = explode('\\', $className);
    
    $lastIndex = count($parts) - 1;
    $filename = $parts[$lastIndex] . '.php';
    
    $path = BASE_DIR . 'classes/';
    
    //the first element in the array parts will, or at least should, always be
    //OJSscript. So add the parts to the path starting in the second one and 
    //go until before the last one, which would be the filename without .php
    for ($i = 1; $i < $lastIndex; $i++) {
        $path .= strtolower($parts[$i]) . '/';
    }
    
    $fullpath = $path . $filename;
    require_once $fullpath;
}

$autoloadRegistered = \spl_autoload_register('myAutoload');