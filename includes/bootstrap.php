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

namespace OJSscript;

if (!defined('BASE_DIR')) {
    define('BASE_DIR', dirname(__FILE__) . '/..');
}

if (!defined('LINKS_DIR')) {
    define('LINKS_DIR', dirname(__FILE__) . '/../queries/links');
}

/**
 * PSR-4 compliant autoloader
 * Autoload function implementation copied from PSR-4 example
 * @param string $class The fully-qualified class name.
 * @return void
 */
$autoloadRegistered = \spl_autoload_register(function ($name) {
    
    // project-specific namespace prefix
    $prefix = 'OJSscript';
    
    //the type which might be class (the default), interface or test
    $type = '';

    // base directories for the namespace prefix
    $classesDir = BASE_DIR . '/classes';
    $testsDir = BASE_DIR . '/tests';
    $interfacesDir = BASE_DIR . '/interfaces';
    
    $fields = explode('\\', $name);
    
    // does the class use the namespace prefix?
    if (strcmp($fields[0], $prefix) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    
    /* @var $fileBaseName string */
    $fileBaseName = '';
    
    switch (strtolower($fields[1])) {
        case 'tests':
            $type = 'test';
            $fileBaseName .= $testsDir;
            array_splice($fields, 0, 2);
            break;
        
        case 'interfaces':
            $type = 'interface';
            $fileBaseName .= $interfacesDir;
            array_splice($fields, 0, 2);
            break;
        
        default:
            $type = 'class';
            $fileBaseName .= $classesDir;
            array_splice($fields, 0, 1);
    }

    // get the remaining name
    /* @var $fileRemainigName string */
    $fileRemainingName = implode('/', $fields);

    // form the filename with absolute path
    $file = $fileBaseName . '/' . $fileRemainingName . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});

if (!$autoloadRegistered) {
    exit('Could not register the autoloader');
}
