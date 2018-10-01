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

return array(
    'name' => 'SelectUserInterests',
    
    'query' => 
        'SELECT '
      .     't.setting_value AS interest, '
      .     'u_int.controlled_vocab_entry_id AS controlled_vocab_entry_id '
      . 'FROM user_interests AS u_int '
      . 'INNER JOIN controlled_vocab_entry_settings AS t '
      .     'ON u_int.controlled_vocab_entry_id = t.controlled_vocab_entry_id '
      . 'WHERE u_int.user_id = :SelectUserInterests_userId',

    'params' => array('user_id' => ':SelectUserInterests_userId'),
);
