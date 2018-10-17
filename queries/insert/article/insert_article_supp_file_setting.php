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
    'name' => 'InsertArticleSuppFileSetting',
    
    'query' => 
        'INSERT INTO article_supp_file_settings '
      .    '(supp_id, '
      .     'locale, '
      .     'setting_name, '
      .     'setting_value, '
      .     'setting_type) '
      . 'VALUES '
      .    '(:InsertArticleSuppFileSetting_suppId, '
      .     ':InsertArticleSuppFileSetting_locale, '
      .     ':InsertArticleSuppFileSetting_settingName, '
      .     ':InsertArticleSuppFileSetting_settingValue, '
      .     ':InsertArticleSuppFileSetting_settingType)',

    'params' => array(
        'supp_id'       => ':InsertArticleSuppFileSetting_suppId',
        'locale'        => ':InsertArticleSuppFileSetting_locale',
        'setting_name'  => ':InsertArticleSuppFileSetting_settingName',
        'setting_value' => ':InsertArticleSuppFileSetting_settingValue',
        'setting_type' => ':InsertArticleSuppFileSetting_settingType',
    ),
);
