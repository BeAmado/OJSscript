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

/**
 * Description of Inquirer
 *
 * @author bernardo
 */
class Inquirer
{
    protected $mode;
    
    public function __construct($mode = null)
    {
        if ($mode !== null && strtolower($mode) === 'web') {
            $this->mode = 'web';
        } 
        else {
            $this->mode = 'cli';
        }
    }
    
    /**
     * Prompts the user for a response in the command line.
     * @param mixed $args
     * @return string
     */
    protected function inquireCli($args)
    {
        $message = '';
        if (is_string($args)) {
            $message .= $args;
        }
        
        $response = readline($message);
        return $response;
    }
    
    /**
     * This method is not yet implemented
     * @param mixed $args
     */
    protected function inquireWeb($args)
    {
        throw new \Exception('The method inquireWeb is not implemented.');
    }
    
    public function inquire($args)
    {
        if ($this->mode === 'cli') {
            return $this->inquireCli($args);
        }
    }
}
