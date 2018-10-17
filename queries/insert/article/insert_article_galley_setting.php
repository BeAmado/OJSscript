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
    'name' => 'InsertArticleGalleySetting',
    
    'query' => 
        'INSERT INTO article_galley_settings '
      .    '(galley_id, '
      .     'locale, '
      .     'setting_name, '
      .     'setting_value, '
      .     'setting_type) '
      . 'VALUES '
      .    '(:InsertArticleGalleySetting_galleyId, '
      .     ':InsertArticleGalleySetting_locale, '
      .     ':InsertArticleGalleySetting_settingName, '
      .     ':InsertArticleGalleySetting_settingValue, '
      .     ':InsertArticleGalleySetting_settingType)',

    'params' => array(
        'galley_id'     => ':InsertArticleGalleySetting_galleyId',
        'locale'        => ':InsertArticleGalleySetting_locale',
        'setting_name'  => ':InsertArticleGalleySetting_settingName',
        'setting_value' => ':InsertArticleGalleySetting_settingValue',
        'setting_type'  => ':InsertArticleGalleySetting_settingType',
    ),
);
