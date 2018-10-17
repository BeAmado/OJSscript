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
    'name' => 'InsertUserSetting',
    
    'query' => 
        'INSERT INTO user_settings '
      .     '( user_id, '
      .       'locale, '
      .       'setting_name, '
      .       'setting_value, '
      .       'setting_type, '
      .       'assoc_id, '
      .       'assoc_type )'
      . 'VALUES '
      .     '( :InsertUserSetting_userId, '
      .       ':InsertUserSetting_locale, '
      .       ':InsertUserSetting_settingName, '
      .       ':InsertUserSetting_settingValue, '
      .       ':InsertUserSetting_settingType, '
      .       ':InsertUserSetting_assocId, '
      .       ':InsertUserSetting_assocType )',

    'params' => array(
              'user_id' => ':InsertUserSetting_userId',
               'locale' => ':InsertUserSetting_locale',
         'setting_name' => ':InsertUserSetting_settingName',
        'setting_value' => ':InsertUserSetting_settingValue',
         'setting_type' => ':InsertUserSetting_settingType',
             'assoc_id' => ':InsertUserSetting_assocId',
           'assoc_type' => ':InsertUserSetting_assocType',
    ),
);
