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
    'name' => 'InsertArticleSetting',
    
    'query' => 
        'INSERT INTO article_settings '
      .     '( article_id, '
      .       'locale, '
      .       'setting_name, '
      .       'setting_value, '
      .       'setting_type ) '
      . 'VALUES '
      .     '( :InsertArticleSetting_articleId, '
      .       ':InsertArticleSetting_locale, '
      .       ':InsertArticleSetting_settingName, '
      .       ':InsertArticleSetting_settingValue, '
      .       ':InsertArticleSetting_settingType )',

    'params' => array(
           'article_id' => ':InsertArticleSetting_articleId',
               'locale' => ':InsertArticleSetting_locale',
         'setting_name' => ':InsertArticleSetting_settingName',
        'setting_value' => ':InsertArticleSetting_settingValue',
         'setting_type' => ':InsertArticleSetting_settingType',
    ),
);
