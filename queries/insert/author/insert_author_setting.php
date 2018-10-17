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
    'name' => 'InsertAuthorSetting',
    
    'query' => 
        'INSERT INTO author_settings '
      .     '(author_id, '
      .      'locale, '
      .      'setting_name, '
      .      'setting_value, '
      .      'setting_type) '
      . 'VALUES ' 
      .     '(:InsertAuthorSettings_authorId, '
      .      ':InsertAuthorSettings_locale, '
      .      ':InsertAuthorSettings_settingName, '
      .      ':InsertAuthorSettings_settingValue, '
      .      ':InsertAuthorSettings_settingType)',

    'params' => array(
        'author_id'     => ':InsertAuthorSettings_authorId',
        'locale'        => ':InsertAuthorSettings_locale',
        'setting_name'  => ':InsertAuthorSettings_settingName',
        'setting_value' => ':InsertAuthorSettings_settingValue',
        'setting_type'  => ':InsertAuthorSettings_settingType',
    )
);
