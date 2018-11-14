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

namespace OJSscript\Entity\User;
use OJSscript\Entity\Abstraction\EntityHandler;
use OJSscript\Entity\Abstraction\Entity;
use OJSscript\Statement\StatementHandler;

/**
 * Description of UserHandler
 *
 * @author bernardo
 */
class UserHandler extends EntityHandler
{
    /**
     * 
     * @param integer|string $journalId
     * 
     * @return array
     */
    protected function fetchRolesFromJournal($journalId)
    {
        StatementHandler::bindSingleParam(
            'SelectRolesFromJournal',
            'journal_id',
            $journalId
        );
        
        
    }
    
    public function fetchAll($journalId)
    {
        
    }
}
