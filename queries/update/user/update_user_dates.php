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

return array(
    'name' => 'UpdateUserDates',
    
    'query' => 
        'UPDATE users '
      . 'SET '
      .    'date_last_email = :UpdateUserDates_dateLastEmail, '
      .    'date_registered = :UpdateUserDates_dateRegistered, '
      .     'date_validated = :UpdateUserDates_dateValidated, '
      .    'date_last_login = :UpdateUserDates_dateLastLogin '
      . 'WHERE '
      .            'user_id = :UpdateUserDates_userId',

    'params' => array(
        'date_last_email' => ':UpdateUserDates_dateLastEmail',
        'date_registered' => ':UpdateUserDates_dateRegistered',
        'date_validated'  => ':UpdateUserDates_dateValidated',
        'date_last_login' => ':UpdateUserDates_dateLastLogin',
        'user_id'         => ':UpdateUserDates_userId',
    ),
);
