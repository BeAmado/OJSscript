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

/**
 * PSR-4 compliant autoloader
 * Autoload function implementation copied from PSR-4 example
 * @param string $class The fully-qualified class name.
 * @return void
 */
$autoloadRegistered = \spl_autoload_register(function ($class) {
    
    // project-specific namespace prefix
    $prefix = 'OJSscript';

    // base directories for the namespace prefix
    $classes_dir = BASE_DIR . '/classes/';
    $interfaces_dir = BASE_DIR . '/interfaces/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    //first try in the classes directory
    $file = $classes_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    } else {
        //then try in the interfaces directory
        $file = $interfaces_dir . str_replace('\\', '/', $relative_class) 
                . '.php';
        
        if (file_exists($file)) {
            require_once $file;
        }
    }
});

if (!$autoloadRegistered) {
    exit('Could not register the autoloader');
}
