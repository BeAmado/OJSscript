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
    'name' => 'UpdateArticleSetting',
    
    'query' => 
        'UPDATE article_settings '
      . 'SET '
      .    'setting_value = :UpdateArticleSetting_settingValue, '
      .     'setting_type = :UpdateArticleSetting_settingType '
      . 'WHERE '
      .       'article_id = :UpdateArticleSetting_articleId AND '
      .           'locale = :UpdateArticleSetting_locale AND '
      .     'setting_name = :UpdateArticleSetting_settingName',

    'params' => array(
        'article_id'    => ':UpdateArticleSetting_articleId',
        'locale'        => ':UpdateArticleSetting_locale',
        'setting_name'  => ':UpdateArticleSetting_settingName',
        'setting_value' => ':UpdateArticleSetting_settingValue',
        'setting_type'  => ':UpdateArticleSetting_settingType',
    ),
);
