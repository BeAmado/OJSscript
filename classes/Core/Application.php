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

/**
 * Description of Application
 *
 * @author bernardo
 */
class Application
{
    
    protected function begin()
    {
        echo 'Application begin' . PHP_EOL;
    }
    
    protected function end()
    {
        echo 'Application end' . PHP_EOL;
    }

    public function run($args = array())
    {
        $this->begin();
        
        //middle processing
        
        $this->end();
        
        return 0;
    }
}
