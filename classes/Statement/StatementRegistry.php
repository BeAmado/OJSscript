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

namespace OJSscript\Statement;
use OJSscript\Core\NonStaticRegistry;

/**
 * Registry for Statement objects.
 *
 * @author bernardo
 */
class StatementRegistry extends NonStaticRegistry
{
    /**
     * Gets the specified statement. Creates the statement if it was 
     * not registered.
     * 
     * @param string $statementName
     * @return \OJSscript\Statement\Statement
     */
    public function get($statementName)
    {
        /* @var $statement Statement */
        $statement = null;
        if ($this->isRegistered($statementName)) {
            $statement = $this->registry[$statementName];
        } else {
            $statement = StatementFactory::create(
                array('name' => $statementName)
            );
            
            $this->set($statementName, $statement);
        }
        
        return $statement;
    }
}
